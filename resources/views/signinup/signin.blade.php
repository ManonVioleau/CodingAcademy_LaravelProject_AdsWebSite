@extends('signinup.layouts.signin-signup')
@section('content')
<div class="container">

    <div class="infos">

        <h3>Welcome !</h3>
        <p class="text">You must login to go further.</p>
        <div>
            @if (session('success'))
                <div class="message">
                    {{ session('success') }}
                </div>
            @endif

        </div>

        <div class="form">
            <form action="/signin" method="post">
                {{ csrf_field() }}
                <!-- ajout d'un champ caché (hidden)  au form contenant chaine caract aleat qui protege des attaques CSRF -->
                <p>Login</p>
                <input type="text" name="login"  value="{{ old('login') }}">
                @if ($errors->has('login'))
                <p class="erreur">{{ $errors->first('login') }}</p>
            @endif
                <p>Password</p>

                <input type="password" name="password" >
                @if ($errors->has('password'))
                    <p class="erreur">{{ $errors->first('password') }}</p>
                @endif

                <input class="button" type="submit" value="Signin">
            </form>
        </div>

    </div>
</div>
@endsection
