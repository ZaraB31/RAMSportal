@extends('layouts.app')

@section('title', 'Create New Project')

@section('content')
<header>
    @include('includes.header', ['title' => 'Create New Project'])
</header> 

<main>
    <h2>{{$project->title}} - Add Project Method</h2>

    <section>
        <form action="{{ route('storeProjectMethod', $project->id) }}" method="post" class="fullPage">
            @include('includes.error')

            <label for="description">Project Description:</label>
            <textarea name="description" id="description" value="{{ old('description') }}"></textarea>

            <label for="sequenceStep">Sequence of Works:</label>
            <div class="sequence">
                <div id="addStep" class="add"><i class="fa-solid fa-plus"></i></div>
                <input type="text" name="sequenceStep[]" id="sequenceStep" placeholder="Step 1" value="{{ old('sequenceStep') }}">
                <input type="text" name="sequenceStep[]" id="sequenceStep" placeholder="Step 2">
                <input type="text" name="sequenceStep[]" id="sequenceStep" placeholder="Step 3">
                <input type="text" name="sequenceStep[]" id="sequenceStep" placeholder="Step 4">
                <input type="text" name="sequenceStep[]" id="sequenceStep" placeholder="Step 5">
                <input type="text" name="sequenceStep[]" id="sequenceStep" placeholder="Step 6">
                <input type="text" name="sequenceStep[]" id="sequenceStep" placeholder="Step 7">
                <input type="text" name="sequenceStep[]" id="sequenceStep" placeholder="Step 8">
            </div>

            <label for="ppe_id">PPE Required (select all that apply)</label>
            <div class="checkboxes">
                @foreach($PPEs as $ppe)
                <div>
                    <input type="checkbox" name="ppe_id[]" id="ppe_id" value="{{ $ppe->id }}">
                    <label for="ppe_id">{{$ppe->name}}</label>
                </div>
                @endforeach
            </div>

            <label for="tool_id">Tools Required (select all that apply)</label>
            <div class="checkboxes">
                @foreach($tools as $tool)
                <div>
                    <input type="checkbox" name="tool_id[]" id="tool_id" value="{{ $tool->id }}">
                    <label for="tool_id">{{$tool->name}}</label>
                </div>
                @endforeach
            </div>
            
            <input type="submit" value="Next">
        </form>
    </section>
</main>

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