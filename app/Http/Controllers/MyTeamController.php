<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MyTeamController extends Controller
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
        $companions = DB::table('users')
            ->where('company_id', $user['company_id'])
            ->get();

        return view('my_team', ['team' => $companions]);
    }

    public function renderInviteUserForm()
    {
        return view('invite_user');
    }


    public function processInviteUserForm(Request $request)
    {
        $companyId = Auth::user()->company_id;

        //Form validations
        $validator = Validator::make(
            $request->all(),
            [
                'link_hash' => ['required', 'string'],
            ]
        );

        if ($validator->fails()) {
            return view('invite_user')->withErrors($validator);
        }

        $invited = DB::table('users')
            ->where('link_hash', $request->link_hash)
            ->first();

        if (empty($invited)) {
            $validator->errors()->add('link_hash', 'Link hash not associated with any user');
            return view('invite_user')
                ->withErrors($validator);
        }

        if ($invited->company_id !== null) {
            $validator->errors()->add('link_hash', 'The guest user is already associated with a company, you must leave before joining another');
            return view('invite_user')
                ->withErrors($validator);
        }

        DB::table('users')
            ->where('id', $invited->id)
            ->update([
                'is_admin' => false,
                'company_id' => $companyId,
            ]);
        $request->session()->flash('alert-success', 'User added to company successfully!');

        return redirect('my-team');
    }

    public function processToogleRoleForm(Request $request)
    {
        $companyId = Auth::user()->company_id;

        $user = DB::table('users')
            ->where('id', $request->user_id)
            ->first();

        if (empty($user)) {
            $request->session()->flash('alert-danger', 'User not exist!');
            return redirect('my-team');
        }

        if ($user->company_id !== $companyId) {
            $request->session()->flash('alert-danger', 'User does not belong to your company!');
            return redirect('my-team');
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'is_admin' => (!empty($request->is_admin)) ? true : false,
            ]);
        $request->session()->flash('alert-success', 'User role changed successfully!');
        return redirect('my-team');
    }
}
