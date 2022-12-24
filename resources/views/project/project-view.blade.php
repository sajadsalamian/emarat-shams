@extends('common.master')
@section('backRoute', route('Project.all'))
@section('pageTitle', 'مستندات پروژه')

@section('content')
    <div class="project-report-view">
        <div class="main-pad">
            @if (auth()->user()->role == 0 || auth()->user()->role == 1)
                <div>
                    <a href="{{ route('ProjectReports.add', $id) }}" class="btn btn-primary">
                        افزودن مستندات
                    </a>
                    <a href="{{ route('Project.license', $id) }}" class="btn btn-success">
                        مجوزات پروژه
                    </a>
                    <form method="POST" action="{{ route('Project.delete', $id) }}" class="d-inline">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <a href="#" class="btn btn-danger show_confirm">
                            حذف پروژه
                        </a>
                    </form>
                </div>
            @endif
            <div class="notif-list mt-4">
                <div class="items">
                    @foreach ($project_reports as $prorep)
                        <a href="{{ route('ProjectReports.id', ['p_id' => $id, 'id' => $prorep->id]) }}">
                            <div class="item">
                                <iconify-icon icon="clarity:building-line" width="36" height="36"></iconify-icon>
                                <p class="mb-0 fw-bold">{{ $prorep->title }}</p>
                                <p class="desc mb-0">{{ $prorep->description }}</p>
                                <p class="date text-muted">{{ $prorep->persian_date }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('.show_confirm').click(function (event) {
            let form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                text: 'آیا از حذف پروژه مطمئن هستید؟',
                showCancelButton: true,
                confirmButtonText: 'بله',
                confirmButtonColor: '#e3342f',
                cancelButtonText: 'خیر'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
