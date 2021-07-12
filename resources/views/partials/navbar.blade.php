<nav>
    <ul>
        <li><a href="/"><img class="iconhome" src="{{ asset('icons/slideshare.svg') }}" alt="home"></a></li>
    </ul>
    <ul>
        <li>
            @if (isset(Auth::user()->nickname))
            <a href="/user/add/{{ Auth::user()->nickname }}">
                <h1>Sell</h1>
            </a>
            @else
            <a href="{{ route('signin') }}">
                <h1>Sell</h1>
            </a>
            @endif
        </li>
        {{-- <li><a href="/">
                <h1>Watch List</h1>
            </a></li> --}}
        <li> 
            @if (isset(Auth::user()->nickname))
            <a href="/user/{{Auth::user()->nickname}}">
                <h1>My E-Ads</h1>
            </a>
            @else
            <a href="{{ route('signin') }}">
                <h1>My E-Ads</h1>
            </a>
            @endif
        </li>
        <li><a href="/">
                <h1>All Ads</h1>
            </a></li>
    </ul>
    <ul>
        <li>
            @if (isset(Auth::user()->login))
             <a href="/user/profile/{{ Auth::user()->nickname }}"> <img src="{{ asset('icons/face_black_24dp.svg') }}" alt=""> <br> {{ Auth::user()->nickname }}</a>
            @endif
        </li>
        @guest
            <li><a href="{{ route('signin') }}">
                    <h1>Login</h1>
                </a></li>
            {{-- <li><a href="/"><img src="{{ asset('icons/shopping_cart_black_24dp.svg') }}" alt="home"></a></li> --}}

        @else
            <li><a href="{{ route('logout') }}">
                    <h1>Logout</h1>
                </a></li>
            {{-- <li><a href="/"><img src="{{ asset('icons/shopping_cart_black_24dp.svg') }}" alt="home"></a></li> --}}

        @endguest

    </ul>
</nav>
