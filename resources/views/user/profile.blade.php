@extends('user.layouts.master')
@section('content')
<div class="card-profile">
    <div class="card-pic-stars">
        <img class="profile-pic" src="{{ asset('icons/face_black_24dp.svg') }}" alt="">
        <div class="card-stars">
            <h2> {{ $user->nickname }} </h2>
            <div class="card-stars-ads">
                <img src="{{ asset('icons/star_black_24dp.svg') }}" alt="">
                <img src="{{ asset('icons/star_black_24dp.svg') }}" alt="">
                <img src="{{ asset('icons/star_black_24dp.svg') }}" alt="">
                <img src="{{ asset('icons/grade_black_24dp.svg') }}" alt="">
                <img src="{{ asset('icons/grade_black_24dp.svg') }}" alt="">
                ({{ $nbsell }})
            </div>
        </div>
    </div>
    <a class="public-profile" href="/public/profile/{{$user->nickname}}">See my public profile</a>
</div>
<div class="card-settings">
    <a href="/user/{{Auth::user()->nickname}}" class="access-eads">
        <img src="{{ asset('icons/badge_black_24dp.svg') }}" alt="">
        <h3>E-ads</h3>
        <p>Edit my E-ads posted</p>
    </a>
    <a href="/user/info/profile/{{$user->nickname}}" class="public-settings">
        <img src="{{ asset('icons/face_black_24dp.svg') }}" alt="">
        <h3>Profile</h3>
        <p>See my infomations profile</p>
    </a>
    <a href="/user/edit/{{$user->nickname}}/user" class="profile-settings">
        <img src="{{ asset('icons/settings_black_24dp.svg') }}" alt="">
        <h3>Settings</h3>
        <p>Complete and modify my private informations and preferences</p>
    </a>
</div>
@endsection