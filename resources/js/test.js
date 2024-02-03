import route from "../../vendor/tightenco/ziggy";

let logo = document.getElementById("logo");
let logout = document.getElementById("logout");
logo.addEventListener("click", () => {
    window.location = route("home.page");
});



