<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Traits\FileUpload;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Flasher\Notyf\Prime\notyf;

class ProfileController extends Controller
{
    use FileUpload;

    function  index()
    {
        $user = Auth::user();
        return view('frontend.dashboard.profile.index', compact('user'));
    }

    function update(ProfileUpdateRequest $request) : RedirectResponse
    {

        $user = Auth::user();
        if($request->hasFile('avatar')) {
            $avatarPath = $this->uploadFile($request->avatar);
            $user->avatar = $avatarPath;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->save();

        notyf()->info('Profile updated successfully.');
        return redirect()->back();

    }


    function updatePassword(PasswordUpdateRequest $request) : RedirectResponse{
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        notyf()->info('Password updated successfully.');
        return redirect()->back();
    }

}
