<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = $this->getUserWithRole();

        return view('user.component.profile', compact('user'));
    }

    public function showEmail()
    {   
        $user = $this->getUserWithRole();

        return view('user.component.email_detail', compact('user'));
    }

    public function showInformation()
    {   
        $user = $this->getUserWithRole();

        return view('user.component.information_detail', compact('user'));
    }

    public function showLocalization()
    {   
        $user = $this->getUserWithRole();

        return view('user.component.localization', compact('user'));
    }

    public function getUserWithRole()
    {
        $user = Auth::user();
        $user->load('role');

        return $user;
    }
}
