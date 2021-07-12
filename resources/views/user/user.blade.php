@extends('user.layouts.master')
@section('content')
    <div class="userads">
        <div class="titleuserad">
            <h2>Your Ads : </h2>
            <div class="getmessage">
                {{ $message ?? '' }}
            </div>
            <a class="addad" href="/user/add/{{ $user->nickname }}">Add</a>
        </div>
        @forelse ($ads_user as $ad)
            <div class="userad">
                <div class="aduser">
                    <img src="{{ $ad->picture }}" alt="{{ $ad->title }}">
                    <div class="aduserdescription">
                        <h3>{{ $ad->title }}</h3>
                        <h5>$ {{ $ad->price }}</h5>
                        <p>{{ $ad->location }}</p>
                        <p>
                            @for ($i = 0; $i < count($ad->categories) - 1; $i++)
                                {{ $ad->categories[$i]->name }} >
                            @endfor
                            {{ $ad->categories[count($ad->categories) - 1]->name }}
                        </p>
                        <form class="crud-ads-user" action="/user/{{ $user->nickname }}/{{ $ad->id }}" method="post">
                            @method('delete')
                            @csrf
                            <a class="editad" href="/user/edit/{{ $user->nickname }}/ad/{{ $ad->id }}">Edit</a>
                            <button class="deletead" type="submit">Delete</button>
                        </form>
                    </div>


                </div>
                <div class="date">
                    <h4>Published date :</h4>
                    <p>{{ $ad->created_at->format('d/m/y - h:m') }}</p>
                </div>
            </div>
        @empty
            <div class="userad">
                No add
            </div>
        @endforelse
    </div>
@endsection
