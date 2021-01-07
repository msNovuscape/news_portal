<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    protected $redirectTo = '/admin/dashboard';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {

        if (auth()->user())
        {

            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }
    public function adminAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->has('remember')))
        {
            return redirect()->route('admin.dashboard');
        }else{
            $errordata = array('email' => 'Username or Password is incorrect', );
            return redirect()->back()->withErrors($errordata)
                ->withInput();
        }
    }

    public function logOut(Request $request)
    {
        Auth::logout();
        return redirect('/admin/login');
    }

}
