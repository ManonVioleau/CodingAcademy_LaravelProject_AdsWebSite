@extends('admin.layouts.admin-master')
@section('content')
<div class="admin-content">
    <div class="message">
        {{ $message ?? '' }}
    </div>
    <h2>All Ads</h2>
    <div class="add-user">
        <a class="add-button" href="/admin/ads/add">Add</a>
    </div>
    <form class="show-ads" action="/admin/ads/show" method="post">
        @method('delete')
        @csrf
        <div class="case-user">
            <h3>ID</h3>
        </div>
        <div class="case-user">
            <h3>Title</h3>
        </div>
        <div class="case-user">
            <h3>Description</h3>
        </div>
        <div class="case-user">
            <h3>Price</h3>
        </div>
        <div class="case-user">
            <h3>Location</h3>
        </div>
        <div class="case-user">
            <h3>Picture</h3>
        </div>
        <div class="case-user">
            <h3>User Login</h3>
        </div>
        <div class="case-user">
        </div>
        @foreach ($ads as $ad)
        <div class="case-user">
            {{-- <input type="text" name="id" value="{{ $ad->id }}" style="display:none;"> --}}
            <p>{{ $ad->id }}</p>
        </div>
        <div class="case-user">
            <p>{{ $ad->title }}</p>
        </div>
        <div class="case-user">
            <p>{{ $ad->description }}</p>
        </div>
        <div class="case-user">
            <p>{{ $ad->price }}</p>
        </div>
        <div class="case-user">
            <p>{{ $ad->location }}</p>
        </div>
        <div class="case-user">
            <img src="{{ $ad->picture }}" alt="une image"></img>
        </div>
        <div class="case-user">
            <p>{{ $ad->user_id }}</p>
        </div>
        <div class="case-user">
            <a class="update-button" href="/admin/ads/{{ $ad->id }}">Edit</a>
            <button class="delete-button" name="delete" value="{{ $ad->id }}" type="submit">Delete</button>
        </div>
        @endforeach
    </form>
    <div class="page">
        @for ($i = 1; $i <= ceil($count / $limit); $i++) @if (intval($page)==$i) <a class="active" href="/admin/ads/show/{{$i}}">{{$i}}</a>
            @else
            <a href="/admin/ads/show/{{$i}}">{{$i}}</a>
            @endif
            @endfor
    </div>
</div>
@endsection