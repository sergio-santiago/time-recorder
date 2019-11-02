@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">You are not associated with any company</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <p>You are not yet associated with any company. Your invitation hash is <b> {{$linkHash}} </b>. Share it with an administrator so I can invite you.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
