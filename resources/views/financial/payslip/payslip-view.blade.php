@extends('common.master')
@section('backRoute', route('Payslip.all'))
@section('pageTitle', 'بازدید فیش حقوقی')

@section('content')
    <div class="payslip-view">
        <div class="main-pad">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('success') !!}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-6">
                    تاریخ پرداخت:
                </div>
                <div class="col-6">
                    نام کارمند: {{ $payslip_details->employee_name }}
                </div>
                <div class="col-6">
                    دوره:
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>درآمد</th>
                                <th class="text-start">مبلغ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>حقوق ماهیانه</td>
                                <td class="text-start">{{ $payslip_details->monthly_salary }}</td>
                            </tr>
                            <tr>
                                <td>حق عالئه مندی</td>
                                <td class="text-start">{{ $payslip_details->ayelemandi }}</td>
                            </tr>
                            <tr>
                                <td>پاداش</td>
                                <td class="text-start">{{ $payslip_details->reward }}</td>
                            </tr>
                            <tr style="border-bottom: 1.5px solid black;">
                                <td>بیمه</td>
                                <td class="text-start">{{ $payslip_details->insurance_earn }}</td>
                            </tr>
                            <tr style="border-bottom-color: white;">
                                <td>کل حقوق و مزایا</td>
                                <td class="text-start">{{ $payslip_details->sum_of_earn }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>کسور</th>
                                <th class="text-start">مبلغ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>حق بیمه سهم کارمند</td>
                                <td class="text-start">{{ $payslip_details->insurance_deduction }}</td>
                            </tr>
                            <tr>
                                <td>کسر وام</td>
                                <td class="text-start">{{ $payslip_details->loan_deduction }}</td>
                            </tr>
                            <tr>
                                <td>کسر مساعده</td>
                                <td class="text-start">{{ $payslip_details->mosaede_deduction }}</td>
                            </tr>
                            <tr style="border-bottom: 1.5px solid black;">
                                <td>جریمه</td>
                                <td class="text-start">{{ $payslip_details->panelty }}</td>
                            </tr>
                            <tr style="border-bottom-color: white;">
                                <td>جمع کسور</td>
                                <td class="text-start">{{ $payslip_details->sum_of_deduction }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                <div class="row">
                    <div class="col-6">
                        <p>خالص قابل پرداخت</p>
                    </div>
                    <div class="col-6 text-start fw-bold">
                        <p>{{ $payslip_details->total_earn }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-5">
            </div>
            @if (auth()->user()->role == 0)
                <form action="{{ route('PayslipDetails.doc', $id) }}" method="post" enctype="multipart/form-data"
                    class="form-element">
                    @csrf
                    <div class="row">
                        <div class="col-auto">
                            <label for="pay_det_file" class="form-label">بارگذاری فیش واریزی</label>
                            <input type="hidden" name="id" value="{{ $id }}">
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="file" id="pay_det_file" name="pay_det_file"
                                accept="image/png, image/gif, image/jpeg">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">ارسال</button>
                        </div>
                    </div>
                    <span class="text-danger">
                        @error('pay_det_file')
                            {{ $message }}
                        @enderror
                    </span>
                </form>
            @endif
            <div class="img-container mt-4">
                <img src="{{ $payslip_details->payslip_document }}" alt="" id="payslip-doc-viewer">
            </div>
        </div>
    </div>
@endsection
