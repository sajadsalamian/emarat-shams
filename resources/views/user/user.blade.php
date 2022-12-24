@extends('common.master')
@section('backRoute', route('main'))
@section('pageTitle', 'همه اعلان')

@section('content')
    <div class="notif-list">
        <div class="main-pad">
            <a href="{{ route('User.add') }}" class="btn btn-primary">افزودن کارمند</a>
            <table class="table table-striped my-4">
                <thead>
                <tr>
                    <th>نام</th>
                    <th>سمت</th>
                    <th>ویرایش</th>
                    <th>حذف</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->role_name }}</td>
                        <td>
                            <a href="{{ route('User.edit', $user->id) }}">
                                <iconify-icon icon="charm:eye"></iconify-icon>
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('User.delete', $user->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <a href="#" class="btn p-0 show_confirm">
                                    <iconify-icon icon="mdi:bin-circle-outline" style="color: red;"></iconify-icon>
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                text: 'آیا از حذف کارمند مطمئن هستید؟',
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
