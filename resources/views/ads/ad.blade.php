@extends('ads.layouts.master')
@section('content')
    <div class="adindex">
        <h3>
            @for ($i = 0; $i < count($ad->categories) - 1; $i++)
                {{ $ad->categories[$i]->name }} >
            @endfor
            {{ $ad->categories[count($ad->categories) - 1]->name }}
        </h3>
        <div class="displayad">
            <img src="{{ $ad->picture }}" alt="product">
            <div class="descriptionad">
                <div class="descr-top">
                    <h2>{{ $ad->title }}</h2>
                    <h4>$ {{ $ad->price }}</h4>
                    <p>Published date : {{ $ad->created_at->format('d/m/y - h:m') }}</p>
                </div>
                <div class="descr-bottom">
                    <h5>Description</h5>
                    <p>{{ $ad->description }}</p>
                </div>

            </div>
        </div>
        <div class="displayuser">
            <div class="entete">
            <a class="entete" href="/public/profile/{{$user->nickname}}">
                <img src="{{ asset('icons/face_black_24dp.svg') }}" alt="">
                <div class="descruser">
                    <p class="name"> {{ $user->nickname }} </p>
                    <p class="nbad"> {{ $nbad }} ads </p>
                </div>
            </a>
            </div>
            <div class="contactoffer">
                <button class="makeoffer" type="submit">Make an offer</button>
                <button class="displayphone" type="submit"> <span class="displaytitlephone">Display phone number</span>
                    <span class="phonenumber">{{ $user->phone_number }}</span> </button>
                </button>
                <button class="submessage" type="submit">Message</button>
            </div>
        </div>
    </div>
@endsection
