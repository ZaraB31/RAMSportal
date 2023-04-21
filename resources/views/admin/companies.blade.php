@extends('layouts.app')

@section('title', 'Admin - Companies')

@section('content')
<header>
    @include('includes.header', ['title' => 'Admin - Companies'])
</header>

<main>
    @include('includes.success')

    <div class="back">
        <a href="/Admin"> <i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
     
    <section class="twoThirds">
        <article>
            @if($companies->count() > 0)
                @foreach($companies as $company)
                <div class="card">
                    <h3>{{$company->name}}</h3>
                    <p><b>Phone Number:</b> 0{{$company->phoneNo}}</p>
                    <p><b>Email Address:</b> {{$company->email}}</p>
                    <p><b>Site Address:</b> {{$company->address}}</p>
                </div>
                @endforeach
            @else 
                <div class="card">
                    <h3>No companies added</h3>
                </div>
                
            @endif
        </article>

        <aside>
            <h3>Add New</h3>

            <form action="{{ route('storeCompany') }}" method="post" enctype="multipart/form-data">
                @include('includes.error')

                <label for="name">Company Name:</label>
                <input type="text" name="name" id="name">

                <label for="phoneNo">Phone Number:</label>
                <input type="text" name="phoneNo" id="phoneNo">

                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email">

                <label for="address">Site Address</label>
                <textarea name="address" id="address"></textarea>

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection