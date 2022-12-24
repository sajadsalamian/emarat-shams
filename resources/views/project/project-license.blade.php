@extends('common.master')
@section('backRoute', route('Project.id', $id))
@section('pageTitle', 'گزارش مربوط به پروژه')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            <div class="notif-list mt-4">
                <div class="items project-inside-view mb-4">
                    <p>مستندات مربوط به پروژه <span class="fw-bold me-2">{{ $project->title }}</span></p>
                    @foreach ($project_license as $license)
                        <div class="card p-4 mb-4">
                            <p>{{ $license->title }}</p>
                            <img src="{{ $license->file }}" alt="اشکال در بارگیری">
                        </div>
                    @endforeach
                </div>
                @if (auth()->user()->role == 0 || auth()->user()->role == 1)
                    <div>
                        <a href="{{ route('Project.license.add', $id) }}" class="btn btn-primary">
                            افزودن مجوز
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
