@extends('common.master')
@section('backRoute', route('Timesheet.all'))
@section('pageTitle', 'افزودن اعلان')

@section('content')
    <div class="timesheet">
        <div class="main-pad">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('success') !!}</p>
                </div>
            @endif
            <form action="{{ route('Timesheet.store') }}" method="post" class="form-element">
                @csrf
                <div class="mb-3">
                    <label for="date" class="form-label">تاریخ</label>
                    <div class="row">
                        <div class="col-4">
                            <label for="">روز</label>
                            <select class="form-select inputDay" aria-label="Default select example" id="inputDay"
                                name="day">
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="">ماه</label>
                            <select class="form-select inputMonth" aria-label="Default select example" id="inputMonth"
                                name="month">
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="">سال</label>
                            <select class="form-select inputYear" aria-label="Default select example" id="inputYear"
                                name="year">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="startTime" class="form-label">زمان ورود</label>
                    <div class="row">
                        <div class="col-6">
                            <label for="">دقیقه</label>
                            <select class="form-select inputMinute" aria-label="Default select example" id="inputMinute"
                                name="startMinute">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="">ساعت</label>
                            <select class="form-select inputHour" aria-label="Default select example" id="inputHour"
                                name="starHour">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="startTime" class="form-label">زمان خروج</label>
                    <div class="row">
                        <div class="col-6">
                            <label for="">دقیقه</label>
                            <select class="form-select inputMinute" aria-label="Default select example" id="inputMinute"
                                name="endMinute">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="">ساعت</label>
                            <select class="form-select inputHour" aria-label="Default select example" id="inputHour"
                                name="endHour">
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">ارسال</button>
            </form>
        </div>
    </div>
@endsection
