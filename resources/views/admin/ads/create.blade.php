@extends('admin.layouts.admin-master')
@section('content')
<div class="admin-content">
    <div class="message">
        {{ $message ?? '' }}
    </div>
    @if ($errors->any())
    <div class="message">
        {{ $errors }}
    </div>
    @endif
    <h2>Add Ad</h2>
    <form class="create-ads" action="/admin/ads/add" method="post">
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
            <h3>Category</h3>
        </div>
        <div class="case-user">
        </div>
        <div class="case-user">
            <p>#id</p>
        </div>
        <div class="case-user">
            <input type="text" name="title" placeholder="Title" required>
        </div>
        <div class="case-user">
            <input type="text" name="description" placeholder="Description" required>
        </div>
        <div class="case-user">
            <input type="number" name="price" placeholder="Price" required>
        </div>
        <div class="case-user">
            <input type="text" name="location" placeholder="Location" required>
        </div>
        <div class="case-user">
            <input type="text" name="picture" placeholder="Picture URL" required>
        </div>
        <div class="case-user">
            <input type="text" name="user_login" placeholder="User Login" required>
        </div>
        <div class="case-user">
            <select name="category" required>
                <option value="null">Select a Category</option>
                @foreach ($categories as $category) {
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="case-user">
            <button type="submit" class="add-button">Add</button>
        </div>
    </form>
</div>
@endsection