@extends('common.master')
@section('backRoute', route('Project.id', $p_id))
@section('pageTitle', 'گزارش مربوط به پروژه')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            <div class="notif-list mt-4">
                <div class="items project-inside-view">
                    <p class="fw-bold">{{ $project_report->title }}</p>
                    <p class="text-muted persian-date">{{ $project_report->persian_date }}</p>
                    <p>{{ $project_report->description }}</p>
                    @foreach ($files as $file)
                        <img src="{{ $file->file }}" alt="{{ $project_report->title }}">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
