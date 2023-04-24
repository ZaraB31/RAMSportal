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

        <article class="ppeDisplay">
            @if($PPEs->count() > 0)
                @foreach($PPEs as $PPE)
                <div>
                    <img src="/PPE/{{$PPE->icon}}" alt="{{$PPE->name}}">
                    <p>{{$PPE->name}}</p>
                </div>
                @endforeach
            @else
            <div class="card">
                <h3>No PPE added</h3>
            </div>
            @endif
        </article>

        <aside>
            <h3>Add new PPE</h3>

            <form action="{{ route('storePPE') }}" method="post" enctype="multipart/form-data">
                @include('includes.error')

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <label for="icon">Icon:</label>
                <input type="file" name="icon" id="icon">

                <input type="submit" value="Save" class="inverse">
            </form>
        </aside>

    </section>

</main>

@endsection