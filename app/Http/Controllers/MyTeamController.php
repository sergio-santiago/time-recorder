<?php

namespace App\Http\Controllers;

use App\TimeRecord;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

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
        $companions = User::where('company_id', $user['company_id'])->get();

        return view('my_team', ['team' => $companions]);
    }

    /**
     * @return Factory|View
     */
    public function renderInviteUserForm()
    {
        return view('invite_user');
    }

    /**
     * @param Request $request
     * @return Factory|RedirectResponse|Redirector|View
     */
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

        $invited = User::where('link_hash', $request->link_hash)->first();

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

        User::where('id', $invited->id)->update([
            'is_admin' => false,
            'company_id' => $companyId,
        ]);
        $request->session()->flash('alert-success', 'User ' . $invited->name . ' added to company successfully!');

        return redirect('my-team');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function processToogleRoleForm(Request $request)
    {
        $companyId = Auth::user()->company_id;

        $user = User::where('id', $request->user_id)->first();

        if (empty($user)) {
            $request->session()->flash('alert-danger', 'User not exist!');
            return redirect('my-team');
        }

        if ($user->company_id !== $companyId) {
            $request->session()->flash('alert-danger', 'User does not belong to your company!');
            return redirect('my-team');
        }

        if ((empty($request->is_admin) && !$user->is_admin) || ($request->is_admin !== null && $user->is_admin)) {
            $request->session()->flash('alert-info', 'The user\'s role has not been changed');
            return redirect('my-team');
        }

        User::where('id', $user->id)->update(['is_admin' => (!empty($request->is_admin)) ? true : false]);
        $request->session()->flash('alert-success', 'User role changed successfully!');
        return redirect('my-team');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function processRemoveUserForm(Request $request)
    {
        $companyId = Auth::user()->company_id;

        $user = User::where('id', $request->user_id)->first();

        if (empty($user)) {
            $request->session()->flash('alert-danger', 'User not exist!');
            return redirect('my-team');
        }

        if ($user->company_id !== $companyId) {
            $request->session()->flash('alert-danger', 'User does not belong to your company!');
            return redirect('my-team');
        }

        User::where('id', $user->id)->update([
            'company_id' => null,
            'is_admin' => false,
            'link_hash' => Str::random(15),
        ]);

        TimeRecord::where('user_id', $user->id)->delete();
        $request->session()->flash('alert-success', 'User removed from company successfully!');
        return redirect('my-team');
    }
}
