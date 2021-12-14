<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        //$person = Person::where("user_id", auth()->id())->first();
        $user = User::where("id", auth()->id())->select("id","email", "rol")->first();
        $user->person = Person::where("user_id", auth()->id())->first();
        //dd($user);
        return view("admin.index", ["user"=>$user]);
    }
}
