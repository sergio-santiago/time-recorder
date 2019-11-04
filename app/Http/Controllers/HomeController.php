<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user['company'] === null) {
            return view('no_company', ['linkHash' => $user['link_hash']]);
        }

        if ($user['is_admin']) {
            return redirect()->route('my-team');
        }

        return redirect()->route('time-record');
    }

    public function renderChangePasswordForm()
    {
        return view('auth.passwords.change_password');
    }

    public function processChangePasswordForm(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make(
            $request->all(),
            [
                'old_password' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );

        if ($validator->fails()) {
            return view('auth.passwords.change_password')
                ->withErrors($validator);
        }

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            $request->session()->flash('alert-success', 'Password changed successfully!');
        } else {
            $validator->errors()->add('old_password', 'Old password incorrect');
        }

        return view('auth.passwords.change_password')
            ->withErrors($validator);
    }
}
