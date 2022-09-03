<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpKernel\Profiler\Profile;

class HomeController extends Controller
{
    public function redirect(){
        $isAdmin=Auth::user()->isAdmin;

        if($isAdmin)
        {
            return view('adminhome');
        }
        else{
            $doctor = Auth::user();
            return view('Doctor.profile')->with('doctor', $doctor);
        }
    }
}
