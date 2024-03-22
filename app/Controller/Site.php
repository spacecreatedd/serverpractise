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
use Validators\RequireValidator;

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
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'surname' => ['required'],
                'patronym' => ['required'],
                'date_of_birth' => ['required'],
                'job' => ['required'],
                'specialization' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);
    
            if($validator->fails()){
                return new View('site.doctor',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

        }
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
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'surname' => ['required'],
                'patronym' => ['required'],
                'date_of_birth' => ['required'],
                'image' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);
    
            if ($validator->fails()) {
                return new View('site.patient', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
    
            // Получаем информацию о файле из массива $_FILES
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $image_tmp = $image['tmp_name'];
            $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex;
            move_uploaded_file($image_tmp, $new_img_name); // Перемещаем загруженный файл в нужную папку
    
            // Заменяем имя файла в данных пациента на новое имя
            $patientData = $request->all();
            $patientData['image'] = $new_img_name;
    
            if (Auth::check() && Auth::user()->role === 'register') {
                if (Patient::create($patientData)) {
                    return app()->route->redirect('/choosepatient');
                } else {
                    return new View('site.patient', ['message' => 'Ошибка при создании пациента']);
                }
            }
        }
    
        // Если пользователь не авторизован или не отправлен методом POST
        return new View('site.patient');
    }
    

    public function createReg(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required'],
                'password' => ['required'],
                'role' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);
    
            if($validator->fails()){
                return new View('site.register',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

        }
        
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

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'patient_id' => ['required'],
                'doctor_id' => ['required'],
                'date' => ['required']
            ], [
                'required' => 'Поле :field пусто',
            ]);
    
            if($validator->fails()){
                return new View('site.record',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

        }

        if (Auth::check() && Auth::user()->role === 'register') {
            if ($request->method === 'POST' && Record::create($request->all())) {
                app()->route->redirect('/chooserecord');
            }
            return new View('site.record', ['patient_id' => $patient_id, 'doctor_id' => $doctor_id]);
        }
        app()->route->redirect('/chooserecord');
    }
    
    public function chooserecord(Request $request): string {
        $patient_id = Patient::all();
        $records = Record::all();
        $message = '';
    
        if (Auth::check() && Auth::user()->role === 'register') {
            if ($request->method === 'POST') {
                if (isset($_POST['search_record'])) {
                    $searchId = $_POST['record_id'] ?? null;
    
                    if ($searchId !== null) {
                        $foundRecord = Record::find($searchId);
                        if ($foundRecord) {
                            // Если найдена запись, отображаем ее
                            return (new View())->render('site.chooserecord', ['patient_id' => $patient_id, 'records' => $records, 'foundRecord' => $foundRecord]);
                        } else {
                            // Если запись не найдена, выводим сообщение об ошибке
                            $message = 'Запись с указанным ID не найдена.';
                        }
                    } else {
                        // Если ID не был передан, выводим сообщение об ошибке
                        $message = 'Пожалуйста, введите ID записи для поиска.';
                    }
                } else {
                    $patientFilter = $_POST['patient_filter'] ?? '';
    
                    if (!empty($patientFilter)) {
                        $records = Record::where('patient_id', $patientFilter)->get();
                    } else {
                        $message = 'Пожалуйста, выберите пациента и укажите дату.';
                    }
    
                    if (isset($_POST['record_id'])) {
                        $recordId = $_POST['record_id'];
                        $record = Record::find($recordId);
                        if ($record) {
                            $record->delete();
                        }
                    }
                }
            }
            return (new View())->render('site.chooserecord', ['patient_id' => $patient_id, 'records' => $records, 'message' => $message]);
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
        
        $patients = Patient::all();
        
        return (new View())->render('site.choosedoctor', ['message' => $message, 'patients' => $patients,'doctors' => $doctors]);
    }
    
    
   
}