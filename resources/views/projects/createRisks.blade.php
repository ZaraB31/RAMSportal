@extends('layouts.app')

@section('title', 'Create New Project')

@section('content')
<header>
    @include('includes.header', ['title' => 'Create New Project'])
</header> 

<main>
    <h2>{{$project->title}} - Add Project Risks</h2>

    <section>
       <form action="{{ route('storeProjectRisks') }}" method="post">
            @include('includes.error')

            <table>
                @foreach($sections as $section)
                <tr>
                    <th style="width:10px; padding-right:5px;"><input type="checkbox" name="sectionTitle[]" id="{{$section->id}}"></th>
                    <th>{{$section->name}}</th>
                    @foreach($section->risk as $risk)
                    <tr>
                        <td style="width:10px; padding-right:5px;"><input type="checkbox" name="projectRisks[]" id="sectionTask_id"  class="{{$section->id}}" value="{{$risk->id}}"></td>
                        <td>{{$risk->hazard}}</td>
                    </tr>
                    @endforeach
                </tr>
                @endforeach
            </table>

            <input type="text" name="project_id" id="project_id" value="{{$project->id}}" style="display:none;">
            <input type="submit" value="Finish">
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

@endsection