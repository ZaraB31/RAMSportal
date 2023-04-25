@extends('layouts.app')

@section('title', $project->title)

@section('content')
<header>
    @include('includes.header', ['title' => $project->title])
</header> 

<main>

</main>

@endsection