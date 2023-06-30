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
                    <th>Tool</th>
                </tr>
                @if($tools->count() > 0)
                    @foreach($tools as $tool)
                    <tr>
                        <td>{{$tool->name}} 
                            <i onclick="openForm('DeleteTool', {{$tool->id}})" style="float:right;" class="fa-regular fa-trash-can"></i>
                            <i onclick="openNameForm('EditTool', {{ $tool->id }}, '{{ $tool->name }}')" style="float:right; margin-right: 5px" class="fa-solid fa-pen-to-square"></i>
                        </td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No tools added</td>
                    </tr>
                @endif
            </table>
            {{$tools->links()}}
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

<div class="deleteForm" id="EditTool" style="display:none;">
    <h2>Edit Tool</h2>
    
    <form style="width:100%; float:none; margin-top:10px;" action="" method="post">
        @include('includes.error')

        <label for="name">Name:</label>
        <input style="width:99%; margin-bottom:10px;" type="text" name="name" id="name" value="">

        <input style="width:40%" class="delete" type="submit" value="Update">
    </form>

    <button onClick="closeForm('EditTool')">Cancel</button>

</div>

<div class="deleteForm" id="DeleteTool" style="display:none;">
    <h2>Are you sure you want to delete this tool?</h2>
    <p>By deleting the tool, you will also delete any data associated with it. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeleteTool')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>

@endsection