@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('time-record') }}"><i class="fa fa-arrow-left mr-1"></i></a>
                        {{ __('Create new time record') }}
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('process-create-time-record-form') }}">
                            @csrf

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Init time</h5>
                                            <label for="init_time_input" class="card-subtitle mb-2 text-muted">
                                                The start time of the effective working time is
                                            </label>
                                            <input type="text" id="init_time_input" name="init_time"
                                                   class="card-subtitle mb-2 text-muted @error('init_time') is-invalid @enderror"
                                                   style="border: none; cursor: default">
                                            <div id="init_time_picker"></div>
                                        </div>
                                        @error('init_time')
                                        <div class="card-footer text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">End time</h5>
                                            <label for="end_time_input" class="card-subtitle mb-2 text-muted">
                                                The end time of the effective working time is
                                            </label>
                                            <input type="text" id="end_time_input" name="end_time"
                                                   class="card-subtitle mb-2 text-muted"
                                                   style="border: none; cursor: default">
                                            <div id="end_time_picker"></div>
                                        </div>
                                        @error('end_time')
                                        <div class="card-footer text-danger">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <label for="commentary">{{ __('What have you been doing during this time?') }}</label>
                                <textarea class="form-control" rows="3" id="commentary" name="commentary"></textarea>
                            </div>

                            <div class="form-group row">
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
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
@section('js_adhoc')
    <script src="{{ asset('js/vendor/picker.min.js') }}" defer></script>
    <script src="{{ asset('js/init/createTimeRecord.js') }}" defer></script>
@endsection
@section('css_adhoc')
    <link href="{{ asset('css/vendor/picker.min.css') }}" rel="stylesheet">
@endsection
