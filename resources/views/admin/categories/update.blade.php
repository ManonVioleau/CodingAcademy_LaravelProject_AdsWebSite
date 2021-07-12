@extends('admin.layouts.admin-master')
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
    <h2>Edit Category : {{$category->name}} </h2>
    <form class="update-categories" action="/admin/categories/{{ $category->id }}" method="post">
        @method('put')
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
            <p>{{ $category->id }}</p>
        </div>
        <div class="case-user">
            <input type="text" name="name" placeholder="{{ $category->name }}">
        </div>
        <div class="case-user">
            <p>
                {{ $category->getParentsNames() }}
            </p>
            <br>
            <select name="parent_category">
                <option value="null">Select a Category</option>
                @foreach ($categories as $cat) {
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="case-user">
            <button type="submit" class="update-button">Edit</button>
        </div>
    </form>
</div>
@endsection