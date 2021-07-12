@extends('admin.layouts.admin-master')
@section('content')
<div class="admin-wrapper">
  <div class="display-crud-users">
    <img src="{{ asset('icons/crud-user.png') }}" alt="image crud user" width="700rem">
    <div class="wrapper-button">
      <a class="admin-button" href="/admin/users/show">See more ...</a>
    </div>
  </div>
  <div class="display-crud-ads">
    <img src="{{ asset('icons/crud-ads.png') }}" alt="image crud ads" width="700rem">
    <div class="wrapper-button">
      <a class="admin-button" href="/admin/ads/show">See more ...</a>
    </div>
  </div>
  <div class="display-crud-categories">
    <img src="{{ asset('icons/crud-categories.png') }}" alt="image crud categories" width="700rem">
    <div class="wrapper-button">
      <a class="admin-button" href="/admin/categories">See more ...</a>
    </div>
  </div>
</div>
@endsection