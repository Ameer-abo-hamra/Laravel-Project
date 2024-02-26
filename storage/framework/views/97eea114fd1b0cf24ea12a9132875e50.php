<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <title>Document</title>
</head>
<style>

</style>

<body>

    <form action= "<?php echo e(route('sub')); ?> " method="post" >
        <?php echo csrf_field(); ?>
        <div class="b">
        <!-- حقل واحد لاسم الدواء وآخر للكمية لكل صف -->
        <?php $__currentLoopData = $med; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $me): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="a">
            <input type="checkbox" name="medicine_Ids[]" id="<?php echo e($me->id); ?>" value="<?php echo e($me->id); ?>">
            <label for="<?php echo e($me->id); ?>"><?php echo e($me->s_name); ?></label><br><br>

            <input type="number" name="quan[]" placeholder="ادخل  الكمية " ><br><br>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
        <button type="submit">إرسال الطلبية</button>
    </form>
</body>

</html>
<?php /**PATH D:\course laravel\testERD\resources\views/order.blade.php ENDPATH**/ ?>