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
                <th>Hazard</th>
                <th>Section(s)</th>
                <th>Risk</th>
                <th>Residual Risk</th>
            </tr>
            @if($risks->count() > 0)
                @foreach($risks as $risk)
                <tr>
                    <td>{{$risk->hazard}}</td> 
                    <td>
                        @foreach($risk->section as $section)
                        {{$section->name}},
                        @endforeach
                    </td>
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
            @else
            <tr>
                <td colspan="4">No risks added</td>
            </tr>
            @endif
        </table>
    </section>
</main>

@endsection