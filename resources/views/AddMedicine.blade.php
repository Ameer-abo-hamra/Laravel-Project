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
    <div class="add-medicine">
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
        <div class="form">
            <h2> add your new medicine</h2>
            @if (session('success'))
                <h3 id="success">{{ session('success') }} </h3>
            @endif
            <div class="alert-message">
                @if (Session('error'))
                    <p class="vaildation_error" id="not-valid"> {{ session('error') }} </p>
                @endif
            </div>
            <form action="{{ route('add.medicine') }}" method="POST">
                @csrf
                <div class="s_name">
                    @error('s_name')
                        <p class="vaildation_error"> {{ $message }} </p>
                    @enderror
                    <label for="s_name">s_name</label>
                    <input class="unset_inputs" type="text" id="s_name" name="s_name"
                        value="{{ old('username') }}">
                </div>
                <div class="t_name">
                    @error('t_name')
                        <p class="vaildation_error">{{ $message }}</p>
                    @enderror
                    <label for="t_name">t_name</label>
                    <input class="unset_inputs" type="text" name="t_name" id="t_name"
                        value="{{ old('password') }}">
                </div>
                <div class="category">
                    @error('category')
                        <p class="vaildation_error">{{ $message }}</p>
                    @enderror
                    <label for="category">category</label>
                    <input class="unset_inputs" type="text" name="category" id="category"
                        value="{{ old('password') }}">
                </div>
                <div class="company">
                    @error('company')
                        <p class="vaildation_error">{{ $message }}</p>
                    @enderror
                    <label for="company">company</label>
                    <input class="unset_inputs" type="text" name="company" id="company"
                        value="{{ old('password') }}">
                </div>
                <div class="amount">
                    @error('amount')
                        <p class="vaildation_error">{{ $message }}</p>
                    @enderror
                    <label for="amount">amount</label>
                    <input class="unset_inputs" type="number" name="amount" id="amount"
                        value="{{ old('password') }}">
                </div>
                <div class="end_date">
                    @error('end_date')
                        <p class="vaildation_error">{{ $message }}</p>
                    @enderror
                    <label for="end_date">end_date</label>
                    <input class="unset_inputs" type="date" name="end_date" id="end_date"
                        value="{{ old('password') }}">
                </div>
                <div class="price">
                    @error('price')
                        <p class="vaildation_error">{{ $message }}</p>
                    @enderror
                    <label for="price">price</label>
                    <input class="unset_inputs" type="number" name="price" id="price"
                        value="{{ old('password') }}">
                </div>
                <input type="submit" value="add" class="btn">
            </form>
        </div>
    </div>
</body>

</html>
