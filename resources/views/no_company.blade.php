@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>They are not associated with any company yet. Your invitation hash is <b>{{ $linkHash }}</b>. Share with an admin so I can invite you.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
