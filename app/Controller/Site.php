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
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/hello');
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
}
