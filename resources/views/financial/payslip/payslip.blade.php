@extends('common.master')
@section('backRoute', route('Financial.root'))
@section('pageTitle', 'فیش حقوقی')

@section('content')
    <div class="notif-list">
        <div class="main-pad">
            <div class="items mt-4">
                <div class="mb-4">
                    <a href="{{ route('Payslip.import') }}" class="btn btn-primary ms-3">بارگذاری فایل اکسل</a>
                    <a href="{{ route('Payslip.single.add') }}" class="btn btn-success ms-3">افزودن فیش حقوقی</a>
                </div>
                @foreach ($payslips as $payslip)
                    <a href="{{ route('Payslip.view', $payslip->id) }}">
                        <div class="item">
                            <div class="icon" style="background-color: #2f26da">
                                <iconify-icon icon="game-icons:money-stack" style="color: white;" width="30"
                                    height="30">
                                </iconify-icon>
                            </div>
                            <p class="mb-0">{{ $payslip->title }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
