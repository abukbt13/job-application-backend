<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PersonalInformationsController extends Controller
{
    public function store(Request $request){
        $rules=[
            'idNo' => 'required|unique:personal_information',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'county' => 'required',
            'constituency' => 'required',
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
        $personalInfo=new PersonalInformation();
        $personalInfo->idNo=$data['idNo'];
        $personalInfo->firstName=$data['firstName'];
        $personalInfo->lastName=$data['lastName'];
        $personalInfo->phone=$data['phone'];
        $personalInfo->gender=$data['gender'];
        $personalInfo->address=$data['address'];
        $personalInfo->county=$data['county'];
        $personalInfo->constituency=$data['constituency'];
        $personalInfo->user_id=$user_id;
        $personalInfo->save();
//        PersonalInformation::where('user_id',$user_id) ? $personalInfo->update() : $personalInfo->save();
        return response([
            'message'=>'Success',
            'data'=>$personalInfo
        ]);
    }
    public function list_personal_info(){
        $user_id= Auth::user()->id;
        $personalInfo= PersonalInformation::where('user_id',$user_id)->get();

        return response([
            'status'=>'success',
            'user'=>$personalInfo
        ]);
    }
}
