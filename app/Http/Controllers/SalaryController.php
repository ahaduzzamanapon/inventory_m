<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SalaryController extends Controller
{
    public function index(){
        $user = User::all();
        return view('salary.index',compact('user'));
    }
}
