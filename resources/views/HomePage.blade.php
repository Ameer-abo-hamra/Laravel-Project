<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/css.css', 'resources/js/test.js', 'resources/css/media.css', 'resources/css/font/css/all.css'])
    @routes
</head>

<body>
    <div id="for-search"
        style="
            min-height: 82vh;
            background-color: rgb(129, 221, 217);
            position: absolute;
            z-index: 1;
            top: -1000px;
            width: 94%;
            box-shadow: 0px 0px 12px 1px;
            left: 50%;
            transform: translateX(-50%);
            padding: 6px 10px 10px;
            transition: all 0.8s ease 0s;
            text-align: right;
        ">
        
    </div>
    <div class="home-page">

        <div class="nav">
            <div class="logo">
                <img src="{{ url('/images/favicon.png') }}" alt="" id="logo">
            </div>
            <div class="links">
                <i class="fa-solid fa-bars" id="icon"></i>
                <ul id="links">
                    <li><a href="{{ route('add.medicine') }}"> add medicine</a></li>
                    <li><a href="{{ route('all') }}"> all medicines</a></li>
                    <li><a href="{{ route('get.orders') }}"> get orders</a></li>
                    <li><a href="{{ route('logout') }}" id="logout"> logout</a></li>
                    <li><a href="{{ route('home.page') }}"> Home</a></li>
                </ul>
            </div>
            <div class="sreach">
                <form id="form-search" action="">
                    <input class="unset_inputs" type="search" name="value" id="search"
                        placeholder=" search category or name">
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    let searchInput = document.getElementById("search");;
    let div = document.getElementById("for-search");
    let formSearch = document.getElementById("form-search");

    function search(value) {
        $.ajax({
            type: "POST",
            url: "{{ route('search') }}",

            data: {
                value: value,
                _token: "{{ csrf_token() }}",

            },
            success: function(data) {
                div.innerHTML = "<i id=search-pop-up class=fa-solid fa-xmark  style=`color  : white`></i>";
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
                                The scientific name is :
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
                            <li><a href="" class="btn update">
                             update
                            </a></li>
                             <li><button id="delete${med.id}" onclick="Delete(${med.id})" class="btn delete">
                             delete
                            </button></li>

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
        div.style.top = "60px"


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

        div.style.top = "-1000px"
    })
</script>

</html>
