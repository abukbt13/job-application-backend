<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    public function list_users_applied(){
        $users_applied = User::where([
            ['status', '=', 'applied']
        ])->get();

        return response([$users_applied]);
    }
}
