<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    //////////////////////////// ROOT ///////////////////////////
    Route::group(['middleware' => ['root']], function () {
        Route::prefix('root')->group(function () {

            Route::prefix('user')->group(function () {
                Route::resources([
                    'all' => 'Root\UserController',
                ]);
            });

            Route::prefix('rol')->group(function () {
                Route::resources([
                    'all' => 'Root\RoleController',
                ]);
            });

            Route::prefix('university')->group(function () {
                Route::resources([
                    'all' => 'Root\UniversityController',
                    'services' => 'Root\UniversityServiceController',
                    'modalities' => 'Root\ModalityController',
                    'systems' => 'Root\SystemController',
                    'programs' => 'Root\ProgramController',
                    'students' => 'Root\StudentController',
                    'studentevaluations' => 'Root\StudentEvaluationController',
                    'projects' => 'Root\ProjectUniversityController',
                ]);
                Route::get('/studentevaluations/create2/{student}', 'Root\StudentEvaluationController@create');
            });
            Route::prefix('addressuni')->group(function () {
                Route::resources([
                    'all' => 'Root\AddressUniController',
                ]);
                Route::get('/all/create2/{university}', 'Root\AddressUniController@create');
                Route::get('/viewmunicipalities', 'Root\AddressUniController@viewmunicipalities');
                Route::get('/viewlocations', 'Root\AddressUniController@viewlocations');   
            });
        });
    });

});