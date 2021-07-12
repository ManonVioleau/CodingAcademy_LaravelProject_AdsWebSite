@extends('admin.layouts.admin-master')
@section('content')
<div class="admin-content">
    <div class="message">
        {{ $message ?? ''}}
    </div>
    <h2>Add User</h2>
    <form class="create-user" action="/admin/user/add" method="post">
        @csrf
        <div class="case-user">
            <h3>ID</h3>
        </div>
        <div class="case-user">
            <h3>Login</h3>
        </div>
        <div class="case-user">
            <h3>Password</h3>
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
        <div class="case-user">
            <p>#id</p>
        </div>
        <div class="case-user">
            <input type="text" name="login" placeholder="Login">
        </div>
        <div class="case-user">
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="case-user">
            <input type="email" name="email" placeholder="Email">
        </div>
        <div class="case-user">
            <input type="text" name="phone_number" placeholder="Phone Number">
        </div>
        <div class="case-user">
            <input type="text" name="nickname" placeholder="Nickname">
        </div>
        <div class="case-user">
            <input type="text" name="role" placeholder="Role">
        </div>
        <div class="case-user">
            <button type="submit" class="add-button">Add</button>
        </div>
    </form>
</div>
@endsection