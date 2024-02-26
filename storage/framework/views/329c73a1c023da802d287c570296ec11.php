<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/css.css', 'resources/js/test.js', 'resources/css/media.css', 'resources/css/font/css/all.css']); ?>
    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
</head>

<body>
    <div class="notifications" id="notifications">
        <i class="fa-solid fa-xmark close-notifications" id="close-notifications"></i>

        <ul id="ul-notifications">

        </ul>
    </div>
    <div class="parent-form" id="parent-form">
        <span class="alert-success" id="alert"></span>

        <div class="top">
            <i class="fa-solid fa-xmark" id="update-pop-up"></i>

            <h2> update medicine </h2>
        </div>
        <form>
            <div class="row">
                <label class="label-pop-up"> category </label>
                <input id="category" type="text" class="unset_inputs pop-up-update" name="category">
            </div>
            <div class="row">
                <label class="label-pop-up"> s_name </label>
                <input id="s_name" type="text" class="unset_inputs pop-up-update" name="s_name">
            </div>
            <div class="row">
                <label class="label-pop-up"> t_name </label>
                <input id="t_name" type="text" class="unset_inputs pop-up-update" name="t_name">
            </div>
            <div class="row">
                <label class="label-pop-up"> company </label>
                <input id="company" type="text" class="unset_inputs pop-up-update" name="company">
            </div>
            <div class="row">
                <label class="label-pop-up"> amount </label>
                <input id="amount" type="number" class="unset_inputs pop-up-update" name="amount">
            </div>
            <div class="row">
                <label class="label-pop-up"> end_date </label>
                <input id="end_date" type="date" class="unset_inputs pop-up-update" name="end_date">
            </div>
            <div class="row">
                <label class="label-pop-up"> price </label>
                <input id="price" type="number" class="unset_inputs pop-up-update" name="price">
            </div>
            <input type="submit" value="update" class="btn" id="pop-up-update">
        </form>
    </div>
    <div class="before" id="before">
        <i class="fa-solid fa-xmark" id="search-pop-up"></i>

        <div id="for-search" style="padding: 0">

        </div>
    </div>
    <div class="all-orders">
        <div class="nav">
            <div class="logo">
                <img src="<?php echo e(url('/images/favicon.png')); ?>" alt="" id="logo">
            </div>
            <div class="links">
                <i class="fa-solid fa-bars" id="icon"></i>
                <i class="fa-solid fa-bell" id="bell"></i>
                <ul id="links">
                    <li><a href="<?php echo e(route('add.medicine')); ?>"> add medicine</a></li>
                    <li><a href="<?php echo e(route('all')); ?>"> all medicines</a></li>
                    <li><a href="<?php echo e(route('get.orders')); ?>"> get orders</a></li>
                    <li><a href="<?php echo e(route('logout')); ?>" id="logout"> logout</a></li>
                    <li><a href="<?php echo e(route('home.page')); ?>"> Home</a></li>
                </ul>
            </div>
            <div class="sreach">
                <form id="form-search">
                    <input class="unset_inputs" type="search" name="value" id="search"
                        placeholder=" search category or name">
                </form>
            </div>
        </div>
        <?php if(session('key')): ?>
            <h2 id="isdone"> <?php echo e(session('key')); ?></h2>
        <?php endif; ?>
        <div class="orders">
            <table>
                <thead>
                    <tr>
                        <th>
                            Order id
                        </th>
                        <th>
                            state
                        </th>
                        <th>
                            payed
                        </th>
                        <th>
                            price
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td id="parentCheck">
                                <?php echo e($order->id); ?>

                                <i class="fa-solid fa-check" id="insideId<?php echo e($order->id); ?>"></i>
                            </td>

                            <td>
                                <select name="state" id="state<?php echo e($order->id); ?>">
                                    <?php if($order->state == 'preparation'): ?>
                                        <option value="<?php echo e($order->state); ?> " selected><?php echo e($order->state); ?></option>
                                        <option value="not done">not done</option>
                                        <option value="done">done</option>
                                    <?php elseif($order->state == 'done'): ?>
                                        <option value="<?php echo e($order->state); ?> " selected><?php echo e($order->state); ?></option>
                                        <option value="preparation">preparation</option>
                                        <option value="not done">not done</option>
                                    <?php else: ?>
                                        <option value="<?php echo e($order->state); ?> " selected><?php echo e($order->state); ?>

                                        </option>
                                        <option value="preparation">preparation</option>
                                        <option value="done">done</option>
                                    <?php endif; ?>
                                </select>
                            </td>
                            <td>
                                <select name="payed" id="payed<?php echo e($order->id); ?>">
                                    <?php if($order->payed == 'payed'): ?>
                                        <option value="<?php echo e($order->payed); ?>" selected> <?php echo e($order->payed); ?>

                                        </option>
                                        <option value="un-payed"> un-payed</option>
                                    <?php else: ?>
                                        <option value="<?php echo e($order->payed); ?>" selected> <?php echo e($order->payed); ?>

                                        </option>
                                        <option value="payed"> payed</option>
                                    <?php endif; ?>
                                </select>
                            </td>
                            <td>
                                <?php echo e($order->price); ?>

                            </td>
                            <td>
                                <button class="btn" value="update" onclick="update(<?php echo e($order->id); ?>)">
                                    update</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </div>
    </div>

