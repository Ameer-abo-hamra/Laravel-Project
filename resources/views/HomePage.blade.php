<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/css.css', 'resources/js/test.js', 'resources/css/media.css', 'resources/css/font/css/all.css'])
    @routes
</head>

<body>
    <div class="home-page">

        <div class="nav">
            <div class="logo">
                <img src="{{ url('/images/favicon.png') }}" alt="" id="logo">
            </div>
            <div class="links">
                <i class="fa-solid fa-bars" id="icon"></i>
                <ul id="links">
                    <li><a href="{{ route('add.medicine') }}"> add medicine</a></li>
                    <li><a href="{{ route('all') }}"> all medicines</a></li>
                    <li><a href="{{ route('get.orders') }}"> get orders</a></li>
                    <li><a href="{{ route('logout') }}" id="logout"> logout</a></li>
                    <li><a href="{{ route('home.page') }}"> Home</a></li>
                </ul>
            </div>
            <div class="sreach">
                <form action="{{ route('search') }}" method="POST">
                    @csrf
                    <input class="unset_inputs" type="search" name="value" id=""
                        placeholder=" search category or name">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
