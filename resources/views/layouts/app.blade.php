<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/deleteForm.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/7d0f299f51.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
</head>

<script type="text/javascript">
    $(function() {
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            $('#load a').css('color', '#dfecf6');
            
            var url = $(this).attr('href');
            getProjects(url);
            window.history.pushState("", "", url);
        });

        function getProjects(url) {
            $.ajax({
                url : url 
            }).done(function (data) {
                $('.articles').html(data);
            }).fail(function () {
                alert('Projects could not be loaded');
            });
        }
    });
</script>

<body>
    @yield('content')
</body>
</html>