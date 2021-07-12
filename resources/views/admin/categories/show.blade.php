@extends('admin.layouts.admin-master')
@section('content')
<div class="admin-content">
    <div class="message">
        {{ $message ?? '' }}
    </div>
    <h2>All Categories</h2>
    <div class="add-user">
        <a class="add-button" href="/admin/categories/create">Add</a>
    </div>
    <form class="show-categories" action="/admin/categories/delete" method="post">
        @method('delete')
        @csrf
        <div class="case-user">
            <h3>ID</h3>
        </div>
        <div class="case-user">
            <h3>Name</h3>
        </div>
        <div class="case-user">
            <h3>Parent categories</h3>
        </div>
        <div class="case-user">
        </div>
        @foreach ($categories as $category)
        <div class="case-user">
            {{-- <input type="text" name="id" value="{{ $category->id }}" style="display:none;"> --}}
            <p>{{ $category->id }}</p>
        </div>
        <div class="case-user">
            <p>{{ $category->name }}</p>
        </div>
        <div class="case-user">
            <p>
            {{ $category->getParentsNames() }}
            </p>
        </div>
        <div class="case-user">
            <a class="update-button" href="/admin/categories/{{ $category->id }}/edit">Edit</a>
            <button class="delete-button" name="delete" value="{{ $category->id }}" type="submit">Delete</button>
        </div>
        @endforeach
    </form>
    <div class="page">
        @for ($i = 1; $i <= ceil($count / $limit); $i++) @if (intval($page)==$i) <a class="active">{{$i}}</a>
            @else
            <a href="/admin/categories/{{$i}}">{{$i}}</a>
            @endif
            @endfor
    </div>
</div>
@endsection