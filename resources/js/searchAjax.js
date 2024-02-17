

let searchInput = document.getElementById("search");
let div = document.createElement("div");

searchInput.addEventListener(
    "click",
    function () {
        div.style.cssText = `
        min-height: 91vh;
        background-color: var(--first);
        position: absolute;
        z-index: 1;
        top: 57px;
        width: 100%;
            `;
        div.id = "for-search";
        document.body.prepend(div);
    },
    {
        once: true,
    }
);

let formSearch = document.getElementById("form-search");

formSearch.addEventListener("submit", (e) => {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "{{ route('search') }}",

        data: {
            value: searchInput.value,
            _token: "{{ csrf_token() }}",
        },
        success: function (data) {
            div.innerHTML = "";
            if (data["status"]) {
                div.classList.add("parent");
                console.log(data["medicines"]);
                for (med of data["medicines"]) {
                    let medElement = document.createElement("div");
                    medElement.classList.add("medicine");

                    medElement.innerHTML = `
                        <div class="top">
                        <h3> ${med.t_name}</h3>
                        <div class="det">
                            <p>
                                The scientific name is :
                            </p>
                            <span>${med.s_name}</span>
                        </div>
                        <div class="det">
                            <p>
                                price :
                            </p>
                            <span> ${med.price}</span>
                        </div>
                        <div class="det">
                            <p>
                                amount :
                            </p>
                            <span>${med.amount}</span>
                        </div>
                        <div class="det">
                            <p>
                                category :
                            </p>
                            <span>${med.category}</span>
                        </div>
                        <div class="det">
                            <p>
                                company :
                            </p>
                            <span>${med.company}</span>
                        </div>
                      </div>
                      <div class="bottom">
                        <ul>
                            <li><a href="" class="btn update">
                             update
                            </a></li>
                             <li><a href="{route("delete", med->id)}" class="btn delete">
                             delete
                            </a></li>

                        </ul>
                      </div>
                        `;
                    console.log(medElement);

                    div.prepend(medElement);
                }
            } else {
                div.classList.remove("parent");
                let el = document.createElement("h2");
                el.textContent =
                    "there are no medicines matched with your search .. try another words";
                el.style.cssText = `
                    text-align: center;
                    margin-top: 20px;
                    background-color: var(--third);
                    color: var(--first);
                    padding: 10px;
                    width: fit-content;
                    margin: 40px auto;
                    border-radius : 10px
                    `;
                div.prepend(el);
            }
        },
    });
});
