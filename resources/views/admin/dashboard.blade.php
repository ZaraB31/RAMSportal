@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<header>
    @include('includes.header', ['title' => 'Admin'])
</header> 

<main>
    <section>
        <table class="fullPage">
            <tr>
                <th>Admin</th>
            </tr>
            <tr><td><a href="/Admin/Companies">Companies <i class="fa-solid fa-arrow-right"></i></a></td></tr>
            <tr><td><a href="/Admin/Users">Users <i class="fa-solid fa-arrow-right"></i></a></td></tr>            
            <tr><td><a href="/Admin/Clients">Clients <i class="fa-solid fa-arrow-right"></i></a></td></tr>
            <tr><td><a href="/Admin/Operatives">Operatives <i class="fa-solid fa-arrow-right"></i></a></td></tr>
            <tr><td><a href="/Admin/Hospitals">Hospitals <i class="fa-solid fa-arrow-right"></i></a></td></tr>
            <tr><td><a href="/Admin/PPE">PPE <i class="fa-solid fa-arrow-right"></i></a></td></tr>
            <tr><td><a href="/Admin/Tools">Tools <i class="fa-solid fa-arrow-right"></i></a></td></tr>
            <tr><td><a href="/Admin/People">People <i class="fa-solid fa-arrow-right"></i></a></td></tr>
            <tr><td><a href="/Admin/Sections">Sections <i class="fa-solid fa-arrow-right"></i></a></td></tr>
            <tr><td><a href="/Admin/Risks">Risks <i class="fa-solid fa-arrow-right"></i></a></td></tr>
        </table>
    </section>
</main>

@endsection