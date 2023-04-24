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
                    <th>People</th>
                </tr>
                @if($people->count() > 0)
                    @foreach($people as $person)
                    <tr>
                        <td>{{$person->person}}</td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No people at risk added</td>
                    </tr>
                @endif
            </table>
        </article>

        <aside>
            <h3>Add New Person at Risk</h3>

            <form action="{{ route('storePerson') }}" method="post">
                @include('includes.error')

                <label for="person">Name:</label>
                <input type="text" name="person" id="person">

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection