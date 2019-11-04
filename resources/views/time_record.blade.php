@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Time record</div>

                    <div class="card-body">
                        @if (Auth::user()->is_admin)
                            <div class="mb-4">

                                <a href="">
                                    <button type="button" class="btn btn-primary">New record</button>
                                </a>
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Init time</th>
                                <th scope="col">End time</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($timeRecords as $record)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($record->init_time)->format('H:i:s')}}</td>
                                    <td>{{\Carbon\Carbon::parse($record->end_time)->format('H:i:s')}}</td>
                                    <td><a href="">
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </a>
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
@endsection
