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
    <h2>Add Category</h2>
    <form class="create-categories" action="/admin/categories" method="post">
        @csrf
        <div class="case-user">
            <h3>ID</h3>
        </div>
        <div class="case-user">
            <h3>Name</h3>
        </div>
        <div class="case-user">
            <h3>Parent Category</h3>
        </div>
        <div class="case-user">
        </div>
        <div class="case-user">
            <p>#id</p>
        </div>
        <div class="case-user">
            <input type="text" name="name" placeholder="Name" required>
        </div>
        <div class="case-user">
            <select name="category_parent">
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