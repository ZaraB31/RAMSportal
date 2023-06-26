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
            @if($hospitals->count() > 0)
                @foreach($hospitals as $hospital)
                <div class="hospital card">
                    <h3>{{$hospital->name}} <i onclick="openForm('DeleteHospital', {{$hospital->id}})" style="float:right;" class="fa-regular fa-trash-can"></i></h3>
                    <p><b>Address: </b>{{$hospital->address}}</p>
                </div>
                @endforeach
            @else 
                <div class="card">
                    <h3>No hospitals added</h3>
                </div>
            @endif

        </article>

        <aside>
            <h3>Add new hospital</h3>

            <form action="{{ route('storeHospital') }}" method="post">
                @include('includes.error')

                <label for="name">Hospital Name:</label>
                <input type="text" name="name" id="name">

                <label for="address">Hosital Address: </label>
                <textarea name="address" id="address"></textarea>

                <input class="inverse" type="submit" value="Save">

            </form>
        </aside>
    </section>
</main>

<div class="deleteForm" id="DeleteHospital" style="display:none;">
    <h2>Are you sure you want to delete this hospital?</h2>
    <p>By deleting the hospital, you will also delete any data associated with it. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeleteHospital')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>

@endsection