@extends('layouts.app')

@section('title', $project->title)

@section('content')
<header>
    @include('includes.header', ['title' => 'Edit - ' . $project->title ])
</header>

<main>
    <div class="back">
        <a href="/Project/{{$project->id}}"> <i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    @include('includes.success')

    <section>
        <form action="{{ route('updateProject', $project->id) }}" method="post" class="fullPage">
            @include('includes.error')

            <h2>Project Details</h2>

            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{$project->title}}">

            <label for="jobNo">Job Number:</label>
            <input type="text" name="jobNo" id="jobNo" value="{{$project->jobNo}}">

            <label for="location">Site Address:</label>
            <input type="text" name="location" id="location" value="{{$project->detail->location}}">

            <label for="start">Start Date:</label>
            <input type="date" name="start" id="start" value="{{$project->detail->start}}">
            
            <label for="end">End Date:</label>
            <input type="date" name="end" id="end" value="{{$project->detail->end}}">

            <label for="workingHours">Working Hours:</label>
            <input type="text" name="workingHours" id="workingHours" value="{{$project->detail->workingHours}}">

            <label for="hospital_id">Nearest A+E:</label>
            <select name="hospital_id" id="hospital_id">
                @foreach($hospitals as $hospital)
                    @if($hospital->id === $project->detail->hospital_id)
                    <option value="{{$hospital->id}}" selected>{{$hospital->name}}</option>
                    @else 
                    <option value="{{$hospital->id}}">{{$hospital->name}}</option>
                    @endif
                @endforeach
            </select>

            <label for="supervisor_id">Project Supervisor:</label>
            <select name="supervisor_id" id="supervisor_id">
                @foreach($operatives as $operative)
                    @if($operative->id === $project->detail->supervisor_id)
                    <option value="{{$operative->id}}" selected>{{$operative->name}}</option>
                    @else
                    <option value="{{$operative->id}}">{{$operative->name}}</option>
                    @endif
                @endforeach
            </select>

            <label for="manager_id">Project Manager:</label>
            <select name="manager_id" id="manager_id">
                @foreach($operatives as $operative)
                    @if($operative->id === $project->detail->manager_id)
                    <option value="{{$operative->id}}" selected>{{$operative->name}}</option>
                    @else
                    <option value="{{$operative->id}}">{{$operative->name}}</option>
                    @endif
                @endforeach
            </select>

            <label for="emergencyPhone">Out of hours phone number:</label>
            <input type="text" name="emergencyPhone" id="emergencyPhone" value="0{{$project->detail->emergencyPhone}}">

            <label for="operatives">Project Operatives</label>
            <div class="checkboxes">
                @foreach($operatives as $operative)
                <div>
                    
                    @if(in_array($operative->id, $projectOperatives))
                    <input checked type="checkbox" name="operative[]" id="operative_id" value="{{$operative->id}}">
                    <label for="operative_id">{{$operative->name}}</label>
                    @else
                    <input type="checkbox" name="operative[]" id="operative_id" value="{{$operative->id}}">
                    <label for="operative_id">{{$operative->name}}</label>
                    @endif
                    
                </div>
                @endforeach
            </div>

            <label for="qualifications">Training Requirements</label>
            <div class="checkboxes">
                @foreach($qualifications as $qualification)
                <div>
                    @if(in_array($qualification->id, $proQualifications))
                    <input type="checkbox" name="qualification[]" id="qualifcation_id" value="{{$qualification->id}}" checked>
                    <label for="qualifcation">{{$qualification->name}}</label>
                    @else
                    <input type="checkbox" name="qualification[]" id="qualifcation_id" value="{{$qualification->id}}">
                    <label for="qualifcation">{{$qualification->name}}</label>
                    @endif
                </div>
                @endforeach
            </div>

            <h2 style="margin-top: 50px; border-top: 2px solid black; padding-top:20px;">Project Methods</h2>

            <label for="description">Project Description</label>
            <textarea name="description" id="description">{{$project->method->description}}</textarea>

            <label for="">Sequence of Works</label>
            <div class="sequence">
                <div id="addStep" class="add"><i class="fa-solid fa-plus"></i></div>
                @foreach($sequenceSteps as $step)
                <input type="text" name="sequenceStep[]" id="sequenceStep" value="{{$step->description}}">
                @endforeach
            </div>

            <label for="tools">Tools:</label>
            <div class="checkboxes">
                @foreach($tools as $tool)
                @if(in_array($tool->id, $projectTools))                   
                    <div>
                        <input type="checkbox" name="tools[]" id="tools" value="{{$tool->id}}" checked>
                        <label for="tools">{{$tool->name}}</label>
                    </div>  
                @else
                    <div>
                        <input type="checkbox" name="tools[]" id="tools" value="{{$tool->id}}">
                        <label for="tools">{{$tool->name}}</label>
                    </div> 
                @endif  
                @endforeach
            </div>

            <label for="PPEs">PPE:</label>
            <div class="checkboxes">
                @foreach($PPEs as $PPE)
                @if(in_array($PPE->id, $projectPPEs))                   
                    <div>
                        <input type="checkbox" name="PPEs[]" id="PPEs" value="{{$PPE->id}}" checked>
                        <label for="PPEs">{{$PPE->name}}</label>
                    </div>  
                @else
                    <div>
                        <input type="checkbox" name="PPEs[]" id="PPEs" value="{{$PPE->id}}">
                        <label for="PPEs">{{$PPE->name}}</label>
                    </div> 
                @endif           
                @endforeach
            </div>

            <h2 style="margin-top: 50px; border-top: 2px solid black; padding-top:20px;">Project Risks</h2>

            <table>
                @foreach($sections as $section)
                <tr>
                    <th style="width:10px; padding-right:5px;"><input type="checkbox" name="sectionTitle[]" id="{{$section->id}}"></th>
                    <th>{{$section->name}}</th>
                    @foreach($section->risk as $risk)
                    <tr>
                        @if(in_array($risk->id, $projectRisks))
                        <td colspan="2"><input value="{{$risk->id}}" type="checkbox" name="projectRisks[]" id="sectionTask_id"  class="{{$section->id}}" id="risk_id" checked>{{$risk->hazard}}</td>
                        @else
                        <td colspan="2"><input value="{{$risk->id}}" type="checkbox" name="projectRisks[]" id="sectionTask_id"  class="{{$section->id}}" id="risk_id">{{$risk->hazard}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tr>
                @endforeach
            </table>

            <h2 style="margin-top: 50px; border-top: 2px solid black; padding-top:20px;">Ammendment Comments</h2>
            <textarea name="comment" id="comment" placeholder="Add comments on the updates made here. This will be shown in the revisions tables at the back of the document."></textarea>

            <input type="submit" value="Update">
        </form>
    </section>
</main>

<script>
    $(document).on('change', '[name="sectionTitle[]"]', function(ev) {
        var checkbox = $(this);
        var value = checkbox.val();
        var id = checkbox.attr('id');
        var hazards = $('.' + id);

        if(checkbox.is(':checked')) {
            hazards.each(function(i) {
                $(this).prop("checked", true);
            });
        } else {
            hazards.each(function(i) {
                $(this).prop("checked", false);
            });
        };
    });
</script>

<script>
    $(document).ready(function() {
        var wrapper = $(".sequence");
        var add_button = $("#addStep");

        $(add_button).click(function(e) {
            e.preventDefault();
            var stepCount = $(".sequence input").length;
            stepCount += 1;
            console.log(stepCount);
            var inputField = '<input type="text" name="sequenceStep[]" id="sequenceStep" placeholder="Step ' + stepCount + '">';
            $(wrapper).append(inputField);
        });
    });
</script>
@endsection