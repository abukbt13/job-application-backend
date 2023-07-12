<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DocumentsController extends Controller
{
    public function store(Request $request){
        $rules=[
            'name' => 'required',
            'description' => 'required',
            'file' => 'required',
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
        $document=new Document();
        $document->name=$data['name'];
        $document->description=$data['description'];
        $document->file=$data['file'];
        $document->user_id=$user_id;
        $document->save();

        return response([
            'message'=>'Success',
            'data'=>$document
        ]);
    }
}
