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
            @if($operatives->count() > 0)
                @foreach($operatives as $operative)
                <div class="operative card">
                    <img src="/ProfilePictures/{{$operative->profilePic}}" alt="{{$operative->name}}">
                    <div>
                        <h3>{{$operative->name}}</h3>
                        <p><b>Company: </b>{{$operative->company->name}}</p>
                        <p><b>Position: </b>{{$operative->position}}</p>
                        <p><b>Phone Number: </b>0{{$operative->phoneNo}}</p>
                        <p><b>Qualifications: </b>
                        @foreach($operative->qualification as $qualification)
                        {{$qualification->name}}, 
                        @endforeach
                        </p>
                    </div>
                </div>
                @endforeach
            @else 
                <div class="card">
                    <h3>No operatives added</h3>
                </div>
            @endif
        </article>

        <aside>
            <h3>Add New Operative</h3>

            <form action="{{ route('storeOperative') }}" method="post" enctype="multipart/form-data">
                @include('includes.error')

                <label for="name">Name:</label>
                <input type="text" name="name" id="name">
                
                <label for="profilePic">Profile Picture:</label>
                <input type="file" name="profilePic" id="profilePic">

                <label for="phoneNo">Phone Number:</label>
                <input type="text" name="phoneNo" id="phoneNo">

                <label for="position">Position:</label>
                <input type="text" name="position" id="position">

                <label for="company_id">Company:</label>
                <select name="company_id" id="company_id">
                    <option value=".">Select..</option>
                    @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>

                <label for="qualification_id">Qualifications:</label>
                @foreach($qualifications as $qualification)
                <div>
                    <input type="checkbox" name="qualification_id[]" id="qualification_id" value="{{$qualification->id}}">
                    <label for="qualification_id">{{$qualification->name}}</label>
                </div>
                @endforeach

                <input class="inverse" type="submit" value="Save">
            </form>
        </aside>
    </section>
</main>

@endsection