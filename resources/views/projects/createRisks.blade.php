@extends('layouts.app')

@section('title', 'Create New Project')

@section('content')
<header>
    @include('includes.header', ['title' => 'Create New Project'])
</header> 

<main>
    <h2>{{$project->title}} - Add Project Risks</h2>

    <section>
       <form action="{{ route('storeProjectRisks', $project->id) }}" method="post">
            @include('includes.error')

            <table>
                @foreach($sections as $section)
                <tr onClick="openTable('{{$section->name}}')" class="riskTitle" id="{{$section->name}}">
                    <th style="width:10px; padding-right:5px; border-bottom: 2px solid #F6A21E;"><input type="checkbox" name="sectionTitle[]" id="{{$section->id}}"></th>
                    <th style="border-bottom: 2px solid #F6A21E;">{{$section->name}} <i style="margin-left:8px" class="fa-solid fa-chevron-down"></i></th>
                    @foreach($section->risk as $risk)
                    <tr class="risk {{$section->name}}" style="display:none;">
                        <td style="width:10px; padding-right:5px;"><input type="checkbox" name="projectRisks[]" id="sectionTask_id"  class="{{$section->id}}" value="{{$risk->id}}"></td>
                        <td>{{$risk->hazard}}</td>
                    </tr>
                    @endforeach
                </tr>
                @endforeach
            </table>

            <input style="margin-bottom: 20px;" type="submit" value="Finish">
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

<script type="application/javascript">
    function openTable(sectionID) {
        risks = document.getElementsByClassName(sectionID);
        for(i=0; i<risks.length; i++) {
            if(risks[i].style.display === 'none') {
                risks[i].style.display = 'table-row';
            } else if(risks[i].style.display === 'table-row') {
                risks[i].style.display = 'none';
            }
        }
    }
</script>

@endsection