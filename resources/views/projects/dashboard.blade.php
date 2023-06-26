@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<header>
    @include('includes.header', ['title' => 'Projects'])
</header> 

<main>
    <section class="projectsSearch">
        <h2 style="margin:0;">Hello {{$user->name}}</h2>
        <button><a href="/Project/Create/Details">Add New</a></button>
    </section>

    <section>
        <table>
            <tr>
                <th>Project Title</th>
                <th>Company</th>
                <th>Date Created</th>
                <th colspan="2">Created By</th>
            </tr>
            @if($projects->count() > 0)
                @foreach($projects as $project)
                <tr>
                    <td><a href="/Project/{{$project->id}}">{{$project->title}} <i class="fa-solid fa-arrow-right"></i></a></td>
                    <td>{{$project->company->name}}</td>
                    <td>{{date('j F Y', strtotime($project->created_at))}}</td>
                    <td>{{$project->user->name}}</td>
                    @if($user->name === $project->user->name)
                    <td><i onclick="openForm('DeleteProject', {{$project->id}})" class="fa-regular fa-trash-can"></i></td>
                    @endif
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

<div class="deleteForm" id="DeleteProject" style="display:none;">
    <h2>Are you sure you want to delete this project?</h2>
    <p>By deleting the project, you will also delete any data associated with it. Once it has been deleted, it can not be restored.</p>

    <button onClick="closeForm('DeleteProject')">Cancel</button>

    <form action="" method="post">
        @include('includes.error')
        @method('DELETE')
        <input class="delete" type="submit" value="Delete">
    </form>
</div>

@endsection