</body>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    let searchInput = document.getElementById("search");;
    let div = document.getElementById("for-search");
    let before = document.getElementById("before");
    let formSearch = document.getElementById("form-search");
    let parent_form = document.getElementById("parent-form");
    let update_pop_up = document.getElementById("update-pop-up");
    let pop_up_update_button = document.getElementById("pop-up-update");
    let alert = document.getElementById("alert");
    let bell = document.getElementById("bell");
    let notifications = document.getElementById("notifications")
    let close_notifications = document.getElementById("close-notifications")
    let ul_notifications = document.getElementById("ul-notifications");

    let Array_notifications = [];
    if (JSON.parse(localStorage.getItem("notifications"))) {
        Array_notifications = JSON.parse(localStorage.getItem("notifications"));
    }
    fillNotifications();
    bell.addEventListener("click", () => {

        notifications.style.top = "60px";

    })
    close_notifications.addEventListener("click", () => {

        notifications.style.top = "-200%"
    })
    window.addEventListener("scroll", () => {
        parent_form.style.top = `calc(${window.scrollY}px + 50%)`;

    })


    function showPopUpUpdate(id) {
        let medicine_id = id;

        parent_form.style.left = "50%";
        parent_form.style.top = `calc(${window.scrollY}px + 50%)`;
        let url = `http://127.0.0.1:8000/one-medicine/${id}`
        $.ajax({

            type: "GET",
            url: url,
            success: function(data) {

                $('#category').val(data.medicine.category)
                $('#s_name').val(data.medicine.s_name)
                $('#t_name').val(data.medicine.t_name)
                $('#end_date').val(data.medicine.end_date)
                $('#price').val(data.medicine.price)
                $('#company').val(data.medicine.company)
                $('#amount').val(data.medicine.amount)
            }
        })
        pop_up_update_button.addEventListener("click", function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: `<?php echo e(route('update.medicine')); ?>`,
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    id: medicine_id,
                    s_name: $("#s_name").val(),
                    t_name: $("#t_name").val(),
                    category: $("#category").val(),
                    company: $("#company").val(),
                    amount: $("#amount").val(),
                    end_date: $("#end_date").val(),
                    price: $("#price").val(),

                },
                success: function(data) {

                    alert.style.padding = "5px 10px"
                    alert.style.width = "fit-content"
                    alert.textContent = ''
                    if (data.status) {
                        alert.textContent = data.message
                        alert.className = "";
                        alert.classList.add("alert-success")
                        setTimeout(() => {
                            alert.textContent = ''
                            alert.style.padding = "0"

                        }, 2000);
                        search(searchInput.value);
                    } else {
                        alert.className = "";
                        alert.textContent = data.message
                        alert.classList.add("alert-field")
                    }


                }
            })

        })

    }

    function search(value) {
        $.ajax({
            type: "POST",
            url: "<?php echo e(route('search')); ?>",

            data: {
                value: value,
                _token: "<?php echo e(csrf_token()); ?>",

            },
            success: function(data) {
                div.innerHTML = "";
                if (data["status"]) {
                    div.classList.add("parent")
                    for (med of data["medicines"]) {
                        let medElement = document.createElement("div");
                        medElement.classList.add("medicine");
                        medElement.innerHTML = `
                            <div class="top">
                            <h3> ${med.t_name }</h3>
                            <div class="det">
                                <p>
                                    scientific name :
                                </p>
                                <span>${ med.s_name }</span>
                            </div>
                            <div class="det">
                                <p>
                                    price :
                                </p>
                                <span> ${med.price }</span>
                            </div>
                            <div class="det">
                                <p>
                                    amount :
                                </p>
                                <span>${ med.amount }</span>
                            </div>
                            <div class="det">
                                <p>
                                    category :
                                </p>
                                <span>${ med.category }</span>
                            </div>
                            <div class="det">
                                <p>
                                    company :
                                </p>
                                <span>${med.company }</span>
                            </div>
                          </div>
                          <div class="bottom">
                            <ul>
                                <li><a id="update${med.id}" onclick="showPopUpUpdate(${med.id},event)" class="btn update">
                                 update
                                </a></li>
                                 <li><a id="delete${med.id}" onclick="Delete(${med.id})" class="btn delete">
                                 delete
                                </a></li>

                            </ul>
                          </div>
                            `


                        div.append(medElement);
                    }
                } else {
                    div.classList.remove("parent")
                    let el = document.createElement("h2");
                    el.textContent =
                        "there are no medicines matched with your search .. try another words"
                    el.style.cssText = `
                        text-align: center;
                        margin-top: 20px;
                        background-color: var(--third);
                        color: var(--first);
                        padding: 10px;
                        width: fit-content;
                        margin: 40px auto;
                        border-radius : 10px
                        `
                    div.append(el)
                }

            }
        });

    }

    searchInput.addEventListener("click", function() {
        before.style.top = "60px"


    })

    update_pop_up.addEventListener("click", function() {

        parent_form.style.left = "-2000px"
    })

    formSearch.addEventListener('submit', (e) => {
        e.preventDefault();


        search(searchInput.value);

    });

    function Delete(id) {
        let url = `delete-medicine/${id}`;
        $.ajax({

            type: "get",
            url: url,
            success: function() {
                search(searchInput.value);
            }

        })

    }


    let close_pop_up = document.getElementById("search-pop-up");

    close_pop_up.addEventListener("click", () => {

        before.style.top = `calc(-${before.offsetHeight}px - 90px)`
    })

    function fillNotifications() {
        ul_notifications.innerHTML = ""
        for (data of Array_notifications) {
            const date = new Date(data.created_at);
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const day = date.getDate();
            const formattedDate = year + "/" + month.toString().padStart(2, "0") + "/" + day.toString().padStart(2,
                "0");
            if (data.isread) {
                ul_notifications.innerHTML += `
                    <li id="li${data.id}" onclick="readed(${data.id})">
                        <p>you have a new order ... order id is ${data.id} </p>
                        <i class="fa-solid fa-angles-right"></i>
                        <i class="fa-solid fa-trash-can" onclick="deleteNotification(${data.id})"></i>
                        <span class="readed" id="span${data.id}"> unreaded</span>
                        <span>on ${formattedDate}</span>
                    </li>`;
            } else {
                ul_notifications.innerHTML += `
                    <li id="li${data.id}" onclick="readed(${data.id})">
                        <p>you have a new order ... order id is ${data.id} </p>
                        <i class="fa-solid fa-angles-right"></i>
                        <i class="fa-solid fa-trash-can" onclick="deleteNotification(${data.id})"></i>
                        <span class="unreaded" id="span${data.id}"> unreaded</span>
                        <span>on ${formattedDate}</span>
                    </li>`;

            }


        }

    }

    function readed(id) {

        let span = document.getElementById(`span${id}`)
        let el = Array_notifications.find((el) => {
            return el.id === id

        })
        el.isread = true
        localStorage.setItem("notifications", JSON.stringify(Array_notifications))
        fillNotifications()
        window.location = "http://127.0.0.1:8000/getorders"
    }

    function deleteNotification(id) {
        var targetElement = Array_notifications.find(function(element) {
            return element.id === id;
        });

        if (targetElement != -1) {

            Array_notifications.splice(Array_notifications.indexOf(targetElement), 1)
            localStorage.setItem("notifications", JSON.stringify(Array_notifications))

        }
        fillNotifications();
    }
    Pusher.logToConsole = true;

    var pusher = new Pusher('cdd96a1f621ff2c51e47', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('new-order');
    channel.bind('App\\Events\\addOrder', function(data) {
        data.order.isread = false;

        console.log(data.order)
        Array_notifications.unshift(data.order)



        fillNotifications();
        localStorage.setItem("notifications", JSON.stringify(Array_notifications))
    });
</script>
<script>
    function update(id) {
        console.log($(`#payed${id}`).val(), $(`#state${id}`).val())
        console.log(id)
        $.ajax({
            type: "POST",
            url: "<?php echo e(route('update.order')); ?>",
            dataType: "JSON",
            data: {
                payed: $(`#payed${id}`).val(),
                state: $(`#state${id}`).val(),
                _token: "<?php echo e(csrf_token()); ?>",
                id: id,
            },

            success: function(data) {
                // $(`#payed${id}`).find(`option[value='${data.order.payed}']`).prop("selected", true);
                // $(`#state${id}`).find(`option[value='${data.order.state}']`).prop("selected", true);
                console.log(data)
                document.getElementById(`insideId${id}`).style.zIndex = "1";
                console.log(document.getElementById(`insideId${id}`))
                setTimeout(() => {
                    document.getElementById(`insideId${id}`).style.zIndex = "-1";

                }, 2000)
            },


        })
    }
</script>

</html>
<?php /**PATH D:\course laravel\testERD\resources\views/allOrders.blade.php ENDPATH**/ ?>