@extends('layouts.app')

@section('title', 'Admin - Create Risk')

@section('content')
<header>
    @include('includes.header', ['title' => 'Admin - Create Risk'])
</header> 

<main>
    <div class="back">
        <a href="/Admin/Risks"> <i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    <h2>Add New Risk</h2>

    <form class="fullPage" action="{{ route('storeRisk') }}" method="post">

        @include('includes.error')

        <label for="hazard">Hazard:</label>
        <input type="text" name="hazard" id="hazard">

        <label for="effect">Effect:</label>
        <input type="text" name="effect" id="effect">

        <label for="type_id">Risk Type:</label>
        <select name="type_id" id="type_id">
            <option value="">Select...</option>
            @foreach($types as $type)
            <option value="{{$type->id}}">{{$type->type}}</option>
            @endforeach
        </select>

        <label for="likelihood">Likelihood:</label>
        <select name="likelihood" id="likelihood">
            <option value="">Select...</option>
            <option value="1">1 - Improbable</option>
            <option value="2">2 - Remote</option>
            <option value="3">3 - Possible</option>
            <option value="4">4 - Probable</option>
            <option value="5">5 - Likely</option>
        </select>

        <label for="severity">Severity:</label>
        <select name="severity" id="severity">
            <option value="">Select...</option>
            <option value="1">1 - No Injury</option>
            <option value="2">2 - Minor Injury</option>
            <option value="3">3 - 3-day Injury</option>
            <option value="4">4 - Major Injury</option>
            <option value="5">5 - Fatality</option>
        </select>

        <label for="control">Control Measures:</label>
        <textarea name="control" id="control"></textarea>

        <label for="residualLikelihood">Residual Likelihood:</label>
        <select name="residualLikelihood" id="residualLikelihood">
            <option value="">Select...</option>
            <option value="1">1 - Improbable</option>
            <option value="2">2 - Remote</option>
            <option value="3">3 - Possible</option>
            <option value="4">4 - Probable</option>
            <option value="5">5 - Likely</option>
        </select>

        <label for="residualSeverity">Residual Severity:</label>
        <select name="residualSeverity" id="residualSeverity">
            <option value="">Select...</option>
            <option value="1">1 - No Injury</option>
            <option value="2">2 - Minor Injury</option>
            <option value="3">3 - 3-day Injury</option>
            <option value="4">4 - Major Injury</option>
            <option value="5">5 - Fatality</option>
        </select>

        <label for="person_id">People at Risk:</label>
        <select name="person_id" id="person_id">
            <option value="">Select...</option>
            @foreach($people as $person)
            <option value="{{$person->id}}">{{$person->person}}</option>
            @endforeach
        </select>

        <label for="section_id">Applies to (select all that apply)</label>
        <div class="checkboxes">
            @foreach($sections as $section)
            <div>
                <input type="checkbox" name="sections[]" id="sections" value="{{$section->id}}">
                <label for="sections">{{$section->name}}</label>
            </div>
            @endforeach
        </div>

        <input type="submit" value="Save">
    </form>
</main>

@endsection