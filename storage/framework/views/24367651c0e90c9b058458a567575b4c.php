<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/css.css', 'resources/js/test.js', 'resources/css/media.css', 'resources/css/font/css/all.css']); ?>

    <title>Document</title>
</head>

<body>

    <div class="admin-login">

        <div class="form">

            <h2> Welcome Admin </h2>
            <div class="alert-message">
                <?php if(Session('error')): ?>
                    <p class="vaildation_error" id="not-valid"> <?php echo e(session('error')); ?> </p>
                <?php endif; ?>
                <?php if(Session('unauth')): ?>
                    <p class="vaildation_error" id="not-valid"> <?php echo e(session('unauth')); ?> </p>
                <?php endif; ?>
            </div>
            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="username">
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="vaildation_error"> <?php echo e($message); ?> </p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <label for="username">username</label>
                    <input class="unset_inputs" type="text" id="username" name="username"
                        value="<?php echo e(old('username')); ?>">
                </div>
                <div class="password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="vaildation_error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <label for="password">password</label>
                    <input class="unset_inputs" type="password" name="password" id="password"
                        value="<?php echo e(old('password')); ?>">
                </div>
                <input type="submit" value="login" class="btn">
            </form>
        </div>
    </div>

</body>

</html>
<?php /**PATH D:\course laravel\testERD\resources\views/AdminLogin.blade.php ENDPATH**/ ?>