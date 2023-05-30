@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<header>
    @include('includes.header', ['title' => 'Projects'])
</header> 

<main>
    <section class="projectsSearch" style="justify-content:flex-end;">
        <button><a href="/Project/Create/Details">Add New</a></button>
    </section>

    <section>
        <table>
            <tr>
                <th>Project Title</th>
                <th>Company</th>
                <th>Date Created</th>
                <th>Created By</th>
            </tr>
            @if($projects->count() > 0)
                @foreach($projects as $project)
                <tr>
                    <td><a href="/Project/{{$project->id}}">{{$project->title}} <i class="fa-solid fa-arrow-right"></i></a></td>
                    <td>{{$project->company->name}}</td>
                    <td>{{date('j F Y', strtotime($project->created_at))}}</td>
                    <td>{{$project->user->name}}</td>
                </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="3">No Projects added yet</td>
                </tr>
            @endif
        </table>
    </section>
</main>

@endsection