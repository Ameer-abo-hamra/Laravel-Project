<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>search</title>
    @vite(['resources/css/css.css', 'resources/js/test.js'])
    @routes
</head>

<body>
    <div class="search">
        <div class="nav">
            <div class="logo">
                <img src="{{ url('/images/favicon.png') }}" alt="" id="logo">
            </div>
            <div class="links">
                <ul>
                    <li><a href="{{ route('add.medicine') }}"> add medicine</a></li>
                    <li><a href="{{ route('all') }}"> all medicines</a></li>
                    <li><a href="{{ route('get.orders') }}"> get orders</a></li>
                    <li><a href="{{ route('logout') }}"> logout</a></li>
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
        @if (count($med) == 0)
            <h2
                style="    text-align: center;
            margin-top: 20px;
            background-color: var(--third);
            color: var(--first);
            padding: 10px;
            width: fit-content;
            margin: 40px auto;
            border-radius : 10px">
                there are no medicines matched with your search .. try another words</h2>
        @else
            <div class="items">
                @foreach ($med as $m)
                    <div class="medicine">
                        <h3> {{ $m->t_name }}</h3>
                        <div class="det">
                            <p>
                                The scientific name is :
                            </p>
                            <span>{{ $m->s_name }}</span>
                        </div>
                        <div class="det">
                            <p>
                                price :
                            </p>
                            <span> {{ $m->price }}</span>
                        </div>
                        <div class="det">
                            <p>
                                amount :
                            </p>
                            <span>{{ $m->amount }}</span>
                        </div>
                        <div class="det">
                            <p>
                                category :
                            </p>
                            <span>{{ $m->category }}</span>
                        </div>
                        <div class="det">
                            <p>
                                company :
                            </p>
                            <span>{{ $m->company }}</span>
                        </div>

                    </div>
                @endforeach
        @endif
    </div>
    </div>
</body>

</html>
