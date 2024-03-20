<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);


Route::add(['GET', 'POST'], '/doctor', [Controller\Site::class, 'createDoctor'])
    ->middleware('auth');
Route::add(['GET', 'POST'],  '/patient', [Controller\Site::class, 'createPatient'])
    ->middleware('auth');


Route::add(['GET', 'POST'], '/register', [Controller\Site::class, 'createReg'])
    ->middleware('auth');


Route::add(['GET', 'POST'], '/record', [Controller\Site::class, 'createRecord'])
    ->middleware('auth');

Route::add(['GET', 'POST'], '/chooserecord', [Controller\Site::class, 'chooserecord'])
    ->middleware('auth');

Route::add(['GET', 'POST'], '/choosepatient', [Controller\Site::class, 'choosepatient'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/choosedoctor', [Controller\Site::class, 'choosedoctor'])
    ->middleware('auth');
