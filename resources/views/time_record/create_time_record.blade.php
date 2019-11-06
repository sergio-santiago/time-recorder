@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('time-record') }}"><i class="fa fa-arrow-left mr-1"></i></a>
                        {{ __('Create new time record') }}
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('process-create-time-record-form') }}">
                            @csrf



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Create new time record') }}
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
