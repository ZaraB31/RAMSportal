@extends('layouts.app')

@section('title', 'Edit Operative')

@section('content')
<header>
    @include('includes.header', ['title' => 'Edit - ' . $operative->name])
</header>

<main>
    <div class="back">
        <a href="/Admin/Operative"> <i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    <h2>Edit Operative</h2>

    <img class="profile" src="/ProfilePictures/{{$operative->profilePic}}" alt="{{$operative->name}}">

    <form class="fullPage" action="{{ route('updateOperative', $operative->id) }}" method="post" enctype="multipart/form-data">
        @include('includes.error')

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{$operative->name}}"> 
        
        <label for="profilePic">Profile Picture:</label>
        <input type="file" name="profilePic" id="profilePic">
        
        <label for="phoneNo">Phone Number:</label>
        <input type="text" name="phoneNo" id="phoneNo" value="0{{$operative->phoneNo}}">

        <label for="position">Position:</label>
        <input type="text" name="position" id="position" value="{{$operative->position}}">

        <label for="company_id">Company:</label>
        <select name="company_id" id="company_id">
            <option value="">Select..</option>
            @foreach($companies as $company)
            <option value="{{$company->id}}" {{ $operative->company_id == $company->id ? 'selected' : '' }}>{{$company->name}}</option>
            @endforeach
        </select>

        <input type="submit" value="Save">
    </form>
</main>

@endsection