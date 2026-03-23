function toggleMenuIcon(button) {
    const icon = button.querySelector("i");

    if (icon.classList.contains("bi-list")) {
        icon.classList.remove("bi-list");
        icon.classList.add("bi-x");
    } else {
        icon.classList.remove("bi-x");
        icon.classList.add("bi-list");
    }
}

document.addEventListener("DOMContentLoaded", function () {

    const button = document.querySelector(".navbar-toggler");

    if (button) {
        button.addEventListener("click", function () {
            toggleMenuIcon(this);
        });
    }

});

// Page not automatically scrolling down and hide if the mobile navbar menu clicked
document.addEventListener("DOMContentLoaded", function () {
    const navbarCollapse = document.getElementById("navbarNav");

    if (navbarCollapse) {
        navbarCollapse.addEventListener("show.bs.collapse", function () {
            document.body.style.overflow = "hidden";
        });

        navbarCollapse.addEventListener("hide.bs.collapse", function () {
            document.body.style.overflow = "auto";
        });
    }
});