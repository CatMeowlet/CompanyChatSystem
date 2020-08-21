<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Profile;
use App\User;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('profile');
    }
    public function index2($id)
    {
        $profile = User::with('profile')->find($id);
        return view('visitingProfile')->with('visit_profile', $profile);
    }


    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'bio' => 'required',
            'files' => 'image|nullable|max:1999'
        ]);
        // GET CURRENT USER
        $auth_details = Auth::user();
        $auth_profile = Auth::user()->profile;
        // HANDLE FILE UPLOAD`
        if ($request->hasFile('files')) {

            // Delete current image before uploading new image
            if ($auth_profile->avatar !== 'default.png' || $auth_profile->avatar !== 'default.jpg') {
                $file = public_path('/assets/images/avatar/' . $auth_profile->avatar);
                if (File::exists($file)) {
                    unlink($file);
                }
            }
            // get filename with the extension
            $avatar = $request->file('files');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(150, 150)->save(public_path('/assets/images/avatar/' . $filename));
            $auth_profile->avatar = $filename;
        }

        $auth_profile->bio = $request->input('bio');
        $auth_details->name = $request->input('full_name');
        $auth_details->email = $request->input('email');
        $result = $auth_details->save();
        $result2 = $auth_profile->save();

        if ($result && $result2) {
            Session::flash('message', 'Profile updated successfuly!');
            Session::flash('alert-class', 'alert-success');
            return redirect('/profile');
        } else {
            Session::flash('message', 'Profile update failed!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/profile');
        }
    }
}
