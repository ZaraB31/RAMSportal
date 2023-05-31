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
            <table>
                <tr>
                    <th>Clients</th>
                </tr>
                @if($clients->count() > 0)
                    @foreach($clients as $client)
                    <tr>
                        <td>{{$client->name}}</td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No clients added</td>
                    </tr>
                @endif
            </table>
            
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