<?php

namespace App\Http\Controllers;

use App\Models\OtherCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OtherCoursesController extends Controller
{
    public function store(Request $request){
        $rules=[
            'institution' => 'required',
            'course' => 'required',
            'certNo' => 'required',
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
        $user->progress=4;
        $user->update();
        $otherCourse=new OtherCourse();
        $otherCourse->institution=$data['institution'];
        $otherCourse->course=$data['course'];
        $otherCourse->certNo=$data['certNo'];
        $otherCourse->startDate=$data['startDate'];
        $otherCourse->endDate=$data['endDate'];
        $otherCourse->user_id=$user_id;
        $courses_count=OtherCourse::where('user_id',$user_id)->count();
        if($courses_count>4){
            return response([
                'status'=>'fail',
                'message'=>'You can not add more four courses',
                'data'=>$otherCourse
            ],422);
        }
        else{
            $otherCourse->save();
            return response([
                'status'=>'success',
                'message'=>'You can not add more four courses',
                'data'=>$otherCourse
            ],200);
        }
    }
    public function list_relevant_courses(){
        $user_id=Auth::user()->id;
        $otherCourses = OtherCourse::where('user_id',$user_id)->get();

        return response([
            'status'=>'success',
            'user'=>$otherCourses
        ]);
    }
}
