@extends('common.master')
@section('backRoute', route('main'))
@section('pageTitle', 'امور مالی')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            <div class="financial">
                <a href="{{ route('Payslip.all') }}">
                    <div class="item">
                        <div class="icon" style="background-color: #2f26da">
                            <iconify-icon icon="game-icons:money-stack" style="color: white;" width="30" height="30">
                            </iconify-icon>
                        </div>
                        <p class="mb-0">فیش حقوقی</p>
                        <p class="desc text-muted">شما می توانید فیش حقوقی خود را اینجا ببینید</p>
                    </div>
                </a>
                <a href="{{ route('Loan.all') }}">
                    <div class="item">
                        <div class="icon" style="background-color: #07cc87">
                            <iconify-icon icon="game-icons:money-stack" style="color: white;" width="30" height="30">
                            </iconify-icon>
                        </div>
                        <p class="mb-0">در خواست وام / مساعده</p>
                        <p class="desc text-muted">در این قسمت شما می توانید درخواست مساعدت یا وام بکنید</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
