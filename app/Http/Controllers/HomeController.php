<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

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
}