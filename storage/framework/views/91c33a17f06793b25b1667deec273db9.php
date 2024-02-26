<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>

    <form action="<?php echo e(route("rrr")); ?>" method="Post">
    <?php echo csrf_field(); ?>

        <input type="text" placeholder="phone" name="phone">
        <input type="password" placeholder="password" name="password">
        <input type="submit">


        </form>
</body>

</html>
<?php /**PATH D:\course laravel\testERD\resources\views/regAdmin.blade.php ENDPATH**/ ?>