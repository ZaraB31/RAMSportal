@extends('layouts.app')

@section('title', $project->title)

@section('content')
<header>
    @include('includes.header', ['title' => $project->title])
</header> 

<script>
    $(document).ready(function() {
        var textarea = $('#content');
        var height = textarea.prop('scrollHeight') + 'px';

        textarea.height(height);
    });
</script>

<main>
    <section>
        <h2>Project Details</h2>
        <p><b>Created by: </b>{{$project->user->name}}</p>
        <p><b>Compiled by: </b>{{$project->company->name}}</p>
        <p><b>Job number: </b>{{$project->jobNo}}</p>
        <p><b>Project client: </b>{{$project->client->name}}</p>
        <p><b>Site address: </b>{{$project->detail->location}}</p>
        <p><b>Start date: </b> {{date('jS F Y', strtotime($project->detail->start))}}</p>
        <p><b>Working Hours: </b>{{$project->detail->workingHours}}</p>
        <p><b>Nearest A&E: </b>{{$project->detail->hospital->name}} - {{$project->detail->hospital->address}}</p>
        <p><b>Site Manager: </b>{{$project->detail->manager->name}}</p>
        <p><b>Site Supervisor: </b>{{$project->detail->supervisor->name}}</p>
        <p><b>Site Operatives: </b>
        @if($project->operative->count() === 0)
            No Operatives Added 
        @else
            @foreach($project->operative as $operative)
            {{$operative->name}},
            @endforeach
        @endif
        </p>
    </section>

    <section>
        <h2>Project Methods:</h2>
        <p><b>Project Description:</b></p>
        <textarea id="content">{{$project->method->description}}</textarea>

        <p><b>Sequence of Works:</b></p>
        @foreach($project->method->sequence as $sequence)
            <p>{{$sequence->stepNo}}. {{$sequence->description}}</p>
        @endforeach

        <p><b>PPE:</b></p>
        <ul>
            @foreach($project->method->PPE as $ppe)
            <li>{{$ppe->name}}</li>
            @endforeach
        </ul>

        <p><b>Tools:</b></p>
        <ul>
            @foreach($project->method->tool as $tool)
            <li>{{$tool->name}}</li>
            @endforeach
        </ul>
    </section>

    <section>
        <h2>Project Risks</h2>
        @foreach($project->risk as $risk) 
        <p>{{$risk->hazard}}</p>
        @endforeach
    </section>

</main>

@endsection