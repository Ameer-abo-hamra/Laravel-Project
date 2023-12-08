<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<style>

</style>

<body>

    <form action= "{{ route('sub') }} " method="post" >
        @csrf
        <div class="b">
        <!-- حقل واحد لاسم الدواء وآخر للكمية لكل صف -->
        @foreach ($med as $me)
        <div class="a">
            <input type="checkbox" name="medicine_Ids[]" id="{{ $me->id }}" value="{{ $me->id }}">
            <label for="{{ $me->id }}">{{ $me->s_name }}</label><br><br>

            <input type="number" name="quan[]" placeholder="ادخل  الكمية " ><br><br>
        </div>
        @endforeach
    </div>
        <button type="submit">إرسال الطلبية</button>
    </form>
</body>

</html>
