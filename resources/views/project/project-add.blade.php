@extends('common.master')
@section('backRoute', route('Project.all'))
@section('pageTitle', 'افزودن پروژه')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('success') !!}</p>
                </div>
            @endif
            <form action="{{ route('Project.store') }}" method="post" class="form-element">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">عنوان پروژه</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    <span class="text-danger">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">آدرس پروژه</label>
                    <textarea class="form-control" id="address" rows="4" name="address">{{ old('address') }}</textarea>
                    <span class="text-danger">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
