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
                    <th>People</th>
                </tr>
                @if($people->count() > 0)
                    @foreach($people as $person)
                    <tr>
                        <td>{{$person->person}} <i onclick="openForm('DeletePerson', {{$person->id}})" style="float:right;" class="fa-regular fa-trash-can"></i></td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No people at risk added</td>
                    </tr>
                @endif
            </table>
        </article>

        <aside>
            <h3>Add New Person at Risk</h3>

            <form action="{{ route('storePerson') }}" method="post">
                @include('includes.error')

                <label for="person">Name:</label>
                <input type="text" name="person" id="person">

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

<div class="deleteForm" id="DeletePerson" style="display:none;">
    <h2>Are you sure you want to delete this person at risk?</h2>
    <p>By deleting this person at risk, you will also delete any data associated with it. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeletePerson')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>
@endsection