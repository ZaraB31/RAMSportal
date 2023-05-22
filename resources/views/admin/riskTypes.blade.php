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
                    <th>Risk Types</th>
                </tr>
                @if($types->count() > 0)
                    @foreach($types as $type)
                    <tr>
                        <td>{{$type->type}}</td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td colspan="2">No Risk Types added</td>
                    </tr>
                @endif
            </table>
        </article>

        <aside>
            <h3>Add New Risk Type</h3>

            <form action="{{ route('storeRiskType') }}" method="post">
                @include('includes.error')

                <label for="type">Risk Type:</label>
                <input type="text" name="type" id="type">

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection