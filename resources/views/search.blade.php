@extends('layouts.app')

@section('title', 'Search')

@section('content')
<header>
    @include('includes.header', ['title' => 'Search'])
</header> 

<main>
    <section>
        <form action="" method="POST">
            @csrf

            <input type="text" name="search" id="search" placeholder='Search...'>
        </form>
    </section>

    <section>
        <table>
            <thead>
                <tr>
                    <th>Project</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </section>
</main>

<script>
    $('#search').on('keyup', function() {
        search();
    });

    function search() {
        var keyword = $('#search').val();
        $.ajax({
            type: "POST",
            url: '/Search',
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
            htmlView += '<tr> <td>No Results Found </td> </tr>'
        }

        for(i=0; i<res.projects.length; i++) {
            htmlView += '<tr><td><a href="/Project/' +res.projects[i].projectID+ '">' +res.projects[i].name+ '<i class="fa-solid fa-arrow-right"></i></a></td></tr>'
        }

        $('tbody').html(htmlView);
    }
</script>

@endsection