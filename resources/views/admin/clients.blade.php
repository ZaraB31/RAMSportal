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
                    <th colspan="2">Clients</th>
                </tr>
                @if($clients->count() > 0)
                    @foreach($clients as $client)
                    <tr>
                        <td>{{$client->name}}</td>
                        <td><i onclick="openForm('DeleteClient', {{$client->id}})" style="float:right;" class="fa-regular fa-trash-can"></i></td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td colspan="2">No clients added</td>
                    </tr>
                @endif
            </table>
            
        </article>

        <aside>
            <h3>Add New Client</h3>

            <form action="{{ route('storeClient') }}" method="post">
                @include('includes.error')

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

<div class="deleteForm" id="DeleteClient" style="display:none;">
    <h2>Are you sure you want to delete this client?</h2>
    <p>By deleting the client, you will also delete any data associated with it, inlcuding projects. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeleteClient')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>
@endsection