<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>search</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/css.css', 'resources/js/test.js', 'resources/css/media.css', 'resources/css/font/css/all.css']); ?>
    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
</head>

<body>
    <div class="search">
        <div class="nav">
            <div class="logo">
                <img src="<?php echo e(url('/images/favicon.png')); ?>" alt="" id="logo">
            </div>
            <div class="links">
                <i class="fa-solid fa-bars" id="icon"></i>
                <ul id="links">
                    <li><a href="<?php echo e(route('add.medicine')); ?>"> add medicine</a></li>
                    <li><a href="<?php echo e(route('all')); ?>"> all medicines</a></li>
                    <li><a href="<?php echo e(route('get.orders')); ?>"> get orders</a></li>
                    <li><a href="<?php echo e(route('logout')); ?>" id="logout"> logout</a></li>
                    <li><a href="<?php echo e(route('home.page')); ?>"> Home</a></li>
                </ul>
            </div>
            <div class="sreach">
                <form action="<?php echo e(route('search')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input class="unset_inputs" type="search" name="value" id=""
                        placeholder=" search category or name">
                </form>
            </div>
        </div>
        <?php if(count($med) == 0): ?>
            <h2
                style=" text-align: center;
            margin-top: 20px;
            background-color: var(--third);
            color: var(--first);
            padding: 10px;
            width: fit-content;
            margin: 40px auto;
            border-radius : 10px">
                there are no medicines matched with your search .. try another words</h2>
        <?php else: ?>
            <div class="items">
                <?php $__currentLoopData = $med; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="medicine">
                      <div class="top">
                        <h3> <?php echo e($m->t_name); ?></h3>
                        <div class="det">
                            <p>
                                The scientific name is :
                            </p>
                            <span><?php echo e($m->s_name); ?></span>
                        </div>
                        <div class="det">
                            <p>
                                price :
                            </p>
                            <span> <?php echo e($m->price); ?></span>
                        </div>
                        <div class="det">
                            <p>
                                amount :
                            </p>
                            <span><?php echo e($m->amount); ?></span>
                        </div>
                        <div class="det">
                            <p>
                                category :
                            </p>
                            <span><?php echo e($m->category); ?></span>
                        </div>
                        <div class="det">
                            <p>
                                company :
                            </p>
                            <span><?php echo e($m->company); ?></span>
                        </div>
                      </div>
                      <div class="bottom">
                        <ul>
                            <li><a href="" class="btn update">
                             update
                            </a></li>
                            <li><a href="<?php echo e(route("delete", $m->id)); ?>" class="btn delete">
                             delete
                            </a></li>

                        </ul>
                      </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
    </div>
</body>

</html>
<?php /**PATH D:\course laravel\testERD\resources\views/searchPage.blade.php ENDPATH**/ ?>