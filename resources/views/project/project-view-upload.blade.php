@extends('common.master')
@section('backRoute', route('Project.id', $p_id))
@section('pageTitle', 'بارگذاری مستندات پروژه')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('success') !!}</p>
                </div>
            @endif
            <form action="{{ route('ProjectReports.store', $p_id) }}" method="post" enctype="multipart/form-data"
                class="form-element">
                @csrf
                <div>
                    <input type="hidden" name="projects_id" id="projects_id" value="{{ $p_id }}">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">عنوان</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    <span class="text-danger">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">توضیحات</label>
                    <textarea class="form-control" id="description" rows="4" name="description">{{ old('description') }}</textarea>
                </div>
                <div class="mb-5">
                    <label for="attachment" class="form-label">بارگذاری مستندات</label>
                    <input type="file" class="form-control" id="attachment" name="attachment[]" multiple>
                </div>
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
