<?php

use App\Http\Controllers\Admin\Auth\AppointmentController;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;
use App\Models\staff;
use App\Models\User;
use App\Models\specialist;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

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
Route::get('/team', function () {
    $doctors=Doctor::get();
    return view('admin.auth.team',compact('doctors'));
})->name('team');
Route::get('/serv',function(){
    $services = Service::get();
    return view('admin.auth.service',compact('services'));
})->name('serv');

Route::get('/apps', function () {
    return view('admin.appointment.index');
});
Route::get('/home', function () {
    return view('admin.auth.home');
});

//Auth::routes();
/*Route::group(['middleware'=>['auth']],function(){
    Route::get('/dashboard',function(){
        if(auth()->check()){
            if(auth()->user()->usertype == "admin"){
                $totalDoctor =  Doctor::count();
                $totalPatient = Patient::count();
                $totalStaff  = staff::count();
                $totalRegister  = User::count();
                return view('admin.dashboard.index', compact('totalDoctor', 'totalPatient', 'totalStaff', 'totalRegister'));
            }
            else
            return view('admin.dashboard.index1');
        }
    })->name('dashboard');
});*/
Route::get('/layouts1',function(){
    $totalDoctor =  Doctor::count();
                $totalPatient = Patient::count();
                $totalStaff  = staff::count();
                $totalRegister  = User::count();
                $totalspecialist=Specialist::count();
                $totalService=Service::count();
                return view('layouts.admin.layout', compact('totalDoctor', 'totalPatient', 'totalStaff', 'totalRegister','totalspecialist'));


});

Route::get('/layouts1',function(){
    $doctors = Doctor::get();
    return view('admin.auth.team',compact('doctors'));
    $service = Service::get();
    return view('admin.auth.service',compact('service'));

});
// Route::get('/service',function(){
//     $service = Service::get();
//     return view('layouts1.admin.service',compact('service'));
// });
Route::get('/appointment', [App\Http\Controllers\admin\Auth\AppointmentController::class,'appointform'])->name('auth.appointform');
Route::post('/appointment', [App\Http\Controllers\admin\Auth\AppointmentController::class,'appointment'])->name('appointment');

Route::get('/contact', [App\Http\Controllers\admin\Auth\MainController::class,'contactForm'])->name('auth.contact');
Route::get('/about', [App\Http\Controllers\admin\Auth\MainController::class,'aboutForm'])->name('auth.about');
Route::get('/appointment', [App\Http\Controllers\admin\Auth\MainController::class,'appointmentForm'])->name('auth.appointment');
Route::get('/gallery', [App\Http\Controllers\admin\Auth\MainController::class,'galleryForm'])->name('auth.gallery');
//Route::get('/service', [App\Http\Controllers\admin\Auth\MainController::class,'serviceForm'])->name('auth.service');
Route::get('/home', [App\Http\Controllers\admin\Auth\MainController::class,'homeForm'])->name('auth.home');


Route::get('/register', [App\Http\Controllers\admin\Auth\RegisterController::class,'registerForm'])->name('auth.register');
Route::post('/register', [App\Http\Controllers\admin\Auth\RegisterController::class,'registerUser'])->name('auth.register-user');
Route::get('/login', [App\Http\Controllers\admin\Auth\RegisterController::class,'loginForm'])->name('auth.login');
Route::post('/login', [App\Http\Controllers\admin\Auth\LoginController::class,'loginUser'])->name('auth.login-user');
$router->get('/logout',[App\Http\Controllers\admin\Auth\LoginController::class,'Logout'])->name('auth.logout');
//Route::get('/logout',function(){
  //  return auth()->logout();
