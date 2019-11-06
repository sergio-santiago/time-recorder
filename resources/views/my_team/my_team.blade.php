@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">My team members</div>
                    <div class="card-body">
                        @if (Auth::user()->is_admin)
                            <div class="mb-4">
                                <a href="{{ route('render-invite-user-form') }}">
                                    <button type="button" class="btn btn-primary">
                                        Invite new user
                                    </button>
                                </a>
                            </div>
                        @endif
                        <table class="table">
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
                                        @if($user->totalIntervalToday['hours'] == 0 && $user->totalIntervalToday['minutes'] == 0)
                                            <span class="badge badge-danger">None</span>
                                        @else
                                            <span class="badge badge-success">{{$user->totalIntervalToday['hours']}} hours @if($user->totalIntervalToday['minutes'] != 0)
                                                    and {{$user->totalIntervalToday['minutes']}} minutes @endif</span>
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
    <script src="{{ asset('js/init/switchRoleModal.js') }}" defer></script>
    <script src="{{ asset('js/init/removeUserModal.js') }}" defer></script>
@endsection
