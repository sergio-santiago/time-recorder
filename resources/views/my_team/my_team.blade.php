@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My team members</div>
                    <div class="card-body">
                        <div class="mb-4">
                            @if (Auth::user()->is_admin)
                                <a href="{{ route('render-invite-user-form') }}">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-user-plus mr-1"></i>
                                        Invite new user
                                    </button>
                                </a>
                                <div class="float-right">
                                    <span>Total team work time today</span>
                                    <br>
                                    @if($company->total_interval_company->hours == 0 && $company->total_interval_company->minutes == 0)
                                        <span class="badge badge-danger float-right">None</span>
                                    @else
                                        <span class="badge badge-success float-right">
                                        {{$company->total_interval_company->hours}} hours @if($company->total_interval_company->minutes != 0)
                                                and {{$company->total_interval_company->minutes}} minutes @endif
                                    </span>
                                    @endif
                                </div>
                            @else
                                <div>
                                    <span>Total team work time today</span>
                                    @if($company->total_interval_company->hours == 0 && $company->total_interval_company->minutes == 0)
                                        <span class="badge badge-danger ml-2">None</span>
                                    @else
                                        <span class="badge badge-success ml-2">
                                        {{$company->total_interval_company->hours}} hours @if($company->total_interval_company->minutes != 0)
                                                and {{$company->total_interval_company->minutes}} minutes @endif
                                    </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <table class="table" id="my_team_table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Is admin</th>
                                <th scope="col">Total effective work today</th>
                                @if (Auth::user()->is_admin)
                                    <th scope="col">Actions</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($team as $user)
                                <tr>
                                    <th scope="row">{{$user->name}}</th>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->is_admin)
                                            <i class="fa fa-check"></i>
                                        @else
                                            <i class="fa fa-times"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->total_interval_user->hours == 0 && $user->total_interval_user->minutes == 0)
                                            <span class="badge badge-danger">None</span>
                                        @else
                                            <span class="badge badge-success">{{$user->total_interval_user->hours}} hours @if($user->total_interval_user->minutes != 0)
                                                    and {{$user->total_interval_user->minutes}} minutes @endif</span>
                                        @endif
                                    </td>
                                    @if (Auth::user()->is_admin)
                                        <td>

                                            <button type="button"
                                                    class="btn btn-outline-secondary switch-role-modal-js btn-sm"
                                                    data-toggle="modal" data-target="#switchRoleModal"
                                                    data-user-id="{{$user->id}}" data-is-admin="{{$user->is_admin}}"
                                                    @if (Auth::user()->id === $user->id) disabled @endif>
                                                Change role
                                            </button>

                                            <button type="button"
                                                    class="btn btn-outline-danger remove-user-modal-js btn-sm"
                                                    data-toggle="modal" data-target="#removeUserModal"
                                                    data-user-id="{{$user->id}}"
                                                    @if (Auth::user()->id === $user->id) disabled @endif>
                                                Remove from company
                                            </button>

                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"><h4>No team members yet</h4></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.switch_role_modal')
    @include('partials.remove_user_modal')
@endsection

@section('js_adhoc')
    <script src="{{ asset('js/vendor/datatables.min.js') }}" defer></script>
    <script src="{{ asset('js/init/switchRoleModal.js') }}" defer></script>
    <script src="{{ asset('js/init/removeUserModal.js') }}" defer></script>
    <script src="{{ asset('js/init/myTeamDataTables.js') }}" defer></script>
@endsection
@section('css_adhoc')
    <link href="{{ asset('css/vendor/datatables.min.css') }}" rel="stylesheet">
@endsection
