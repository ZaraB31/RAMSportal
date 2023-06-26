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
                    <th>Risk Types</th>
                </tr>
                @if($types->count() > 0)
                    @foreach($types as $type)
                    <tr>
                        <td>{{$type->type}} <i onclick="openForm('DeleteRiskType', {{$type->id}})" style="float:right;" class="fa-regular fa-trash-can"></i></td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>No Risk Types added</td>
                    </tr>
                @endif
            </table>
        </article>

        <aside>
            <h3>Add New Risk Type</h3>

            <form action="{{ route('storeRiskType') }}" method="post">
                @include('includes.error')

                <label for="type">Risk Type:</label>
                <input type="text" name="type" id="type">

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

<div class="deleteForm" id="DeleteRiskType" style="display:none;">
    <h2>Are you sure you want to delete this risk type?</h2>
    <p>By deleting the risk type, you will also delete any data associated with it. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeleteRiskType')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>

@endsection