@extends('layouts.app')

@section('title', 'Create New Project')

@section('content')
<header>
    @include('includes.header', ['title' => 'Create New Project'])
</header> 

<main>
    <div class="back">
        <a href="/"> <i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    @include('includes.success')

    <section>
        <form action="{{ route('storeProjectDetails') }}" method="post" class="fullPage">
            @include('includes.error')

            <label for="title">Project Title:</label>
            <input type="text" name="title" id="title">

            <label for="jobNo">Job Number:</label>
            <input type="text" name="jobNo" id="jobNo">

            <label for="client_id">Client:</label>
            <select name="client_id" id="client_id">
                <option value="">Select...</option>
                @foreach($clients as $client)
                <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
            </select>

            <label for="location">Site Address:</label>
            <input type="text" name="location" id="location">

            <label for="start">Start Date:</label>
            <input type="date" name="start" id="start">
            
            <label for="end">End Date:</label>
            <input type="date" name="end" id="end">

            <label for="workingHours">Working Hours:</label>
            <input type="text" name="workingHours" id="workingHours">

            <label for="hosital_id">Nearest A&E:</label>
            <select name="hospital_id" id="hospital_id">
                <option value="">Select...</option>
                @foreach($hospitals as $hospital)
                <option value="{{$hospital->id}}">{{$hospital->name}}</option>
                @endforeach
            </select>
            
            <label for="manager_id">Site Manager:</label>
                <select name="manager_id" id="manager_id">
                <option value="">Select...</option>
                @foreach($operatives as $operative)
                <option value="{{$operative->id}}">{{$operative->name}}</option>
                @endforeach
            </select>

            <label for="supervisor_id">Site Supervisor:</label>
            <select name="supervisor_id" id="supervisor_id">
                <option value="">Select...</option>
                @foreach($operatives as $operative)
                <option value="{{$operative->id}}">{{$operative->name}}</option>
                @endforeach
            </select>

            <label for="operative_id">Project Operatives (Select all that apply)</label>
            <div class="checkboxes">
                @foreach($operatives as $operative)
                <div>
                    <input type="checkbox" name="operative_id[]" id="operative_id" value="{{ $operative->id }}">
                    <label for="operative_id">{{$operative->name}}</label>
                </div>
                @endforeach
            </div>

            <input type="submit" value="Next">

        </form>
    </section>
</main>

@endsection