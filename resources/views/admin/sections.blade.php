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
                    <th>Type</th>
                </tr>
                @if($sections->count() > 0)
                    @foreach($sections as $section)
                    <tr>
                        <td>{{$section->name}}</td>
                        <td>{{$section->type}}</td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td colspan="2">No sections added</td>
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

                <label for="type">Type:</label>
                <select name="type" id="type">
                    <option value="">Select...</option>
                    <option value="tools">Tools Section</option>
                    <option value="risks">Risks Section</option>
                </select>

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection