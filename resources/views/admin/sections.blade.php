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

    <section id="load" class="twoThirds">
        <article>
            <table>
                <tr>
                    <th>Section</th>
                </tr>
                @if($sections->count() > 0)
                    @foreach($sections as $section)
                    <tr>
                        <td>{{$section->name}} 
                            <i onclick="openForm('DeleteSection', {{$section->id}})" style="float:right;" class="fa-regular fa-trash-can"></i>
                            <i onclick="openNameForm('EditSection', {{ $section->id }}, '{{ $section->name }}')" style="float:right; margin-right: 5px" class="fa-solid fa-pen-to-square"></i>
                        </td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No sections added</td>
                    </tr>
                @endif
            </table>
            {{$sections->links()}}
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

<div class="deleteForm" id="EditSection" style="display:none;">
    <h2>Edit Section</h2>
    
    <form style="width:100%; float:none; margin-top:10px;" action="" method="post">
        @include('includes.error')

        <label for="name">Name:</label>
        <input style="width:99%; margin-bottom:10px;" type="text" name="name" id="name" value="">

        <input style="width:40%" class="delete" type="submit" value="Update">
    </form>

    <button onClick="closeForm('EditSection')">Cancel</button>

</div>

<div class="deleteForm" id="DeleteSection" style="display:none;">
    <h2>Are you sure you want to delete this section?</h2>
    <p>By deleting the section, you will also delete any data associated with it. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeleteSection')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>

@endsection