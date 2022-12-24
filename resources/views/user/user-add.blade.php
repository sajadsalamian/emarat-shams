@extends('common.master')
@section('backRoute', route('User.all'))
@section('pageTitle', 'افزودن اعلان')

@section('content')

    <div class="project-report-view">
        <div class="main-pad">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('success') !!}</p>
                </div>
            @endif
            @if (\Session::has('failed'))
                <div class="alert alert-danger">
                    <p>{!! \Session::get('failed') !!}</p>
                </div>
            @endif
            @if (!is_null($user->id))
                <form method="POST" action="{{ route('User.update', $user->id) }}">
                @else
                    <form method="POST" action="{{ route('User.add') }}">
            @endif
            @csrf
            <div>
                <label for="id">اطلاعات فردی</label>
                <input type="hidden" name="id" id="id" value="{{ $user->id }}">
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label for="personal_code" class="form-label">کد پرسنلی</label>
                        <input type="text" class="form-control" id="personal_code" name="personal_code"
                            value="{{ $user->personal_code }}" readonly="true">
                        <span class="text-danger">
                            @error('personal_code')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-6">
                        <label for="phone" class="form-label">شماره تماس</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone', $user->phone) }}">
                        <span class="text-danger">
                            @error('phone')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label for="first_name" class="form-label">نام</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            value="{{ old('first_name', $user->first_name) }}">
                        <span class="text-danger">
                            @error('first_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-6">
                        <label for="last_name" class="form-label">نام خانوادگی</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            value="{{ old('last_name', $user->last_name) }}">
                        <span class="text-danger">
                            @error('last_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label for="role" class="form-label">سمت</label>
                        <select class="form-select" id="role" name="role" aria-label="Default">
                            <option value="0" <?php echo $user->role == 0 ? 'selected' : ''; ?>>ادمین</option>
                            <option value="1" <?php echo $user->role == 1 ? 'selected' : ''; ?>>سرپرست کارگاه</option>
                            <option value="2" <?php echo $user->role == 2 ? 'selected' : ''; ?>>پیمانکار</option>
                            <option value="3" <?php echo $user->role == 3 ? 'selected' : ''; ?>>منشی</option>
                            <option value="4" <?php echo $user->role == 4 ? 'selected' : ''; ?>>کارگر</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="employment_type" class="form-label">نحوه همکاری</label>
                        <select class="form-select" id="employment_type" name="employment_type" aria-label="">
                            <option value="1" <?php echo $user->employment_type == 1 ? 'selected' : ''; ?>>تمام وقت</option>
                            <option value="2" <?php echo $user->employment_type == 2 ? 'selected' : ''; ?>>پاره وقت</option>
                            <option value="3" <?php echo $user->employment_type == 3 ? 'selected' : ''; ?>>پیمانکار</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label for="salary" class="form-label">حقوق ماهیانه</label>
                        <input type="text" class="form-control" id="salary" name="salary"
                            value="{{ old('salary', $user->salary) }}">
                        <span class="text-danger">
                            @error('salary')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-6">
                        <label for="wedding" class="form-label">وضعیت تاهل</label>
                        <select class="form-select" id="wedding" name="wedding" aria-label="">
                            <option value="1" <?php echo $user->wedding == 1 ? 'selected' : ''; ?>>متاهل</option>
                            <option value="2" <?php echo $user->wedding == 2 ? 'selected' : ''; ?>>مجرد</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">ایمیل</label>
                <input type="text" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}">
            </div>

            <div style="margin-top: 48px;">
                <label for="startTime" class="form-label">پروژه های فعال</label>
            </div>
            <div class="mb-3">
                @foreach ($projects as $project)
                    <label class="form-check-label mx-2" for="elahie">
                        @php
                            $checkd = false;
                            foreach ($projects_map as $map) {
                                if ($project->id == $map->project_id) {
                                    $checkd = true;
                                }
                            }
                        @endphp
                        <input class="form-check-input" type="checkbox" @php if ($checkd) echo 'checked'; @endphp
                            id="{{ $project->id }}" value="{{ $project->id }}" name="projects[]">
                        {{ $project->title }}
                    </label>
                @endforeach
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </div>
            </form>
        </div>
    </div>

@endsection
