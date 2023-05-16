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
                    <th>Qualifications</th>
                </tr>
                @if($qualifications->count() > 0)
                    @foreach($qualifications as $qualification)
                    <tr>
                        <td>{{$qualification->name}}</td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No Qualifications added</td>
                    </tr>
                @endif
            </table>
        </article>

        <aside>
            <h3>Add New Qualification</h3>

            <form action="{{ route('storeQualification') }}" method="post">
                @include('includes.error')

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection