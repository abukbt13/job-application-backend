<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
  public function add_vacancy(Request $request){
      $user_id = auth::user();
      $user_id=$user_id->id;
      $exist=Vacancy::where(['user_id' => $user_id])->first();
      if($exist){
          return response([
              'status'=>'Fail',
              'message'=>'You have already applied for a vacancy'
          ]);
      }
      else{
          $vacancy=new Vacancy();
          $vacancy->user_id=$user_id;
          $vacancy->name=$request->name;
          $vacancy->description=$request->description;
          $vacancy->save();
          return response([
              'status'=>'Success',
              'message'=>'You have successfully applied for a vacancy'
          ]);
      }
  }
}
