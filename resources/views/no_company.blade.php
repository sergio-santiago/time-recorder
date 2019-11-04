@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">You are not associated with any company</div>

                    <div class="card-body">
                        <p>You are not yet associated with any company</p>
                        <hr>
                        <p>Your invitation hash is:</p>
                        <p style="font-size: 1.5em">{{$linkHash}}</p>
                        <hr>
                        <p>Share it with an administrator so I can invite you</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
