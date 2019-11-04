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

                                <a href="">
                                    <button type="button" class="btn btn-primary">Invite new user</button>
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
                            @foreach ($team as $user)
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
                                            <a href="">
                                                <button type="button" class="btn btn-secondary">Edit</button>
                                            </a>
                                            <a href="">
                                                <button type="button" class="btn btn-danger">Delete</button>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
