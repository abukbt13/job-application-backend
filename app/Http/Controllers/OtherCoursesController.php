<?php

namespace App\Http\Controllers;

use App\Models\OtherCourse;
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
        $otherCourse=new OtherCourse();
        $otherCourse->institution=$data['institution'];
        $otherCourse->course=$data['course'];
        $otherCourse->certNo=$data['certNo'];
        $otherCourse->startDate=$data['startDate'];
        $otherCourse->endDate=$data['endDate'];
        $otherCourse->user_id=$user_id;
        $otherCourse->save();

        return response([
            'message'=>'Success',
            'data'=>$otherCourse
        ]);
    }
}
