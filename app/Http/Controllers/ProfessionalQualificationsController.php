<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\ProfessionalQualification;
class ProfessionalQualificationsController extends Controller
{
    public function store(Request $request){
        $rules=[
            'institution' => 'required',
            'level' => 'required',
            'course' => 'required',
            'award' => 'required',
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
        $user_id=Auth::user()->id;
        $user=User::find($user_id);
        $user->progress=3;
        $user->update();
        $professionalQualificaion=new ProfessionalQualification();
        $professionalQualificaion->institution=$data['institution'];
        $professionalQualificaion->level=$data['level'];
        $professionalQualificaion->course=$data['course'];
        $professionalQualificaion->award=$data['award'];
        $professionalQualificaion->startDate=$data['startDate'];
        $professionalQualificaion->endDate=$data['endDate'];
        $professionalQualificaion->user_id=$user_id;
        $professionalQualificaion->save();

        return response([
            'message'=>'Success',
            'data'=>$professionalQualificaion
        ]);
    }
    public function update_ProfessionalQualification(Request $request){
        $rules=[
            'institution' => 'required',
            'level' => 'required',
            'course' => 'required',
            'award' => 'required',
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
        $professionalQualificaion= ProfessionalQualification::where('user_id',$user_id)->get()->first();
        $professionalQualificaion->institution=$data['institution'];
        $professionalQualificaion->level=$data['level'];
        $professionalQualificaion->course=$data['course'];
        $professionalQualificaion->award=$data['award'];
        $professionalQualificaion->startDate=$data['startDate'];
        $professionalQualificaion->endDate=$data['endDate'];
        $professionalQualificaion->update();
        return response([
            'status'=>'success',
            'user'=>$professionalQualificaion
        ]);

    }
    public function list_professional_qualificaion(){
        $user_id = Auth::user()->id;
        $professionalQualificaions= ProfessionalQualification::where('user_id', $user_id)->get();

        return response([
            'status'=>'success',
            'user'=>$professionalQualificaions
        ]);
    }
}
