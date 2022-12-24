@extends('common.master')
@section('backRoute', route('main'))
@section('pageTitle', 'برنامه حضور و غیاب')

@section('content')
    <div class="timesheet">
        <div class="main-pad">
            <a href="{{ route('Timesheet.add') }}" class="btn btn-primary">افزودن زمان ورود و خروج</a>
            <table class="table table-striped my-4">
                <thead>
                    <tr>
                        <th>تاریخ</th>
                        <th>ساعت ورود</th>
                        <th>ساعت خروج</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timesheets as $time)
                        <tr>
                            <td>{{ $time->persian_date }}</td>
                            <td>{{ $time->start_time }}</td>
                            <td>{{ $time->end_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
