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
                    <th>Section</th>
                </tr>
                @if($sections->count() > 0)
                    @foreach($sections as $section)
                    <tr>
                        <td>{{$section->name}}</td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No sections added</td>
                    </tr>
                @endif
            </table>
            
        </article>

        <aside>
            <h3>Add New Section</h3>

            <form action="{{ route('storeSection') }}" method="post">
                @include('includes.error')

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection