<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>['auth:sanctum']],function(){
    //authentication
    Route::get('user-auth',[UsersController::class,'auth']);
    //personal Information
Route::post('addPersonalInfo',[PersonalInformationsController::class,'store']);
    //professional information
Route::post('addProfessional',[ProfessionalQualificationsController::class,'store']);
    //other courses
Route::post('addOtherCourse',[OtherCoursesController::class,'store']);
    //employment experience
Route::post('addEmplomentExperience',[EmploymentExperiencesController::class,'store']);
    //referees
Route::post('addReferees',[RefereesController::class,'store']);
    //documennts
Route::post('addDocument',[DocumentsController::class,'store']);

//apply vacancy
Route::post('add_vacancy',[VacancyController::class,'add_vacancy']);

});

