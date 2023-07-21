<?php

namespace App\Http\Controllers;

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
    public function list_professional_qualificaion(){
        $user_id = Auth::user()->id;
        $professionalQualificaions= ProfessionalQualification::where('user_id', $user_id)->get();

        return response([
            'status'=>'success',
            'user'=>$professionalQualificaions
        ]);
    }
}
