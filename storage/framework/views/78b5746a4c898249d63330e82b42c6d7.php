<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/test.js'); ?>
</head>

<body>
    <form action="<?php echo e(route('login')); ?>" method="Post">
        <?php echo csrf_field(); ?>
        <input type="text" placeholder="name" name="username"><br><br>
        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div> <?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <input type="password" placeholder="password" name="password">

        <input type="submit">
    </form>
</body>

</html>
<?php /**PATH D:\course laravel\testERD\resources\views/loginAdmin.blade.php ENDPATH**/ ?>