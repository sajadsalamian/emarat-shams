@extends('common.master')
@section('backRoute', route('main'))
@section('pageTitle', 'همه اعلان')

@section('content')
    <div class="notif-list">
        <div class="main-pad">
            <div>
                <a href="{{ route('Notification.add') }}" class="btn btn-primary">
                    افزودن اعلان
                </a>
            </div>
            <div class="items mt-3">
                @foreach ($notifications as $notif)
                    <a href="{{ route('Notification.add') }}">
                        <div class="item">
                            <img src="{{ asset('images/notification_icon.png') }}" alt="bell"/>
                            <p class="mb-0 fw-bold">{{ $notif->title }}</p>
                            <p class="desc mb-0">{{ $notif->description }}</p>
                            @if(!$notif->see)
                                <span class="notif-unread">
                                    <iconify-icon icon="carbon:dot-mark" style="color: red;" width="32" height="32"></iconify-icon>
                                </span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
