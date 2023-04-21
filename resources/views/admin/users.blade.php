@extends('layouts.app')

@section('title', 'Admin - Users')

@section('content')
<header>
    @include('includes.header', ['title' => 'Admin - Users'])
</header>

<main>
    <div class="back">
        <a href="/Admin"> <i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    @include('includes.success')

    <section class="twoThirds">
        <article>
            @if($users->count() > 0)
                @foreach($users as $user)
                <div class="card">
                    <h3>{{$user->name}}</h3>
                    <p><b>Email Address:</b> {{$user->email}}</p>
                    <p><b>Company:</b> {{$user->company->name}}</p>
                </div>
                @endforeach
            @else 
                <div class="card">
                    <h3>No users added</h3>
                </div>
            @endif
        </article>

        <aside>
            <h3>Add New User</h3>

            <form action="{{ route('register') }}" method="post">
                @include('includes.error')

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email">

                <label for="company_id">Company</label>
                <select name="company_id" id="company_id">
                    <option value="">Select...</option>
                    @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>

                <label for="position">Position:</label>
                <input type="text" name="position" id="position">

                <label for="password">Password:</label>
                <input type="password" name="password" id="password">

                <label for="password-confirm">Confirm Password:</label>
                <input type="password" name="password-confirm" id="password-confirm">

                <input class="inverse" type="submit" value="Register">
            </form>
        </aside>
    </section>
</main>

@endsection