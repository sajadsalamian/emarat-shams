@extends('common.master')
@section('backRoute', route('Loan.all'))
@section('pageTitle', 'امور مالی')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            <div class="financial">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{!! \Session::get('success') !!}</p>
                    </div>
                @endif
                <div class="loan-list mb-5">
                    <div class="d-flex justify-content-between">
                        <p>نام درخواست کننده</p>
                        <p>{{ $loan->user_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>نوع در خواست</p>
                        <p>{{ $loan->type_name }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>مبلغ درخواستی</p>
                        <p>{{ $loan->amount }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>وضعیت</p>
                        <p>{{ $loan->status_name }}</p>
                    </div>
                    @if ($loan->status != 1)
                        <div class="d-flex justify-content-between">
                            <p>میزان موافقت شده</p>
                            <p>{{ $loan->accepted_amount }}</p>
                        </div>
                    @endif
                    @if ($loan->type == 1)
                        <div class="d-flex justify-content-between">
                            <p>درصد سود</p>
                            <p>%{{ $loan->percentage }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>میزان کل بازگشتی</p>
                            <p>{{ $loan->return_amount }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>تعداد ماه های بازگشت</p>
                            <p>{{ $loan->return_month }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>تاریخ شروع بازپرداخت</p>
                            <p>{{ $loan->start_date }}</p>
                        </div>
                    @endif
                    @foreach ($loan_docs as $doc)
                        <img src="{{ $doc->file }}" alt="" class="mb-4">
                    @endforeach
                </div>
                @if ($loan->type == 2)
                    @if (auth()->user()->role == 0 && $loan->status == 1)
                        <form action="{{ route('Loan.confirm', $loan->id) }}" method="post" class="form-element">
                            @csrf
                            <div class="mb-3">
                                <label for="accepted_amount" class="form-label">مبلغ موافقت شده</label>
                                <input type="text" class="form-control" id="accepted_amount" name="accepted_amount"
                                    value="{{ old('accepted_amount') }}">
                                <span class="text-danger">
                                    @error('accepted_amount')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </form>
                    @endif
                    @if (auth()->user()->role == 0 || auth()->user()->role == 5)
                        @if ($loan->status == 2)
                            <form action="{{ route('Loan.saveDoc', $loan->id) }}" method="post" class="form-element"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-auto">
                                        <label for="loan_doc" class="form-label">فیش یا سند پرداختی</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="file" class="form-control" id="loan_doc" name="loan_doc[]"
                                            multiple>
                                        <span class="text-danger">
                                            @error('loan_doc')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">تخصیص</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endif
                @else
                    @if (!$loanPayment->isEmpty())
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col">شماره قصد</th>
                                    <th scope="col">میزان قصد</th>
                                    <th scope="col">تاریخ سررسید</th>
                                    <th scope="col">پرداخت شده</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loanPayment as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->date }}</td>
                                        @if ($payment->isPaid == 0)
                                            <td>
                                                <iconify-icon icon="ph:x-bold" style="color: #c0392b;" width="24"
                                                    height="24"></iconify-icon>
                                            </td>
                                        @else
                                            <td>
                                                <iconify-icon icon="material-symbols:check-small" style="color: #50c878;"
                                                    width="40" height="40"></iconify-icon>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if (auth()->user()->role == 0)
                        <form action="{{ route('Loan.confirm', $loan->id) }}" method="post" class="form-element">
                            @csrf
                            <div class="mb-3">
                                <label for="accepted_amount" class="form-label">اطلاعات تاییدی</label>
                            </div>
                            <div class="row g-3">
                                <div class="col-auto">
                                    <label for="accepted_amount" class="form-label">مقدار موافقت شده</label>
                                    <input type="text" class="form-control" id="accepted_amount" name="accepted_amount"
                                           onchange="calculateTotalLoanAmount()" value="{{ old('accepted_amount') }}">
                                    <span class="text-danger">
                                        @error('accepted_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <label for="percentages" class="form-label">درصد سود</label>
                                    <input type="number" min="0" max="100"step="0.1" class="form-control"
                                        id="percentages" name="percentages" onchange="calculateTotalLoanAmount()"
                                        value="{{ old('percentages') }}">
                                    <span class="text-danger">
                                        @error('percentages')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <label for="return_amount" class="form-label">کل مبلغ برگشتی</label>
                                    <input type="text" class="form-control" id="return_amount" name="return_amount"
                                        value="{{ old('return_amount') }}" readonly>
                                </div>
                                <div class="col-auto">
                                    <label for="return_month" class="form-label">تعداد ماه باز پرداخت</label>
                                    <input type="number" class="form-control" id="return_month" name="return_month"
                                        value="{{ old('return_month') }}">
                                    <span class="text-danger">
                                        @error('return_month')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <label for="" class="form-label">تاریخ شروع باز پرداخت</label>
                                    <div class="row">
                                        <div class="col-5 px-1">
                                            <select class="form-select inputMonth" aria-label="Default select example"
                                                id="inputMonth" name="month">
                                            </select>
                                        </div>
                                        <div class="col-7 px-1">
                                            <select class="form-select inputYear" aria-label="Default select example"
                                                id="inputYear" name="year">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto me-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary">تخصیص</button>
                                </div>
                            </div>
                        </form>
                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
