@extends('common.master')
@section('backRoute', route('Payslip.all'))
@section('pageTitle', 'فیش حقوقی')

@section('content')
    <div class="notif-list">
        <div class="main-pad">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('success') !!}</p>
                </div>
            @endif
            <form action="{{ route('Payslip.single.store') }}" method="post" class="form-element" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="personal_code" class="form-label">کاربر</label>
                            <select class="form-select" id="personal_code" name="personal_code" aria-label="Default">
                                @foreach($users as $user)
                                    <option
                                        value="{{ $user->personal_code }}">{{ $user->first_name }} {{ $user->last_name }}
                                        - {{ $user->personal_code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                            <span class="text-danger">
                                @error('title')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="monthly_salary" class="form-label">حقوق ماهیانه</label>
                            <input type="number" class="form-control" id="monthly_salary" name="monthly_salary"
                                   value="{{ old('monthly_salary') }}">
                            <span class="text-danger">
                                @error('monthly_salary')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col">
                            <label for="ayelemandi" class="form-label">حق عالئه مندی</label>
                            <input type="number" class="form-control" id="ayelemandi" name="ayelemandi"
                                   value="{{ old('ayelemandi') }}">
                            <span class="text-danger">
                                @error('ayelemandi')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="reward" class="form-label">پاداش</label>
                            <input type="number" class="form-control" id="reward" name="reward"
                                   value="{{ old('reward') }}">
                            <span class="text-danger">
                                @error('reward')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col">
                            <label for="insurance_earn" class="form-label">حق بیمه</label>
                            <input type="number" class="form-control" id="insurance_earn" name="insurance_earn"
                                   value="{{ old('insurance_earn') }}">
                            <span class="text-danger">
                                @error('insurance_earn')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="sum_of_earn" class="form-label">کل حقوق و مزایا</label>
                            <input type="number" class="form-control" id="sum_of_earn" name="sum_of_earn"
                                   value="{{ old('sum_of_earn') }}">
                            <span class="text-danger">
                                @error('sum_of_earn')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col">
                            <label for="insurance_deduction" class="form-label">حق بیمه سهم کارمند</label>
                            <input type="number" class="form-control" id="insurance_deduction" name="insurance_deduction"
                                   value="{{ old('insurance_deduction') }}">
                            <span class="text-danger">
                                @error('insurance_deduction')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="loan_deduction" class="form-label">کسر وام</label>
                            <input type="number" class="form-control" id="loan_deduction" name="loan_deduction"
                                   value="{{ old('loan_deduction') }}">
                            <span class="text-danger">
                                @error('loan_deduction')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col">
                            <label for="mosaede_deduction" class="form-label">کسر مساعده</label>
                            <input type="number" class="form-control" id="mosaede_deduction" name="mosaede_deduction"
                                   value="{{ old('mosaede_deduction') }}">
                            <span class="text-danger">
                                @error('mosaede_deduction')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="panelty" class="form-label">جریمه</label>
                            <input type="number" class="form-control" id="panelty" name="panelty"
                                   value="{{ old('panelty') }}">
                            <span class="text-danger">
                                @error('panelty')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col">
                            <label for="sum_of_deduction" class="form-label">جمع کسور</label>
                            <input type="number" class="form-control" id="sum_of_deduction" name="sum_of_deduction"
                                   value="{{ old('sum_of_deduction') }}">
                            <span class="text-danger">
                                @error('sum_of_deduction')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="total_earn" class="form-label">خالص قابل پرداخت</label>
                            <input type="number" class="form-control" id="total_earn" name="total_earn"
                                   value="{{ old('total_earn') }}">
                            <span class="text-danger">
                                @error('total_earn')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col">
                            <label for="pay_det_file" class="form-label">فیش حقوقی</label>
                            <input class="form-control" type="file" id="pay_det_file" name="pay_det_file"
                                   accept="image/png, image/gif, image/jpeg">
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection
