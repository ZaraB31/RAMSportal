@extends('layouts.app')

@section('title', 'Edit Risk')

@section('content')
<header>
    @include('includes.header', ['title' => 'Edit - ' . $risk->hazard])
</header> 

<main>
    <div class="back">
        <a href="/Admin/Risks"> <i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    <h2>Edit Risk - {{$risk->hazard}}</h2>

    <form class="fullPage" action="{{ route('updateRisk', $risk->id) }}" method="post">

        @include('includes.error')

        <label for="hazard">Hazard:</label>
        <input type="text" name="hazard" id="hazard" value="{{$risk->hazard}}">

        <label for="effect">Effect:</label>
        <input type="text" name="effect" id="effect" value="{{$risk->effect}}">

        <label for="type_id">Risk Type:</label>
        <select name="type_id" id="type_id">
            <option value="">Select...</option>
            @foreach($types as $type)
            <option value="{{$type->id}}" {{ $risk->type_id == $type->id ? 'selected' : '' }}>{{$type->type}}</option>
            @endforeach
        </select>

        <label for="likelihood">Likelihood:</label>
        <select name="likelihood" id="likelihood">
            <option value="">Select...</option>
            <option value="1" {{ $risk->likelihood == 1 ? 'selected' : '' }}>1 - Improbable</option>
            <option value="2" {{ $risk->likelihood == 2 ? 'selected' : '' }}>2 - Remote</option>
            <option value="3" {{ $risk->likelihood == 3 ? 'selected' : '' }}>3 - Possible</option>
            <option value="4" {{ $risk->likelihood == 4 ? 'selected' : '' }}>4 - Probable</option>
            <option value="5" {{ $risk->likelihood == 5 ? 'selected' : '' }}>5 - Likely</option>
        </select>

        <label for="severity">Severity:</label>
        <select name="severity" id="severity">
            <option value="">Select...</option>
            <option value="1" {{ $risk->severity == 1 ? 'selected' : '' }}>1 - No Injury</option>
            <option value="2" {{ $risk->severity == 2 ? 'selected' : '' }}>2 - Minor Injury</option>
            <option value="3" {{ $risk->severity == 3 ? 'selected' : '' }}>3 - 3-day Injury</option>
            <option value="4" {{ $risk->severity == 4 ? 'selected' : '' }}>4 - Major Injury</option>
            <option value="5" {{ $risk->severity == 5 ? 'selected' : '' }}>5 - Fatality</option>
        </select>

        <label for="control">Control Measures:</label>
        <textarea name="control" id="control">{{$risk->control}}</textarea>

        <label for="residualLikelihood">Residual Likelihood:</label>
        <select name="residualLikelihood" id="residualLikelihood">
            <option value="">Select...</option>
            <option value="1" {{ $risk->residualLikelihood == 1 ? 'selected' : '' }}>1 - Improbable</option>
            <option value="2" {{ $risk->residualLikelihood == 2 ? 'selected' : '' }}>2 - Remote</option>
            <option value="3" {{ $risk->residualLikelihood == 3 ? 'selected' : '' }}>3 - Possible</option>
            <option value="4" {{ $risk->residualLikelihood == 4 ? 'selected' : '' }}>4 - Probable</option>
            <option value="5" {{ $risk->residualLikelihood == 5 ? 'selected' : '' }}>5 - Likely</option>
        </select>

        <label for="residualSeverity">Residual Severity:</label>
        <select name="residualSeverity" id="residualSeverity">
            <option value="">Select...</option>
            <option value="1" {{ $risk->residualSeverity == 1 ? 'selected' : '' }}>1 - No Injury</option>
            <option value="2" {{ $risk->residualSeverity == 2 ? 'selected' : '' }}>2 - Minor Injury</option>
            <option value="3" {{ $risk->residualSeverity == 3 ? 'selected' : '' }}>3 - 3-day Injury</option>
            <option value="4" {{ $risk->residualSeverity == 4 ? 'selected' : '' }}>4 - Major Injury</option>
            <option value="5" {{ $risk->residualSeverity == 5 ? 'selected' : '' }}>5 - Fatality</option>
        </select>

        <label for="person_id">People at Risk:</label>
        <select name="person_id" id="person_id">
            <option value="">Select...</option>
            @foreach($people as $person)
            <option value="{{$person->id}}" {{ $risk->person_id == $person->id ? 'selected' : '' }}>{{$person->person}}</option>
            @endforeach
        </select>

        <label for="section_id">Applies to (select all that apply)</label>
        <div class="checkboxes">
            @foreach($sections as $section)
            @if(in_array($section->id, $riskSectionIds))
            <div>
                <input type="checkbox" name="sections[]" id="sections" value="{{$section->id}}" checked>
                <label for="sections">{{$section->name}}</label>
            </div>
            @else
            <div>
                <input type="checkbox" name="sections[]" id="sections" value="{{$section->id}}">
                <label for="sections">{{$section->name}}</label>
            </div>
            @endif
            @endforeach
        </div>

        <input type="submit" value="Save">
    </form>
</main>

@endsection