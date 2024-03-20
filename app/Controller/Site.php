<?php

namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Model\Doctor;
use Model\Patient;
use Model\Jobs;
use Model\Specs;
use Model\Record;
use Model\Chooserecord;
use Model\Choosepatient;
use Src\Validator\Validator;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        $user = Auth::user();
        $role = $user ? $user->role : 'Guest'; // Если пользователь не аутентифицирован, устанавливаем роль 'Guest'
        return new View('site.hello', ['message' => 'hello working', 'role' => $role]);
    }
    

    public function signup(Request $request): string
    {
       if ($request->method === 'POST') {
    
           $validator = new Validator($request->all(), [
               'name' => ['required'],
               'login' => ['required', 'unique:users,login'],
               'password' => ['required']
           ], [
               'required' => 'Поле :field пусто',
               'unique' => 'Поле :field должно быть уникально'
           ]);
    
           if($validator->fails()){
               return new View('site.signup',
                   ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
           }
    
           if (User::create($request->all())) {
               app()->route->redirect('/login');
           }
       }
       return new View('site.signup');
    }
    

    public function login(Request $request): string
    {
        // Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        // Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        // Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function createDoctor(Request $request): string
    {
        if (Auth::check() && Auth::user()->role === 'register') {
            $jobs = Jobs::all();
            $specs = Specs::all();
            if ($request->method === 'POST' && Doctor::create($request->all())) {
                app()->route->redirect('/hello');
            }
            return new View('site.doctor', ['jobs' => $jobs, 'specs' => $specs]);

        }
        app()->route->redirect('/hello');

    }
    
    public function createPatient(Request $request): string
    {
        if (Auth::check() && Auth::user()->role === 'register') {
            if ($request->method === 'POST' && Patient::create($request->all())) {
                app()->route->redirect('/hello');
            }
            return new View('site.patient');
        }
        app()->route->redirect('/hello');
    }

    public function createReg(Request $request): string
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            if ($request->method === 'POST' && User::create($request->all())) {
                app()->route->redirect('/hello');
            }
            return new View('site.register');
        }
        app()->route->redirect('/hello');
    }

    
    public function createRecord(Request $request): string
    {
        $patient_id = Patient::all();
        $doctor_id = Doctor::all(); 


        if (Auth::check() && Auth::user()->role === 'register') {
            if ($request->method === 'POST' && Record::create($request->all())) {
                app()->route->redirect('/hello');
            }
            return new View('site.record', ['patient_id' => $patient_id, 'doctor_id' => $doctor_id]);
        }
        app()->route->redirect('/hello');
    }
    
    public function chooserecord(Request $request): string {
        $patient_id = Patient::all();
        $records = Record::all();
    
        if (Auth::check() && Auth::user()->role === 'register') {
            if ($request->method === 'POST') {
                $patientFilter = $_POST['patient_filter'] ?? '';
    
                if (!empty($patientFilter)) {
                    $records = Record::where('patient_id', $patientFilter)->get();
                }
                
                if (isset($_POST['record_id'])) {
                    $recordId = $_POST['record_id'];
                    $record = Record::find($recordId);
                    if ($record) {
                        $record->delete();
                    }
                }
            }
            return (new View())->render('site.chooserecord', ['patient_id' => $patient_id, 'records' => $records]);
        }
    }
    

    public function choosepatient(Request $request): string {
        $message = '';
        $doctors = Doctor::all(); 
    
        if (Auth::check() && Auth::user()->role === 'register') {
            if ($request->method === 'POST') {
                $doctorId = $_POST['choosedoctor'] ?? '';
                $chosenDate = $_POST['chosenDate'] ?? '';
                
                if (!empty($doctorId) && !empty($chosenDate)) {
                    // Получаем записи, соответствующие выбранному врачу и дате
                    $records = Record::where('doctor_id', $doctorId)->whereDate('date', $chosenDate)->get();
                    $patients = [];
                    foreach ($records as $record) {
                        // Получаем информацию о пациенте из записи
                        $patientId = $record->patient_id;
                        $patient = Patient::find($patientId);
                        if ($patient) {
                            $patients[] = $patient;
                        }
                    }
                } else {
                    $message = 'Пожалуйста, выберите врача и укажите дату.';
                }
            }
        }
         
        return (new View())->render('site.choosepatient', ['message' => $message, 'patients' => $patients ?? [], 'doctors' => $doctors]);
    }
    
    
    public function choosedoctor(Request $request): string {
        $message = '';
        $doctors = []; // Инициализируем массив врачей
        
        if ($request->method === 'POST' && $request->get('choosedPatient')) { // Проверяем наличие выбранного пациента
            $patientId = $request->get('choosedPatient'); // Получаем выбранный ID пациента
            
            if (!empty($patientId)) {
                // Находим все записи, связанные с выбранным пациентом
                $records = Record::where('patient_id', $patientId)->get();
                // Получаем всех врачей, связанных с этими записями
                foreach ($records as $record) {
                    $doctorId = $record->doctor_id;
                    $doctor = Doctor::find($doctorId);
                    if ($doctor) {
                        $doctors[] = $doctor;
                    }
                }
            } else {
                $message = 'Пожалуйста, выберите пациента.';
            }
        }
        
        $patients = Patient::all(); // Получаем всех пациентов для отображения в выпадающем списке
        
        return (new View())->render('site.choosedoctor', [
            'message' => $message,
            'patients' => $patients,
            'doctors' => $doctors
        ]);
    }
    
    
    
}
