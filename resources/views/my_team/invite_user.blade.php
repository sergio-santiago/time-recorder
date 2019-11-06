@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('my-team') }}"><i class="fa fa-arrow-left mr-1"></i></a>
                        {{ __('Invite new user') }}
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('process-invite-user-form') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="link_hash"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Link hash') }}</label>

                                <div class="col-md-6">
                                    <input id="link_hash" type="text"
                                           class="form-control @error('link_hash') is-invalid @enderror"
                                           name="link_hash" required autocomplete="link_hash" autofocus>

                                    @error('link_hash')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Join to the company') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
