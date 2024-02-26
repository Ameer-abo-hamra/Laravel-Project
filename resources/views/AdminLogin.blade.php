<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/css.css', 'resources/js/test.js', 'resources/css/media.css', 'resources/css/font/css/all.css'])

    <title>Document</title>
</head>

<body>

    <div class="admin-login">

        <div class="form">

            <h2> Welcome Admin </h2>
            <div class="alert-message">
                @if (Session('error'))
                    <p class="vaildation_error" id="not-valid"> {{ session('error') }} </p>
                @endif
                @if (Session('unauth'))
                    <p class="vaildation_error" id="not-valid"> {{ session('unauth') }} </p>
                @endif
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="username">
                    @error('username')
                        <p class="vaildation_error"> {{ $message }} </p>
                    @enderror
                    <label for="username">username</label>
                    <input class="unset_inputs" type="text" id="username" name="username"
                        value="{{ old('username') }}">
                </div>
                <div class="password">
                    @error('password')
                        <p class="vaildation_error">{{ $message }}</p>
                    @enderror
                    <label for="password">password</label>
                    <input class="unset_inputs" type="password" name="password" id="password"
                        value="{{ old('password') }}">
                </div>
                <input type="submit" value="login" class="btn">
            </form>
        </div>
    </div>

</body>

</html>
