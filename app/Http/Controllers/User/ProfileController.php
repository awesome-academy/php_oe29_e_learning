<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Auth;
use Alert;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = $this->getUserWithRole();
        $user->load('image');

        return view('user.component.profile', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {   
        $flag = $user->update($request->all());
        if ($flag) {
            Alert::success(trans('label.updated_success'));
        }

        return redirect()->route('settings');
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

    public function showGithub()
    {   
        $user = $this->getUserWithRole();

        return view('user.component.github_detail', compact('user'));
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

    public function postAvatar(UpdateUserRequest $request, User $user)
    {
        $user->load('image');
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = time() . $file->getClientOriginalName();
            $path = public_path(config('img.img_path'));
            $file->move($path, $name);
        }
        if (is_null($user->image)) {
            $user->image()->create(['url' => $name]);
        } else {
            $user->image->url = $name;
            $user->image->save();
        }

        return redirect()->route('settings');
    }
}
