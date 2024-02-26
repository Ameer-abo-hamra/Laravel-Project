import route from "../../vendor/tightenco/ziggy";

let logo = document.getElementById("logo");
// let isdone = document.getElementById("isdone");
let icon = document.getElementById("icon");
let bar = document.getElementById("links");
logo.addEventListener("click", () => {
    window.location = route("home.page");
});
icon.addEventListener("click", () => {
    if (bar.style.display == "block") {
        bar.style.display = "none";
    } else {
        bar.style.cssText = `
        display : block;
        position: absolute;
        z-index : 1;
        right: 0px;
        text-align: left;
        padding: 5px 0px 0px;
        background-color: rgb(3 30 101);
        box-shadow: 0px 0px 7px 0px;
        right: 0;
        top: 20px ;
        transition : all 0.4s
`;
    }
});

bar.addEventListener("mouseleave", () => {
    if (window.innerWidth < 786) {
        bar.style.display = "none";
    }
});
window.addEventListener("resize", function () {
    if (this.window.innerWidth < 786) {
        bar.style.cssText = `
        position: absolute;
        display: none;
        right: 0px;
        text-align: left;
        padding: 5px 0px 0px;
        background-color: rgb(3 30 101);
        box-shadow: 0px 0px 7px 0px;
        right: 0;
        top: 20px
        `;
    } else {
        bar.style.cssText = `
        display: flex;
        align-items: center;
        justify-content: space-between;
        `;
    }
});
window.addEventListener("load", function () {
    if (this.window.innerWidth < 786) {
        console.log(this.window.innerWidth);
        bar.style.cssText = `
        position: absolute;
        display: none;
        right: 0px;
        text-align: left;
        padding: 5px 0px 0px;
        background-color: rgb(3 30 101);
        box-shadow: 0px 0px 7px 0px;
        right: 0;
        top: 20px
        `;
    } else {
        console.log(this.window.innerWidth);

        bar.style.cssText = `
        display: flex;
        align-items: center;
        justify-content: space-between;
        `;
    }
});
