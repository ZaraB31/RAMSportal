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
                    <th>Tool</th>
                </tr>
                @if($tools->count() > 0)
                    @foreach($tools as $tool)
                    <tr>
                        <td>{{$tool->name}}</td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No tools added</td>
                    </tr>
                @endif
            </table>
        </article>

        <aside>
            <h3>Add New Tool</h3>

            <form action="{{ route('storeTool') }}" method="post">
                @include('includes.error')

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection