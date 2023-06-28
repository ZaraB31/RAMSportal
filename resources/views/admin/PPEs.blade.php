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
                    <th>PPE</th>
                </tr>
                @if($PPEs->count() > 0)
                    @foreach($PPEs as $PPE)
                    <tr>
                        <td>{{$PPE->name}} <i onclick="openForm('DeletePPE', {{$PPE->id}})" style="float:right;" class="fa-regular fa-trash-can"></i></td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td>No PPE added</td>
                </tr>
                @endif
            </table>
            {{$PPEs->links()}}
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

<div class="deleteForm" id="DeletePPE" style="display:none;">
    <h2>Are you sure you want to delete this PPE?</h2>
    <p>By deleting this PPE, you will also delete any data associated with it. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeletePPE')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>

@endsection