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
                    <h3>{{$hospital->name}} 
                        <i onclick="openForm('DeleteHospital', {{$hospital->id}})" style="float:right;" class="fa-regular fa-trash-can"></i>
                        <i onclick="openHospitalForm('EditHospital', {{ $hospital->id }}, '{{ $hospital->name }}', '{{$hospital->address}}')" style="float:right; margin-right: 5px" class="fa-solid fa-pen-to-square"></i>
                    </h3>
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

<div class="deleteForm" id="EditHospital" style="display:none;">
    <h2>Edit Hospital</h2>
    
    <form style="width:100%; float:none; margin-top:10px;" action="" method="post">
        @include('includes.error')

        <label for="name">Name:</label>
        <input style="width:99%; margin-bottom:10px;" type="text" name="name" id="name" value="">

        <label for="address">Address:</label>
        <input style="width:99%; margin-bottom:10px;" type="text" name="address" id="address" value="">


        <input style="width:40%" class="delete" type="submit" value="Update">
    </form>

    <button onClick="closeForm('EditHospital')">Cancel</button>

</div>

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