@extends('layouts.app')

@section('title', 'Search')

@section('content')
<header>
    @include('includes.header', ['title' => 'Search'])
</header> 

<main>
    <section class="search">
        <button class="active searchButton" id="title">Search by Title</button>
        <button class="searchButton" id="client">Search by Client</button>
        <button class="searchButton" id="company">Search by Company</button>

        <form action="" class="searchForm" method="POST" id="titleForm">
            @csrf
            <input type="text" name="search" id="searchTitle" placeholder='Search by Project Title'>
        </form>

        <form action="" class="searchForm" method="POST" id="clientForm" style="display:none">
            @csrf
            <input type="text" name="search" id="searchClient" placeholder='Search by Client'>
        </form>

        <form action="" class="searchForm" method="POST" id="companyForm" style="display:none">
            @csrf
            <input type="text" name="search" id="searchCompany" placeholder='Search by Company'>
        </form>
    </section>

    <section>
        <table>
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Client</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </section>
</main>

<script>
    $(".search").on("click", ".searchButton", function() {
        $(".searchButton").removeClass("active");
        $(this).addClass("active");
        var inputs = $(".searchForm").children(":text");
        inputs.each(function() {
            $(this).val('');
        });
        $(".searchForm").hide();

        var formID ='#' + $(this).attr("id") + 'Form';
        $(formID).show();
    });
</script>

<script>
    $('#searchTitle').on('keyup', function() {
        var type = 'Title';
        search('/SearchTitle', type);
    });

    $('#searchClient').on('keyup', function() {
        var type = 'Client';
        search('/SearchClient', type);
    });

    $('#searchCompany').on('keyup', function() {
        var type = 'Company';
        search('/SearchCompany', type);
    });

    function search(url, type) {
        var keyword = $('#search' +type).val();
        $.ajax({
            type: "POST",
            url: url,
            data: { keyword: keyword, _token: '{{csrf_token()}}' },
            success: function(data) {
                table_post_row(data);
            },
            error: function (data, textStatus, errorThrown) {
                console.log(data);
            },
        });
    }

    function table_post_row(res) {
        let htmlView = '';

        if(res.projects.length <= 0) {
            htmlView += '<tr> <td colspan="3">No Results Found </td> </tr>'
        }

        for(i=0; i<res.projects.length; i++) {
            htmlView += '<tr><td><a href="/Project/' +res.projects[i].projectID+ '">' +res.projects[i].name+ '<i class="fa-solid fa-arrow-right"></i></a></td><td>' +res.projects[i].client+ '</td><td>' +res.projects[i].company+ '</td></tr>'
        }

        $('tbody').html(htmlView);
    }
</script>

@endsection