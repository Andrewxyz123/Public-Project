<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function userRole(){
        $id = Auth::id();
        $role = DB::table('users')->where('id', $id)->value('role');
        return $role;

    }


    public function init(Request $request){

        $userRole = HomeController::userRole();
        return view('/user-page', compact('userRole'));
    }

}
