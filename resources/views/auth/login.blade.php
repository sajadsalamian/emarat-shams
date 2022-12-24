@extends('auth.master')
@section('backRoute', route('Notification.all'))
@section('pageTitle', 'افزودن اعلان')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="auth-login">
            @if (\Session::has('fail'))
                <div class="alert alert-danger">
                    <p class="mb-0">{!! \Session::get('fail') !!}</p>
                </div>
            @endif
            <form action="{{ route('auth.login') }}" method="post" class="form-element">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">شماره موبایل یا شماره پرسنلی</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                    <span class="text-danger">
                        @error('username')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">رمز عبور</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                    <span class="text-danger">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-success">ورود</button>
                </div>
            </form>
        </div>
    </div>
@endsection
