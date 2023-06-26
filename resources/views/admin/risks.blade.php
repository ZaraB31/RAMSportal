@extends('layouts.app')

@section('title', 'Admin - Risks')

@section('content')
<header>
    @include('includes.header', ['title' => 'Admin - Risks'])
</header> 

<main>
<section class="projectsSearch">
        <div>
            <a href="/Admin"> <i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>

        <button><a href="/Admin/Risks/Create">Add New Risk</a></button>
    </section>

    @include('includes.success')

    <section>
        <table>
            <tr>
                <th style="width:42%">Hazard</th>
                <th style="width:34%">Risk Type</th>
                <th style="width:12%">Risk</th>
                <th style="width:12%">Residual Risk</th>
            </tr>
            @if($sections->count() > 0)
                @foreach($sections as $section)
                <tr onClick="openTable('{{$section->name}}')" class="riskTitle" id="{{$section->name}}">
                    <td colspan="4">{{$section->name}} <i class="fa-solid fa-chevron-down"></i></td>
                </tr>
                @foreach($section->risk->sortBy('hazard') as $risk)
                <tr class="risk {{$section->name}}" style="display:none;">
                    <td><a href="/Admin/Risks/Edit/{{$risk->id}}" style="margin-right:10px;"><i class="fa-solid fa-pen-to-square"></i></a><i onclick="openForm('DeleteRisk', {{$risk->id}})" style="margin-right:10px;" class="fa-regular fa-trash-can"></i>{{$risk->hazard}}</td> 
                    <td>{{$risk->type->type}}</td>
                    @if($before[$risk->id] <= 5)
                        <td style="background-color: #08bf1c; border-bottom: 2px solid #0AF023">{{$risk->likelihood}} x {{$risk->severity}} = {{ $before[$risk->id] }}</td>
                    @elseif($before[$risk->id] >= 6 AND $before[$risk->id] <= 10)
                        <td style="background-color: #F6A21E; border-bottom: 2px solid #D88809">{{$risk->likelihood}} x {{$risk->severity}} = {{ $before[$risk->id] }}</td>
                    @elseif($before[$risk->id] >= 11)
                        <td style="background-color: #F6361E; border-bottom: 2px solid #D82009">{{$risk->likelihood}} x {{$risk->severity}} = {{ $before[$risk->id] }}</td>
                    @endif

                    @if($after[$risk->id] <= 5)
                        <td style="background-color: #08bf1c; border-bottom: 2px solid #0AF023">{{$risk->residualLikelihood}} x {{$risk->residualSeverity}} = {{ $after[$risk->id] }}</td>
                    @elseif($after[$risk->id] >= 6 AND $after[$risk->id] <= 10)
                        <td style="background-color: #F6A21E; border-bottom: 2px solid #D88809">{{$risk->residualLikelihood}} x {{$risk->residualSeverity}} = {{ $after[$risk->id] }}</td>
                    @elseif($after[$risk->id] >= 11)
                        <td style="background-color: #F6361E; border-bottom: 2px solid #D82009">{{$risk->residualLikelihood}} x {{$risk->residualSeverity}} = {{ $after[$risk->id] }}</td>
                    @endif
                </tr>
                @endforeach
                @endforeach
            @else
            <tr>
                <td colspan="4">No risks added</td>
            </tr>
            @endif
        </table>
    </section>
</main>

<div class="deleteForm" id="DeleteRisk" style="display:none;">
    <h2>Are you sure you want to delete this risk?</h2>
    <p>By deleting the risk, you will also delete any data associated with it. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeleteRisk')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>

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