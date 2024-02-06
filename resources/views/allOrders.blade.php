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
    <span></span>
    <div class="all-orders">
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
        @if (session('key'))
            <h2 id="isdone"> {{ session('key') }}</h2>
        @endif
        <div class="orders">
            <table>
                <thead>
                    <tr>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <form action="http://127.0.0.1:8000/changestate" method="POST">
                                @csrf
                                <td>
                                    {{ $order->id }}
                                </td>
                                <td>
                                    <select name="state" id="state">
                                        @if ($order->state == 'preparation')
                                            <option value="{{ $order->state }} " selected>{{ $order->state }}</option>
                                            <option value="not done">not done</option>
                                            <option value="done">done</option>
                                        @elseif ($order->state == 'done')
                                            <option value="{{ $order->state }} " selected>{{ $order->state }}</option>
                                            <option value="preparation">preparation</option>
                                            <option value="not done">not done</option>
                                        @else
                                            <option value="{{ $order->state }} " selected>{{ $order->state }}</option>
                                            <option value="preparation">preparation</option>
                                            <option value="done">done</option>
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select name="payed" id="payed">
                                        @if ($order->payed == 'payed')
                                            <option value="  {{ $order->payed }}" selected> {{ $order->payed }}
                                            </option>
                                            <option value="un-payed"> un-payed</option>
                                        @else
                                            <option value="  {{ $order->payed }}" selected> {{ $order->payed }}
                                            </option>
                                            <option value="payed"> payed</option>
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    {{ $order->price }}
                                </td>
                                <td>
                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                    <input class="btn" type="submit" value="submit">
                                </td>
                        </tr>
                        </form>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</body>



</html>
