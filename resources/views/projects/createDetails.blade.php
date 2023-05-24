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
            <input type="text" name="title" id="title" value="{{ old('title') }}">

            <label for="jobNo">Job Number (Uppercase):</label>
            <input type="text" name="jobNo" id="jobNo" value="{{ old('jobNo') }}">

            <label for="client_id">Client:</label>
            <select name="client_id" id="client_id" value="{{ old('client_id') }}">
                <option value="">Select...</option>
                @foreach($clients as $client)
                <option value="{{$client->id}}" @selected(old('client_id') == $client->id)>{{$client->name}}</option>
                @endforeach
            </select>

            <label for="location">Site Address:</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}">

            <label for="start">Start Date:</label>
            <input type="date" name="start" id="start" value="{{ old('start') }}">
            
            <label for="end">End Date:</label>
            <input type="date" name="end" id="end" value="{{ old('end') }}">

            <label for="workingHours">Working Hours:</label>
            <input type="text" name="workingHours" id="workingHours" value="{{ old('workingHours') }}">

            <label for="hosital_id">Nearest A&E:</label>
            <select name="hospital_id" id="hospital_id">
                <option value="">Select...</option>
                @foreach($hospitals as $hospital)
                <option value="{{$hospital->id}}" @selected(old('hospital_id') == $hospital->id)>{{$hospital->name}}</option>
                @endforeach
            </select>
            
            <label for="manager_id">Site Manager:</label>
                <select name="manager_id" id="manager_id">
                <option value="">Select...</option>
                @foreach($operatives as $operative)
                <option value="{{$operative->id}}" @selected(old('manager_id') == $operative->id)>{{$operative->name}}</option>
                @endforeach
            </select>

            <label for="supervisor_id">Site Supervisor:</label>
            <select name="supervisor_id" id="supervisor_id">
                <option value="">Select...</option>
                @foreach($operatives as $operative)
                <option value="{{$operative->id}}" @selected(old('supervisor_id') == $operative->id)>{{$operative->name}}</option>
                @endforeach
            </select>

            <label for="emergencyPhone">Out of hours phone number:</label>
            <input type="text" name="emergencyPhone" id="emergencyPhone" value="{{ old('emergencyPhone') }}">
            
            <label for="qualifications">Training Requirements (select all that apply)</label>
            <div class="checkboxes">
                @foreach($qualifications as $qualification)
                <div>
                    <input type="checkbox" name="qualifications[]" id="qualification_id" value="{{$qualification->id}}">
                    <label for="qualifications">{{$qualification->name}}</label>
                </div>
                @endforeach
            </div>

            <label for="operative_id">Project Operatives (Select all that apply, this should include the Site Manager and Site Supervisor)</label>
            <div class="checkboxes">
                @foreach($operatives as $operative)
                <div class="operativeCheckbox">
                    <input type="checkbox" name="operative_id[]" id="operative_id" value="{{ $operative->id }}">
                    <label for="operative_id">{{$operative->name}}</label>
                    <p><b>Company: </b>{{$operative->company->name}}</p>
                    <p><b>Qualifications:</b>
                    @foreach($operative->qualification as $qualification)
                    {{$qualification->name}},
                    @endforeach
                    </p>
                </div>
                @endforeach
            </div>        

            <input type="submit" value="Next">

        </form>
    </section>
</main>

@endsection