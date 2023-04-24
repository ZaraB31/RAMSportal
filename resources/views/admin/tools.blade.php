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
                    <th>Type</th>
                </tr>
                @if($tools->count() > 0)
                    @foreach($tools as $tool)
                    <tr>
                        <td>{{$tool->name}}</td>
                        <td>{{$tool->section->name}}</td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td colspan="2">No tools added</td>
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

                <label for="section_id">Tool Type:</label>
                <select name="section_id" id="section_id">
                    <option value="">Select...</option>
                    @foreach($sections as $section)
                    <option value="{{$section->id}}">{{$section->name}}</option>
                    @endforeach
                </select>

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection