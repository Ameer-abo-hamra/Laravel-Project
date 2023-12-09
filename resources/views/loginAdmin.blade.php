<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>

    <form action="{{route("llogin")}}" method="Post">
    @csrf

        <input type="text" placeholder="name" name="username">
        <input type="password" placeholder="password" name="password">
        <input type="submit">


        </form>
</body>

</html>
