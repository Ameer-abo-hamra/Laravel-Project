<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/css.css', 'resources/js/test.js'])
    @routes
</head>

<body>
    <div class="all-medicines">

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
        @if (count($medicinesGroupedByCategory) == 0)
            <h3>
                there are no medicines until now
            </h3>
        @else
            <div class="items">

                @foreach ($medicinesGroupedByCategory as $key => $value)
                    <h2>{{ $key }} : </h2>
                    <div class="parent">
                        @foreach ($value as $arr)
                            <div class="medicine">
                                <h3> {{ $arr->t_name }}</h3>
                                <div class="det">
                                    <p>
                                        The scientific name is :
                                    </p>
                                    <span>{{ $arr->s_name }}</span>
                                </div>
                                <div class="det">
                                    <p>
                                        price :
                                    </p>
                                    <span> {{ $arr->price }}</span>
                                </div>
                                <div class="det">
                                    <p>
                                        amount :
                                    </p>
                                    <span>{{ $arr->amount }}</span>
                                </div>
                                <div class="det">
                                    <p>
                                        category :
                                    </p>
                                    <span>{{ $arr->category }}</span>
                                </div>
                                <div class="det">
                                    <p>
                                        company :
                                    </p>
                                    <span>{{ $arr->company }}</span>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <hr style="margin-top: 25px; width: 110%; left: -10%;position: relative;">
                @endforeach




            </div>
        @endif
    </div>

</body>

</html>
