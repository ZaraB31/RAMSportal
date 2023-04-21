@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<section>
    <img src="{{url('/images/Three Logos.png')}}" alt="">
    <h1>Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf 

        @error('email')
            <div class="error" role="alert">
                <p>{{ $message }}</p>
            </div>
        @enderror
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email">

        @error('password')
            <div class="error" role="alert">
                <p>{{ $message }}</p>
            </div>
        @enderror
        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">Remember Me</label>

        <input type="submit" value="Login">
    </form>
</section>
@endsection