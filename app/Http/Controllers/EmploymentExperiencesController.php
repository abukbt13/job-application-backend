<?php

namespace App\Http\Controllers;

use App\Models\EmploymentExperience;
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
}
