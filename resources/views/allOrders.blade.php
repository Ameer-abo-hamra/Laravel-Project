<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{asset("./css/css.css")}}"> --}}
    @vite(['resources/js/test.js', 'resources/css/css.css'])
    @routes
</head>

<body>
    <div class="all-orders">
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
        <div class="orders">
            <table>
                <thead>
                    <th>
                        Order id
                    </th>
                    <th>
                        state
                    </th>
                    <th>
                        payed
                    </th>
                    <th>
                        price
                    </th>
                    <th>
                        Actions
                    </th>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                {{ $order->id }}
                            </td>
                            <td>
                                {{ $order->state }}
                            </td>
                            <td>
                                {{ $order->payed }}
                            </td>
                            <td>
                                {{ $order->price }}
                            </td>
                            <td>
                                <button class="btn update"> update</button>
                                <button class="btn details" onclick=""> details</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
