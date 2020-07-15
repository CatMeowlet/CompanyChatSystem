<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        /*
        if set to guest only
            when logged in with user account you can't access the url for admin/login
        */
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }
    public function login(Request $request)
    {
        // validate form
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // $credentials = $request->only('email', 'password');

        //Attempt login user Auth::guard(admin)->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful then redirect to their intended location
            return redirect()->intended(route('admin.home'));
        } else {
            // if unsuccessful, then redirect back to login with form data
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
