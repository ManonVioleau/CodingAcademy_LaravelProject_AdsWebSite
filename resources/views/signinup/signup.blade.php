@extends('signinup.layouts.signup-signin')
@section('content')
    <div class="container">

        <div class="infos">

            <h3>Welcome !</h3>
            <p class="text">You must signup to go further.</p>
            <div>
                @if (session('success'))
                    <div class="message">
                        {{ session('success') }}
                    </div>
                @endif

            </div>

            <div class="form">
                <form action="/signup" method="post">
                    {{ csrf_field() }}
                    <!-- ajout d'un champ caché (hidden)  au form contenant chaine caract aleat qui protege des attaques CSRF -->


                    @if ($errors->any())

                        <div class="erreur">

                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @break
                    @endforeach

            </div>
            @endif
            <p>Login</p>
            <input type="text" name="login" value="{{ old('login') }}">
            <p>Email</p>

            <input type="email" name="email" value="{{ old('email') }}">
            <p>Phone number</p>

            <input type="text" name="phone_number" value="{{ old('phone_number') }}">
            <p>Nickname</p>

            <input type="text" name="nickname" value="{{ old('nickname') }}">
            <p>Password</p>

            <input type="password" name="password">
            <p>Password confirmation</p>

            <input type="password" name="password_confirmation">

            <input  class="button" type="submit" value="Signup">
            </form>
        </div>



      </div>
    </div>
@endsection
