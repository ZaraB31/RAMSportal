@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<header>
    @include('includes.header', ['title' => 'Admin'])
</header> 

<main>
<div class="back">
        <a href="/Admin"> <i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    @include('includes.success')

    <section class="twoThirds">
        <article>
            @if($clients->count() > 0)
                @foreach($clients as $client)
                <div class="card">
                    <h3>{{$client->name}}</h3>
                </div>
                @endforeach
            @else 
                <div class="card">
                    <h3>No clients added</h3>
                </div>
            @endif
        </article>

        <aside>
            <h3>Add New Client</h3>

            <form action="{{ route('storeClient') }}" method="post">
                @include('includes.error')

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection