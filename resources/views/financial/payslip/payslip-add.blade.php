@extends('common.master')
@section('backRoute', route('main'))
@section('pageTitle', 'همه اعلان')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            <form>
                <div class="mb-3">
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" class="form-control" id="title">
                </div>
                <div class="mb-5">
                    <label for="exampleInputPassword1" class="form-label">بارگذاری فایل اکسل</label>
                    <input type="file" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
