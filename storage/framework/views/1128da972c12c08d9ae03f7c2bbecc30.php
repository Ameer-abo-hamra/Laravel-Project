<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo e(route('test')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <input type="radio" id="windows" name="state" value="تم الارسال ">
        <label for="windows">تم الارسال </label><br>
        <input type="radio" id="payed" name="state" value="قيد التحضير">
        <label for="payed"> قيد التحضير </label><br>
        <input type="radio" name="state" id="len" value="مستلمة">
        <label for="len">مستلمة </label>
        <hr><hr>


        <input type="radio" name="payed" id="a" value="تم الدفع">

        <label for="a"> تم الدفع </label><br>
        <input type="radio" name="payed" id="b" value="غير مدفوع ">

        <label for="b"> غير مدفوع</label><br>
        <input type="submit">
    </form>
</body>

</html>
<?php /**PATH D:\course laravel\testERD\resources\views/pushToken.blade.php ENDPATH**/ ?>