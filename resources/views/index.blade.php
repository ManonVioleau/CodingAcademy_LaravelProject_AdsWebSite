@extends('layouts.master')
@section('content')
@if (isset($message))
<div class="message">
    {{ $message }}
</div>
@endif
@if ($errors->any())
<div class="message">
    {{ $errors }}
</div>
@endif
<div class="content">
    @isset($selectcity)
    @isset($selectcategory)
    <h2>Ads {{ $selectcategory }} : {{ $selectcity }}</h2>
    @endisset
    @empty ($selectcategory)
    <h2>Ads: {{ $selectcity }}</h2>
    @endempty
    @endisset
    @empty ($selectcity)
    @isset ($selectcategory)
    <h2>Ads {{ $selectcategory }} : All of the country</h2>
    @endisset
    @empty ($selectcategory)
    <h2>Ads : All of the country</h2>
    @endempty
    @endempty
    <div class="ads">
        @forelse ($ads as $ad)
        <a class="ad" href="/ad/{{ $ad->id }}">
            <img src="{{ $ad->picture }}" alt="{{ $ad->title }}">
            <div class="description">
                <div class="top-description">
                    <h3>{{ $ad->title }}</h3>
                    <h4>$ {{ $ad->price }}</h4>
                </div>
                <div class="bottom-description">
                    <h5>
                        @for ($i = 0; $i < count($ad->categories) - 1; $i++)
                            {{$ad->categories[$i]->name}} >
                            @endfor
                            {{$ad->categories[count($ad->categories) - 1]->name}}
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
    <div class="page">
        @for ($i = 1; $i <= ceil($count / $limit); $i++) @if (intval($page)==$i) <a class="active" href="/page{{$i}}">{{$i}}</a>
            @else
            <a href="/page{{$i}}">{{$i}}</a>
            @endif
            @endfor
    </div>
</div>
@endsection