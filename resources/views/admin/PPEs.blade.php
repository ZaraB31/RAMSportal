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
                    <th>PPE</th>
                </tr>
                @if($PPEs->count() > 0)
                    @foreach($PPEs as $PPE)
                    <tr>
                        <td>{{$PPE->name}}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td>No PPE added</td>
                </tr>
                @endif
            </table>
            
        </article>

        <aside>
            <h3>Add new PPE</h3>

            <form action="{{ route('storePPE') }}" method="post" enctype="multipart/form-data">
                @include('includes.error')

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <input type="submit" value="Save" class="inverse">
            </form>
        </aside>

    </section>

</main>

@endsection