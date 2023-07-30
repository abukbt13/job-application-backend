<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\EmploymentExperiencesController;
use App\Http\Controllers\OtherCoursesController;
use App\Http\Controllers\PersonalInformationsController;
use App\Http\Controllers\ProfessionalQualificationsController;
use App\Http\Controllers\RefereesController;
use App\Http\Controllers\VacancyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Models\EmploymentExperience;

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
Route::post('registerUser',[UsersController::class, 'store']);
Route::post('loginUser',[UsersController::class, 'login']);
Route::post('reset_password',[UsersController::class, 'reset_password']);
Route::post('change_password/{id}',[UsersController::class, 'change_password']);
Route::post('auth/login',[UsersController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::group(['middleware'=>['auth:sanctum']],function(){
        //authentication
        Route::get('user-auth',[UsersController::class,'auth']);
        //personal Information
        Route::post('addPersonalInfo',[PersonalInformationsController::class,'store']);
        Route::post('update_personalInfo',[PersonalInformationsController::class,'update_personalInfo']);
        Route::get('list_personal_info',[PersonalInformationsController::class,'list_personal_info']);


            //professional information
        Route::post('addProfessional',[ProfessionalQualificationsController::class,'store']);
        Route::post('update_ProfessionalQualification',[ProfessionalQualificationsController::class,'update_ProfessionalQualification']);
        Route::get('list_professional_qualificaion',[ProfessionalQualificationsController::class,'list_professional_qualificaion']);

            //other courses
        Route::post('addOtherCourse',[OtherCoursesController::class,'store']);
        Route::get('list_relevant_courses',[OtherCoursesController::class,'list_relevant_courses']);


            //employment experience
        Route::post('addEmplomentExperience',[EmploymentExperiencesController::class,'store']);
        Route::post('update_experience',[EmploymentExperiencesController::class,'update_experience']);
        Route::get('list_experience',[EmploymentExperiencesController::class,'list_experience']);


            //referees
        Route::post('addReferees',[RefereesController::class,'store']);
        Route::get('list_referees',[RefereesController::class,'list_referees']);


            //documennts
        Route::post('addDocument',[DocumentsController::class,'store']);
        Route::get('list_documents',[DocumentsController::class,'list_documents']);


         //apply vacancy
        Route::post('add_vacancy',[VacancyController::class,'add_vacancy']);
        Route::get('list_vacancies',[VacancyController::class,'list_vacancies']);

        Route::get('list_applied',[UsersController::class,'list_applied']);

        Route::get('list_users_applied', [AdminsController::class,'list_users_applied']);

});

Route::post('add_book',[BookController::class,'store']);
Route::get('show-book/{id}',[BookController::class,'show']);
Route::get('show-all',[BookController::class,'show_all']);
