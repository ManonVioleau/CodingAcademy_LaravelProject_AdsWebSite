@extends('admin.layouts.admin-master')
@section('content')
    <div class="admin-content">
        <div class="message">
            {{ $message ?? '' }}
        </div>
        <h2>All Users</h2>
        <div class="add-user">
            <a class="add-button" href="/admin/user/add">Add</a>
        </div>
        <form class="show-users" action="/admin/users/show" method="post">
            @method('delete')
            @csrf
            <div class="case-user">
                <h3>ID</h3>
            </div>
            <div class="case-user">
                <h3>Login</h3>
            </div>
            <div class="case-user">
                <h3>Email</h3>
            </div>
            <div class="case-user">
                <h3>Phone Number</h3>
            </div>
            <div class="case-user">
                <h3>Nickname</h3>
            </div>
            <div class="case-user">
                <h3>Role</h3>
            </div>
            <div class="case-user">
            </div>
            @foreach ($users as $user)
                <div class="case-user">
                    {{-- <input type="text" name="id" value="{{ $user->id }}" style="display:none;"> --}}
                    <p>{{ $user->id }}</p>
                </div>
                <div class="case-user">
                    <p>{{ $user->login }}</p>
                </div>
                <div class="case-user">
                    <p>{{ $user->email }}</p>
                </div>
                <div class="case-user">
                    <p>{{ $user->phone_number }}</p>
                </div>
                <div class="case-user">
                    <p>{{ $user->nickname }}</p>
                </div>
                <div class="case-user">
                    <p>{{ $user->role }}</p>
                </div>
                <div class="case-user">
                    <a class="update-button" href="/admin/user/{{ $user->id }}">Edit</a>
                    <button class="delete-button" name="delete" value="{{ $user->id }}" type="submit">Delete</button>
                </div>
            @endforeach
        </form>
        <div class="page">
            @for ($i = 1; $i <= ceil($count / $limit); $i++)
                @if (intval($page) == $i)
                    <a class="active" href="/admin/users/show/{{$i}}">{{$i}}</a>
                @else
                    <a href="/admin/users/show/{{$i}}">{{$i}}</a>
                @endif
            @endfor
        </div>
    </div>
@endsection
