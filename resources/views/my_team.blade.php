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
                                        <td>
                                            <button type="button" class="btn btn-link" data-toggle="modal"
                                                    data-target="#exampleModal">
                                                Change role
                                            </button>
                                            <a href="">
                                                <button type="button" class="btn btn-danger">Delete</button>
                                            </a>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
