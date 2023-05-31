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
    <div class="back">
        <a href="/"> <i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    @include('includes.success')

    <article class="halfSection">
        <section >
            <h2>Project Details</h2>
            <p><b>Created by: </b>{{$project->user->name}}</p>
            <p><b>Compiled by: </b>{{$project->company->name}}</p>
            <p><b>Job number: </b>{{$project->jobNo}}</p>
            <p><b>Project client: </b>{{$project->client->name}}</p>
            <p><b>Site address: </b>{{$project->detail->location}}</p>
            <p><b>Start date: </b> {{date('jS F Y', strtotime($project->detail->start))}}</p>
            <p><b>End date: </b> {{date('jS F Y', strtotime($project->detail->end))}}</p>
            <p><b>Working Hours: </b>{{$project->detail->workingHours}}</p>
            <p><b>Nearest A&E: </b>{{$project->detail->hospital->name}} - {{$project->detail->hospital->address}}</p>
            <p><b>Site Manager: </b>{{$project->detail->manager->name}}</p>
            <p><b>Site Supervisor: </b>{{$project->detail->supervisor->name}}</p>
            <p><b>Out of hours phone number: </b>0{{$project->detail->emergencyPhone}}</p>
            <p><b>Training Requirements: </b>
                @if($project->qualification->count() === 0)
                No Qualifications added
                @else
                @foreach($project->qualification as $qualification)
                {{$qualification->name}},
                @endforeach
                @endif   
            </p>
            <p><b>Site Operatives: </b>
            @if($project->operative->count() === 0)
                No Operatives Added 
            @else
            <div class="siteOperatives">
                @foreach($project->operative as $operative)
                <div>
                    <img src="/ProfilePictures/{{$operative->profilePic}}" alt="{{$operative->name}}">
                    <h3>{{$operative->name}}</h3>
                    <p><b>Company: </b>{{$operative->company->name}}</p>
                    <p><b>Qualifications: </b>
                    @foreach($operative->qualification as $qualification)
                    {{$qualification->name}},
                    @endforeach
                    </p>
                </div>
                @endforeach
            </div>
                
            @endif
            </p>
            
        </section>

        <aside>
            <h2>Project Approval</h2>
            @if($project->approval === null)
                @if($userID !== $project->user_id)
                <p>This project has not been approved. As this is your own project, please get another member of staff to approve it.</p>
                @else
                <p>By approving this project you are confirming the information provided is accurate and relevant.</p>
                <form action="{{ route('approveProject', $project->id) }}" method="post">
                    @include('includes.error')

                    <input style="width:100%;" class="inverse" type="submit" value="I Approve">
                </form>
                @endif
            @else 
            <p>Project approved by {{$project->approval->user->name}} at {{date('g:ia', strtotime($project->approval->created_at))}} on the {{date('jS F Y', strtotime($project->approval->created_at))}}</p>
           
            <h2>Project Versions</h2>
            
                <ul>
                    @foreach($versions as $version)
                    <li><a href="/Project/{{$project->id}}/download/{{$version->version}}">Version {{$version->version}} - {{$version->fileName}} <i class="fa-solid fa-download"></i></a></li>
                    @endforeach
                </ul>

                <button class="inverse"><a href="/Project/{{$project->id}}/Edit">Update Project</a></button>
            @endif

            
        </aside>
    </article>
    

    <section>
        <h2>Project Methods:</h2>
        <section class="methods">
            <div>
                <p><b>Project Description:</b></p>
                <textarea id="content">{{$project->method->description}}</textarea>
            </div>

            <div>
                <p><b>PPE:</b></p>
                <ul>
                    @foreach($project->method->PPE as $ppe)
                    <li>{{$ppe->name}}</li>
                    @endforeach
                </ul>  
            </div>

            <div>
                <p><b>Sequence of Works:</b></p>
                @foreach($project->method->sequence as $sequence)
                    <p style="margin:0;">{{$sequence->stepNo}}. {{$sequence->description}}</p>
                @endforeach  
            </div>
              
            <div>
                <p><b>Tools:</b></p>
                <ul>
                    @foreach($project->method->tool as $tool)
                    <li>{{$tool->name}}</li>
                    @endforeach
                </ul> 
            </div>
            
        </section>
        
    </section>

    <section>
        <h2>Project Risks</h2>
        <table>
            <tr>
                <th colspan="3">Project Risks</th>
            </tr>
            @foreach($project->risk->sortBy('hazard') as $risk) 
            <tr>
                <td>{{$risk->hazard}}</td>
                @if($before[$risk->id] <= 5)
                    <td style="width: 15%; background-color: #08bf1c; border-bottom: 2px solid #0AF023">{{$risk->likelihood}} x {{$risk->severity}} = {{ $before[$risk->id] }}</td>
                @elseif($before[$risk->id] >= 6 AND $before[$risk->id] <= 10)
                    <td style="width: 15%; background-color: #F6A21E; border-bottom: 2px solid #D88809">{{$risk->likelihood}} x {{$risk->severity}} = {{ $before[$risk->id] }}</td>
                @elseif($before[$risk->id] >= 11)
                    <td style="width: 15%; background-color: #F6361E; border-bottom: 2px solid #D82009">{{$risk->likelihood}} x {{$risk->severity}} = {{ $before[$risk->id] }}</td>
                @endif

                @if($after[$risk->id] <= 5)
                    <td style="width: 15%; background-color: #08bf1c; border-bottom: 2px solid #0AF023">{{$risk->residualLikelihood}} x {{$risk->residualSeverity}} = {{ $after[$risk->id] }}</td>
                @elseif($after[$risk->id] >= 6 AND $after[$risk->id] <= 10)
                    <td style="width: 15%; background-color: #F6A21E; border-bottom: 2px solid #D88809">{{$risk->residualLikelihood}} x {{$risk->residualSeverity}} = {{ $after[$risk->id] }}</td>
                @elseif($after[$risk->id] >= 11)
                    <td style="width: 15%; background-color: #F6361E; border-bottom: 2px solid #D82009">{{$risk->residualLikelihood}} x {{$risk->residualSeverity}} = {{ $after[$risk->id] }}</td>
                @endif
            </tr>
            @endforeach
        </table>
    </section>
</main>

@endsection