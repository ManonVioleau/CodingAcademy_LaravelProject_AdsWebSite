@extends('user.layouts.master')
@section('content')
    <div class="card-profile">
        <div class="card-pic-stars">
            <img class="profile-pic" src="{{ asset('icons/face_black_24dp.svg') }}" alt="">
            <div class="card-stars">
                <h2> {{ $user->nickname }} </h2>
                <p>Member since {{ $user->created_at->format('d/m/y') }}</p>

            </div>
        </div>
        <div class="card-stars-public-profile">
            <img src="{{ asset('icons/star_black_24dp.svg') }}" alt="">
            <img src="{{ asset('icons/star_black_24dp.svg') }}" alt="">
            <img src="{{ asset('icons/star_black_24dp.svg') }}" alt="">
            <img src="{{ asset('icons/grade_black_24dp.svg') }}" alt="">
            <img src="{{ asset('icons/grade_black_24dp.svg') }}" alt="">
            {{ $nbsell }} sells
        </div>
    </div>
    <div class="public-profile-ads">
        <h2 style="margin-bottom: 1rem;">{{ $nbad }} ads :</h2>
        <div class="public-profile-ads-display">
            @forelse ($ads as $ad)
                <a class="public-profile-ad" href="/ad/{{ $ad->id }}">
                    <img src="{{ $ad->picture }}" alt="{{ $ad->title }}">
                    <div class="description">
                        <div class="top-description">
                            <h3>{{ $ad->title }}</h3>
                            <h4>$ {{ $ad->price }}</h4>
                        </div>
                        <div class="bottom-description">
                            <h5>
                                @for ($i = 0; $i < count($ad->categories) - 1; $i++)
                                    {{ $ad->categories[$i]->name }} >
                                @endfor
                                {{ $ad->categories[count($ad->categories) - 1]->name }}
                            </h5>
                            <h6>{{ $ad->location }}</h6>
                            <p>Published date : {{ $ad->created_at->format('d/m/y - h:m') }}</p>
                        </div>
                    </div>
                </a>
                @empty
                    <p>No ads</p>
                @endforelse
        </div>
    </div>
@endsection
