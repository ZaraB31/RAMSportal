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
                    <th>Qualifications</th>
                </tr>
                @if($qualifications->count() > 0)
                    @foreach($qualifications as $qualification)
                    <tr>
                        <td>{{$qualification->name}} <i onclick="openForm('DeleteQualification', {{$qualification->id}})" style="float:right;" class="fa-regular fa-trash-can"></i></td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No Qualifications added</td>
                    </tr>
                @endif
            </table>
            {{$qualifications->links()}}
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

<div class="deleteForm" id="DeleteQualification" style="display:none;">
    <h2>Are you sure you want to delete this qualification?</h2>
    <p>By deleting the qualification, you will also delete any data associated with it. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeleteQualification')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>

@endsection