@extends('common.master')
@section('backRoute', route('Financial.root'))
@section('pageTitle', 'همه اعلان')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('success') !!}</p>
                </div>
            @endif
            <form action="{{ route('Payslip.import.show') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="ecxel_file" class="form-label">بارگذاری فایل اکسل</label>
                    <input type="file" class="form-control" name="ecxel_file" id="ecxel_file">
                </div>
                <button type="submit" class="btn btn-primary">نمایش</button>
            </form>
            <div class="my-5">
                @if (!empty($result))
                    <div class="table-responsive mb-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>کد پرسنلی</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>سمت</th>
                                    <th>حقوق پایه</th>
                                    <th>نوع همکاری</th>
                                    <th>وضعیت تاهل</th>
                                    <th>حقوق ماهیانه</th>
                                    <th>حق عائله مندی</th>
                                    <th>پاداش</th>
                                    <th>حق بیمه</th>
                                    <th>کل حقوق و مزایا</th>
                                    <th>حق بیمه سهم کارمند</th>
                                    <th>کسر وام</th>
                                    <th>کسر مساعده</th>
                                    <th>جریمه</th>
                                    <th>جمع کسور</th>
                                    <th>خالص قابل پرداخت</th>
                                    <th>واریزی</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $item)
                                    <tr>
                                        @foreach ($item as $per)
                                            <td>{{ $per }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <form action="{{ route('Payslip.import.save') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title') }}">
                            <span class="text-danger">
                                @error('title')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <input type="hidden" name="list" value="{{ $result }}">
                        <div class="mb-3">
                            <label for="date" class="form-label">ناریخ</label>
                            <div class="row">
                                <div class="col-6">
                                    <label for="">ماه</label>
                                    <select class="form-select inputMonth" aria-label="Default select example"
                                        id="inputMonth" name="month">
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="">سال</label>
                                    <select class="form-select inputYear" aria-label="Default select example" id="inputYear"
                                        name="year">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">ذخیره</button>
                    </form>
                @else
                @endif
            </div>
        </div>
    </div>
@endsection
