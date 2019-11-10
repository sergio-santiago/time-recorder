@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Search time records of my team</div>
                    <div class="card-body">
                        <div class="mb-4">
                            <form method="POST" action="{{ route('process-search-time-records-form') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-5">
                                        <label class="col-form-label text-md-right">
                                            {{ __('Select dates range') }}
                                        </label>
                                        <div id="reportrange" class="p-2"
                                             style="border: 1px solid #aaa; border-radius: 4px; cursor: text">
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span> <i class="fa fa-caret-down float-right mr-2 mt-1"></i>
                                        </div>
                                        <input id="init_date" type="hidden" class="form-control" name="init_date">
                                        <input id="end_date" type="hidden" class="form-control" name="end_date">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="search_time_records_user_ids" class="col-form-label text-md-right">
                                            {{ __('Select team members') }}
                                        </label>
                                        <br>
                                        <select class="form-control select2" id="search_time_records_user_ids"
                                                name="user_ids[]"
                                                multiple="multiple">
                                            @foreach($teamMembers as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary float-right m-4 p-3 mr-5">
                                            <i class="fa fa-filter mr-1"></i>
                                            Filter time records
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <table class="table" id="search_time_records_table">
                                <thead>
                                <tr>
                                    <th scope="col">Owner</th>
                                    <th scope="col">Init time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Interval time</th>
                                    <th scope="col">Commentary</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($timeRecords as $record)
                                    <tr>
                                        <td>{{$record->userName}}</td>
                                        <td>{{\Carbon\Carbon::parse($record->init_time)->format('H:i')}}</td>
                                        <td>{{\Carbon\Carbon::parse($record->end_time)->format('H:i')}}</td>
                                        <td>
                                            {{$record->interval_time->hours}} hours
                                            @if($record->interval_time->minutes != 0)
                                                and {{$record->interval_time->minutes}} minutes
                                            @endif
                                        </td>
                                        <td>
                                            @if($record->commentary)
                                                <button type="button"
                                                        class="btn btn-outline-secondary show-time-record-commentary-modal-js btn-sm"
                                                        data-toggle="modal" data-target="#showTimeRecordCommentaryModal"
                                                        data-comment="{{$record->commentary}}">
                                                    Show comment
                                                </button>
                                            @else
                                                <span class="badge badge-danger">None</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td><h4>No records</h4></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th scope="col">Owner</th>
                                    <th scope="col">Init time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Interval time</th>
                                    <th scope="col">Commentary</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.show_time_record_commentary_modal')
@endsection

@section('js_adhoc')
    <script src="{{ asset('js/vendor/datatables.min.js') }}" defer></script>
    <script src="{{ asset('js/init/showTimeRecordCommentaryModal.js') }}" defer></script>
    <script src="{{ asset('js/init/searchTimeRecordsDataTables.js') }}" defer></script>
    <script src="{{ asset('js/vendor/moment.min.js') }}" defer></script>
    <script src="{{ asset('js/vendor/daterangepicker.min.js') }}" defer></script>
    <script src="{{ asset('js/init/searchTimeRecordsDaterangepicker.js') }}" defer></script>
    <script src="{{ asset('js/vendor/select2.min.js') }}" defer></script>
    <script src="{{ asset('js/init/searchTimeRecordsUserIdsSelect2.js') }}" defer></script>
@endsection
@section('css_adhoc')
    <link href="{{ asset('css/vendor/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/select2.min.css') }}" rel="stylesheet">
@endsection
