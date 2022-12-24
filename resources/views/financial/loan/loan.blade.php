@extends('common.master')
@section('backRoute', route('Financial.root'))
@section('pageTitle', 'امور مالی')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            <div class="financial">
                <div class="loan-list">
                    <div class="d-flex justify-content-between mb-4" style=" border-bottom: 1px solid #a3a3a3">
                        <p style="margin-right: 45px;">نام</p>
                        <p>نوع درخواست</p>
                        <p>مقدار</p>
                        @if (auth()->user()->role == 0)
                            <p>تایید</p>
                        @else
                            <p>وضعیت</p>
                        @endif
                        <p>دیدن</p>
                    </div>
                    @foreach ($loans as $loan)
                        <div class="item mb-5 loan-items">
                            @if ($loan->type == 1)
                                <div class="icon" style="background-color: #e44e0c">
                                    <iconify-icon icon="gala:help" style="color: white;" width="20" height="20">
                                    </iconify-icon>
                                </div>
                            @else
                                <div class="icon" style="background-color: #db8000">
                                    <iconify-icon icon="heroicons:cube-transparent" style="color: white;" width="20"
                                        height="20">
                                    </iconify-icon>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between">
                                <p>{{ $loan->user_name }}</p>
                                <p>{{ $loan->type_name }}</p>
                                <p>{{ $loan->amount }}</p>
                                @if (auth()->user()->role == 0)
                                    <form action="" method="POST">
                                        @csrf
                                        <button class="btn p-0">
                                            <iconify-icon icon="mdi:forward-outline" style="color: #198754;;" width="32"
                                                height="32" flip="horizontal"></iconify-icon>
                                        </button>
                                    </form>
                                @else
                                <p>{{ $loan->status_name }}</p>
                                @endif
                                <a href="{{ route('Loan.view', $loan->id) }}">
                                    <iconify-icon icon="charm:eye" width="24" height="24"></iconify-icon>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
