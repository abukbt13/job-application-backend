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
        $path = $request->file('file')->store('public/Documents');
        $filename = basename($path);
        $document = new Document();
        $document->name = $request->name;
        $document->description = $request->description;
        $document->file = $filename;
        $document->user_id = Auth::user()->id;
        $document->save();

       return response([
            'message'=>'Success',
            'data'=>$document
        ]);
    }
    public function list_documents(){
        $user_id = Auth::user()->id;
        $documents=Document::where('user_id','=',$user_id)->get();
        return response([
            'status' => 'Success',
            'data' => $documents
        ]);
    }
}



