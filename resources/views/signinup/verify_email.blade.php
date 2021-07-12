@extends('signinup.layouts.signin-signup')
@section('content')
    <div class="container">
        <div style="padding: 1rem;" class="infos">
            @if (isset($message))
            <h2 style=" margin: 1rem;">{{ $message }}</h2>
                <p>Thank you !</p>
                <a style="padding: 1rem; border: 1px solid black; margin-top: 1rem; border-radius: 0.5rem;" href="/">Go back Home</a>
            @else
            <h2 style=" margin: 1rem;">Plese verify your Email before</h2>
                <form action="/email/verification-notification" method="post">
                    @csrf
                    <button style="border: 1px solid black; padding: 1rem; margin: 1rem; text-transform: uppercase;"
                        type="submit">Resent Email</button>
                </form>
            @endif
        </div>
    </div>
@endsection
