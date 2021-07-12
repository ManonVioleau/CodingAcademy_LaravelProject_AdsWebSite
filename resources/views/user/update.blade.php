@extends('user.layouts.master')
@section('content')
<div class="admin-content">
    <div class="message">
        {{ $message ?? ''}}
    </div>
    @if ($errors->any())
    <div class="message">
        {{ $errors }}
    </div>
    @endif
    <h2>Edith Ad : {{$ad->title}} </h2>
    <form class="create-ads-user" action="/user/edit/{{ $user->nickname }}/ad/{{ $ad->id }}" method="post">
        @method('put')
        @csrf
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
            <h3>Category</h3>
        </div>
        <div class="case-user">
        </div>
        <div class="case-user">
            <input type="text" name="title" placeholder="{{ $ad->title }}">
        </div>
        <div class="case-user">
            <input type="text" name="description" placeholder="{{ $ad->description }}">
        </div>
        <div class="case-user">
            <input type="number" name="price" placeholder="{{ $ad->price }}">
        </div>
        <div class="case-user">
            <input type="text" name="location" placeholder="{{ $ad->location }}">
        </div>
        <div class="case-user">
            <input type="text" name="picture" placeholder="{{ $ad->picture }}">
        </div>
        <div class="case-user">
            <p>
                @foreach ($ad->categories as $category)
                @if ($loop->last)
                {{ $category->name }}
                @else
                {{ $category->name }} >
                @endif
                @endforeach
            </p>
            <br>
            <select name="category">
                <option value="null">Select a Category</option>
                @foreach ($categories as $category) {
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="case-user">
            <button type="submit" class="update-button">Edit</button>
        </div>
    </form>
</div>
@endsection