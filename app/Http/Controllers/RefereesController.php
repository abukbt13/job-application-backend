<?php

namespace App\Http\Controllers;

use App\Models\Referee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RefereesController extends Controller
{
    public function store(Request $request){
        $rules=[
            'fullName' => 'required',
            'occupation' => 'required',
            'phone' => 'required',
            'email' => 'required',
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
        $referee=new Referee();
        $referee->fullName=$data['fullName'];
        $referee->occupation=$data['occupation'];
        $referee->phone=$data['phone'];
        $referee->email=$data['email'];
        $referee->user_id=$user_id;
        $referee->save();

        return response([
            'message'=>'Success',
            'data'=>$referee
        ]);
    }
}
