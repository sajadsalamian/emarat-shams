@extends('common.master')
@section('pageTitle', 'صفحه اصلی')

@section('content')
    <div class="main-route main-pad mt-4">
        <div class="wrapper">
            <a href="{{ route('Financial.root') }}">
                <div class="item" id="payslip">
                    <span></span>
                    <iconify-icon icon="la:money-check" width="40" height="40"></iconify-icon>
                    <p>امور مالی</p>
                </div>
            </a>
            <a href="{{ route('Project.all') }}">
                <div class="item" id="reports">
                    <span></span>
                    <iconify-icon icon="emojione-monotone:building-construction" width="40" height="40">
                    </iconify-icon>
                    <p>گزارش کارکرد پروژه</p>
                </div>
            </a>
            <a href="{{ route('Timesheet.all') }}">
                <div class="item" id="timesheet">
                    <span></span>
                    <iconify-icon icon="fluent-mdl2:time-entry" width="35" height="35"></iconify-icon>
                    <p>ساغت ورود و خروج</p>
                </div>
            </a>
            <a href="{{ route('User.all') }}">
                <div class="item" id="employees">
                    <span></span>
                    <iconify-icon icon="clarity:employee-group-line" width="40" height="40"></iconify-icon>
                    <p>لیست کارکنان</p>
                </div>
            </a>
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button id="logout" class="btn item w-100 text-end">
                    <span></span>
                    <iconify-icon icon="carbon:logout" width="40" height="40" flip="horizontal"></iconify-icon>
                    <p>خروج</p>
                </button>
            </form>
        </div>
    </div>
@endsection
