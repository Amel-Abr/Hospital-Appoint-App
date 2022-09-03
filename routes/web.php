<?php

use App\Models\Hospital;
use GuzzleHttp\Middleware;
use App\Models\Appointment;
use App\Http\Middleware\IsAdmin;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminnController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HospitalController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\AppointmentController;

use Laravel\Fortify\Http\Controllers\Patient\AuthenticatedSessionController;


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

Route::get('/patientLogin', function () {
  return view('patient.login');
});



Route::get('/home',[HomeController::class,"redirect"])->middleware('auth')->name('home');

//                     ****************Admin**********
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () { 
   Route::get('appointments','AppointmentController@index') ->name('appointments');
   Route::get('doctors','DoctorController@index') ->name('doctors');
   Route::get('patients','PatientController@showP') ->name('patients');

    // Route::resource('Appointements','AppointementsController'); 
});
   Route::resource('admin','AdminnController')->except([
   'create','update'
   ])->middleware(['auth','isAdmin']);
 
    Route::put('patient','PatientController@update')->name('admin.updateP');
    Route::put('appointment','AppointmentController@update')->name('admin.updateA');
    Route::put('admin','AdminnController@update')->name('admin.updateD');
    // Route::delete('admin','AdminnController@destroyPatient')->name('admin.deletePatient');
    Route::post('AddAppointment','AppointmentController@store')->name('admin.storeA');
    


    Route::resource('patient','PatientController')->except([
      'create','update','index',' insert','store',
      'edit','update'
      ]);

     
      Route::resource('appointment','AppointmentController')->except([
        'create','update','index',' insert','store',
        'edit','update'
        ]);


   
 

              //  ****************Doctor**************

Route::prefix('doctor')->middleware(['auth','isDoctor'])->group(function () { 

 Route::get('appointments','AppointmentController@indexD') ->name('appointments');
 Route::get('doctors','DoctorController@index') ->name('doctors');
 Route::get('patients','PatientController@show') ->name('patients');   
 Route::put('update','DoctorController@update') ->name('doctor.update');
 Route::put('updateTime','DoctorController@updateTime') ->name('doctor.updateTime');
 Route::post('appointment','DoctorController@store')->name('doctor.storeA');
 Route::get('patients','PatientController@showP') ->name('patients');


}); 
 

                          //  ****************patient*************
Route::post('/insert_patient',[PatientController::class,'insert'])->name('regstPatient');
Route::post('/patientHom',[PatientController::class,'chack_login'])->name('loginPatient');


Route::prefix('patient')->group(function () { 
Route::get('/patientHome',[HospitalController::class,'index'])->name('patientHome');
Route::get('/profile',[PatientController::class,'index'])->name('patientProfile');
Route::get('/appointmentList',[AppointmentController::class,'indexP'])->name('patientAppointment');
Route::get('/doctorsList',[HospitalController::class,'show'])->name('listDoctors');
Route::put('update',[PatientController::class,'update']) ->name('patient.update');
Route::post('store',[PatientController::class,'store'])->name('patient.store');
// Route::put('/show',[PatientController::class,'showDoct']);
});

// Route::resource('patient',PatientController::class)->except([
//   'create','update'
// ]);






// Route::namespace('Patient')->prefix('patient')->name('patient.')->groupe(function(){
//   Route::namespace('Auth')->group(function(){
    
//   });
// });
// Route::post('/patientHome',[AuthenticatedSessionController::class,'store'])->name('loginPatient');


// Route::get('loginPatient',[AuthenticatedSessionController::class,'create'])->name('loginPati');


















  // Route::group(['prefix' => 'Doctor','as'=>'Doctor.' , 'middlwere' => 'auth'],function () {
  //     // Route::get('profile', 'DoctorController@show') ->name('profile'); 
  //     Route::get('appointments','AppointmentController@index') ->name('appointments');
  //     Route::get('doctors','DoctorController@index') ->name('doctors');
       
  // });

  


  // Route::put('admin','AdminController@update')->name('admin.update');
  // Route::delete('admin', 'AdminController@destroy')->name('admin.destroy');
  // Route::get('/edit/{id}',[AdminController ::class,'edit']);

// Route::fallback(function(){
//   return view('page404');
// });
   





// *************************************************************************
// Route::get('/home',[HomeController::class,'redircet']);
// Route::get('/home','HomeController@redirect');

// Route::get('/home', function(){
//   if(Auth::check()){
//     if(Auth::user()->isAdmin==true){

//       return view('adminhome');
//     }else{
//       Route::get('/profile', 'DoctorController@show') ;
//       // return view('Doctor.profile');
//     }
//   }
// })







// Route::get('/', function () {
//   return view('Doctors.profile');
// });
// Route:: middleware('auth')->group(function () { 
//     Route::get('/adminhome', function () {
//       return view('adminhome');
//     });
//     Route::resource('Doctors','DoctorController');
    
// });

//  Route::resource('Doctors', 'DoctorController');
  // Route::group(['prefix' => 'Doctors','as'=>'Doctors.'],function () {
      // Route::get('prefile','DoctorController@show') ->name('profile'); 
    // Route::get('/Doctors/profile', function () {
        // return view('profile');
    // });
    //   Route::view('appointments','Doctors.appointments') ->name('appointments');        
  // });
      




