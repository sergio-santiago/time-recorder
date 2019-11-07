@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Time records today</div>

                    <div class="card-body">
                        <div class="mb-4">
                            <a href="{{ @route('render-create-time-record-form') }}">
                                <button type="button" class="btn btn-primary">
                                    Create new record
                                </button>
                            </a>
                            <div class="float-right">
                                <span>Total effective work today</span>
                                <br>
                                @if($user->total_interval_user->hours == 0 && $user->total_interval_user->minutes == 0)
                                    <span class="badge badge-danger float-right">None</span>
                                @else
                                    <span class="badge badge-success float-right">
                                        {{$user->total_interval_user->hours}} hours @if($user->total_interval_user->minutes != 0)
                                            and {{$user->total_interval_user->minutes}} minutes @endif
                                    </span>
                                @endif
                            </div>
                        </div>
                        <table class="table" id="time_record_table">
                            <thead>
                            <tr>
                                <th scope="col">Init time</th>
                                <th scope="col">End time</th>
                                <th scope="col">Interval time</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($timeRecords as $record)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($record->init_time)->format('H:i')}}</td>
                                    <td>{{\Carbon\Carbon::parse($record->end_time)->format('H:i')}}</td>
                                    <td>
                                        {{$record->interval_time->hours}}
                                        hours @if($record->interval_time->minutes != 0)
                                            and {{$record->interval_time->minutes}} minutes @endif
                                    </td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-outline-danger remove-time-record-modal-js btn-sm"
                                                data-toggle="modal" data-target="#removeTimeRecordModal"
                                                data-time-record-id="{{$record->id}}">
                                            Delete record
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"><h4>No records yet</h4></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.remove_time_record_modal')
@endsection

@section('js_adhoc')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js" defer></script>
    <script src="{{ asset('js/init/removeTimeRecordModal.js') }}" defer></script>
    <script src="{{ asset('js/init/timeRecordDataTables.js') }}" defer></script>
@endsection
@section('css_adhoc')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
@endsection
