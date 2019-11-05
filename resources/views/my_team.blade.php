@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My team</div>
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
                                    @if (Auth::user()->is_admin)
                                        @if (Auth::user()->id === $user->id)
                                            <td>
                                                <button type="button" class="btn btn-link switch-role-modal-js"
                                                        data-toggle="modal" data-target="#switchRoleModal"
                                                        data-user-id="{{$user->id}}" data-is-admin="{{$user->is_admin}}"
                                                        disabled>
                                                    Change role
                                                </button>
                                                <a href="">
                                                    <button type="button" class="btn btn-outline-danger" disabled>Delete
                                                    </button>
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                <button type="button" class="btn btn-link switch-role-modal-js"
                                                        data-toggle="modal" data-target="#switchRoleModal"
                                                        data-user-id="{{$user->id}}"
                                                        data-is-admin="{{$user->is_admin}}">
                                                    Change role
                                                </button>
                                                <a href="">
                                                    <button type="button" class="btn btn-outline-danger">Delete</button>
                                                </a>
                                            </td>
                                        @endif
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
@endsection