//})->name('auth.logout')
Route::group(['middleware'=>"auth"],function($router){
    Route::get('/dashboard',[App\Http\Controllers\admin\Dashboard\DashboardController::class,'index'])->name('dashboard');
$router->get('/specialist',[App\Http\Controllers\admin\Specialist\SpecialistController::class,'index'])->name('specialist.index');
$router->get('/specialist/create',[App\Http\Controllers\admin\Specialist\SpecialistController::class,'create'])->name('specialist.create');
$router->post('/specialist/store',[App\Http\Controllers\admin\Specialist\SpecialistController::class,'store'])->name('specialist.store');
$router->get('/specialist/{id}/delete',[App\Http\Controllers\admin\Specialist\SpecialistController::class,'delete'])->name('specialist.delete');
$router->get('/specialist/{id}/edit',[App\Http\Controllers\admin\Specialist\SpecialistController::class,'edit'])->name('specialist.edit');
$router->post('/specialist/{id}/update',[App\Http\Controllers\admin\Specialist\SpecialistController::class,'update'])->name('specialist.update');

Route::get('/showappointment',[App\Http\Controllers\admin\Auth\AppointmentController::class,'showappointment'])->name('showappointment');
Route::post('/approved',[AppointmentController::class,'aprroved']  )->name('approved');
Route::get('/approve-patient/{id}',[AppointmentController::class,'aprrovPatient']  )->name('approve-patient');
Route::post('/cancelled',[AppointmentController::class,'cancelled']  )->name('cancelled');
Route::get('/cancel-patient/{id}',[AppointmentController::class,'cancelPatient']  )->name('cancel-patient');
// Route::get('/approved/{id}',[App\Http\Controllers\admin\Auth\AppointmentController::class,'approved'])->name('approved');
$router->get('/appointment/{id}/delete',[App\Http\Controllers\admin\Auth\AppointmentController::class,'delete'])->name('appointment.delete');


    $router->get('/doctor',[App\Http\Controllers\admin\Doctor\DoctorController::class,'index'])->name('doctor.index');
    $router->get('/doctor/create',[App\Http\Controllers\admin\Doctor\DoctorController::class,'create'])->name('doctor.create');
    $router->post('/doctor/store',[App\Http\Controllers\admin\Doctor\DoctorController::class,'store'])->name('doctor.store');
    $router->get('/doctor/{id}/delete',[App\Http\Controllers\admin\Doctor\DoctorController::class,'delete'])->name('doctor.delete');
    $router->get('/doctor/{id}/edit',[App\Http\Controllers\admin\Doctor\DoctorController::class,'edit'])->name('doctor.edit');
    $router->post('/doctor/{id}/update',[App\Http\Controllers\admin\Doctor\DoctorController::class,'update'])->name('doctor.update');



$router->get('/staff',[App\Http\Controllers\admin\Staff\StaffController::class,'index'])->name('staff.index');
$router->get('/staff/create',[App\Http\Controllers\admin\Staff\StaffController::class,'create'])->name('staff.create');
$router->post('/staff/store',[App\Http\Controllers\admin\Staff\StaffController::class,'store'])->name('staff.store');
$router->get('/staff/{id}/delete',[App\Http\Controllers\admin\Staff\StaffController::class,'delete'])->name('staff.delete');
$router->get('/staff/{id}/edit',[App\Http\Controllers\admin\Staff\StaffController::class,'edit'])->name('staff.edit');
$router->post('/staff/{id}/update',[App\Http\Controllers\admin\Staff\StaffController::class,'update'])->name('staff.update');

$router->get('/patient',[App\Http\Controllers\Admin\Patient\PatientController::class,'index'])->name('patient.index');
$router->get('/patient/create',[App\Http\Controllers\Admin\Patient\PatientController::class,'create'])->name('patient.create');
$router->post('/patient/store',[App\Http\Controllers\Admin\Patient\PatientController::class,'store'])->name('patient.store');
$router->get('/patient/{id}/delete',[App\Http\Controllers\Admin\Patient\PatientController::class,'delete'])->name('patient.delete');
$router->get('/patient/{id}/edit',[App\Http\Controllers\Admin\Patient\PatientController::class,'edit'])->name('patient.edit');
$router->post('/patient/{id}/update',[App\Http\Controllers\Admin\Patient\PatientController::class,'update'])->name('patient.update');
 $router->get('/patient',[App\Http\Controllers\Admin\Patient\PatientController::class,'index'])->name('patient.index');

 $router->get('/service',[App\Http\Controllers\admin\Service\ServiceController::class,'index'])->name('service.index');
 $router->get('/service/create',[App\Http\Controllers\admin\Service\ServiceController::class,'create'])->name('service.create');
 $router->post('/service/store',[App\Http\Controllers\admin\Service\ServiceController::class,'store'])->name('service.store');
 $router->get('/service/{id}/delete',[App\Http\Controllers\admin\Service\ServiceController::class,'delete'])->name('service.delete');
 $router->get('/service/{id}/edit',[App\Http\Controllers\admin\Service\ServiceController::class,'edit'])->name('service.edit');
 $router->post('/service/{id}/update',[App\Http\Controllers\admin\Service\ServiceController::class,'update'])->name('service.update');

});
