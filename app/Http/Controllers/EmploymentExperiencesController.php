<?php

namespace App\Http\Controllers;

use App\Models\EmploymentExperience;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmploymentExperiencesController extends Controller
{
    public function store(Request $request){
        $rules=[
            'organisation' => 'required',
            'position' => 'required',
            'workNature' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ];
        $data=request()->all();
        $valid=Validator::make($data,$rules);
        if(count($valid->errors())){
            return response([
                'status'=>'failed',
                'message'=>$valid->errors()
            ]);
        }
        $user_id=Auth::user()->id;
        $user=User::find($user_id);
        $user->progress=5;
        $user->update();
        $otherCourse=new EmploymentExperience();
        $otherCourse->organisation=$data['organisation'];
        $otherCourse->position=$data['position'];
        $otherCourse->workNature=$data['workNature'];
        $otherCourse->startDate=$data['startDate'];
        $otherCourse->endDate=$data['endDate'];
        $otherCourse->user_id=$user_id;
        $otherCourse->save();

        return response([
            'message'=>'Success',
            'data'=>$otherCourse
        ]);
    }
    public function update_experience(Request $request){
        $rules=[
            'organisation' => 'required',
            'position' => 'required',
            'workNature' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ];
        $data=request()->all();
        $valid=Validator::make($data,$rules);
        if(count($valid->errors())){
            return response([
                'status'=>'failed',
                'message'=>$valid->errors()
            ]);
        }
        $user_id=Auth::user()->id;
        $other = EmploymentExperience::where('user_id',$user_id)->get()->first();
        $other->organisation=$data['organisation'];
        $other->position=$data['position'];
        $other->workNature=$data['workNature'];
        $other->startDate=$data['startDate'];
        $other->endDate=$data['endDate'];
        $other->update();

        return response([
            'status'=>'success',
            'message'=>'You have updated successfully',
            'data'=>$other
        ]);
    }
    public function list_experience(){
        $user_id=Auth::user()->id;
        $experience = EmploymentExperience::where('user_id',$user_id)->get();

        return response([
            'status'=>'success',
            'user'=>$experience
        ]);
    }
}
