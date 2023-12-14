<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <p>اهلا </p>
    <form action="{{route("store")}}" method="POST">
@csrf
        <input type="text" name="s_name" placeholder="s_name"><br><br>
        @error("s_name")
            <p>{{$message }}</p>
        @enderror
        <input type="text" name="t_name" placeholder="t_name"><br><br>
        @error("t_name")
        <p>{{$message }}</p>
    @enderror
        <input type="text" name="category" placeholder="cat"><br><br>
        <input type="text" name="company" placeholder="company"><br><br>
        <input type="number" name="amount" placeholder="amount"><br><br>
        <input type="date" name="end_date" placeholder="end date"><br><br>
        <input type="number" name="price" placeholder="price"><br><br>
        <input type="submit">
    </form>
</body>

</html>
