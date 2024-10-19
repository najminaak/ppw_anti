<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'About')</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    @include('header') <!-- Menyertakan file header -->

    <nav class="topnav">
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/about2">About</a></li>
            <li><a href="/about">Contact</a></li>
        </ul>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    @include('footer') <!-- Menyertakan file footer -->

    <script src="js/script.js"></script>
</body>
</html>
