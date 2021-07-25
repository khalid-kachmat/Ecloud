<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// patients api for importing patients data from patients table
Route::get('patients', [PatientController::class, 'importPatientsData']);

//doctors api for importing doctors data from doctors and users table
Route::get('docInfo' ,[DoctorController::class, 'doctorInfo']);

// add or edit a doctor
Route::post('updateOrAddDoc', [DoctorController::class, 'updateOrAddDoc']);

//delete doctor
Route::post('deleteDoctor', [DoctorController::class, 'deleteDoctor']);

//secretaries Data
Route::get('secInfo' ,[SecretaryController::class, 'secretariesInfo']);

//add or edit secretaries
Route::post('updateOrAddSec', [SecretaryController::class, 'updateOrAddSec'] );

//delete secretary
Route::post('deleteSecretary', [SecretaryController::class, 'deleteSecretary']);

// assurance api for importing assurances data from assurance table
Route::get('assurances',[AssuranceController::class, 'importAssuranceData']);

// doctor api for importing doctors data for doctor table
Route::get('getDocData', [DoctorController::class, 'importDoctorsData']);

//services api for importing services data for services table
Route::get('services',[ServiceController::class , 'importServicesData']);

// receiving Post data from the vue js form
Route::post('getAppointmentData',[AppointmentController::class, 'getAppointmentData']);

//sent all appointments data into vue component
Route::get('sentAppointmentData',[AppointmentController::class, 'sentAppointmentData']);

//delete appointment
Route::post('deleteAppointment', [AppointmentController::class, 'deleteAppointment']);

Route::get('patientDataAppNbr', [PatientController::class, 'patientDataAppNbr']);

Route::post('updateOrAdd', [PatientController::class, 'updateOrAdd']);

Route::post('deletePatient', [PatientController::class, 'deletePatient']);

Route::post('appointmentPerPatient', [PatientController::class, 'getAppointmentDataPerPatient']);
