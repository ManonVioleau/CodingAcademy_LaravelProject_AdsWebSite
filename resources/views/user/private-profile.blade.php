@extends('user.layouts.master')
@section('content')
<div class="message">
    {{ $message ?? '' }}
</div>
<div class="card-profile">
    <div class="card-pic-stars">
        <img class="profile-pic" src="{{ asset('icons/face_black_24dp.svg') }}" alt="">
        <div class="card-stars">
            <h2>Login : {{ $user->login }}</h2>
            <h3>Nickname : {{ $user->nickname }} </h3>
            <p>Email : {{ $user->email }}</p>
            <p>Phone Number : {{ $user->phone_number }}</p>
        </div>
    </div>
    <a href="/user/edit/{{$user->nickname}}/user" class="edit-profile">
        <img src="{{ asset('icons/settings_black_24dp.svg') }}" alt="">
        <h3>Edit</h3>
        <p>Complete and modify my private <br> informations and preferences</p>
    </a>
</div>
@endsection