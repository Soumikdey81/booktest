/**header js start */
document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggle = document.getElementById("dropdownMenuButton");
    const nestedDropdowns = document.querySelectorAll(".nested-dropdown");

    dropdownToggle.addEventListener("click", function (event) {
        // Remove show class from all submenu elements when parent menu is toggled
        document
            .querySelectorAll(".dropdown-submenu.show")
            .forEach((submenu) => submenu.classList.remove("show"));
    });

    nestedDropdowns.forEach((nestedDropdown) => {
        nestedDropdown.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();
            const submenu = this.nextElementSibling;
            submenu.classList.toggle("show");
        });
    });
});
/**header js end */

/**custom select option start */
// Toggle dropdown on click
document
    .querySelector(".select-selected")
    .addEventListener("click", function () {
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("select-hide");
    });

// Update selected option on click
document.querySelectorAll(".select-items div").forEach(function (option) {
    option.addEventListener("click", function () {
        document.querySelector(".select-selected").innerText = this.innerText;
        document.querySelector(".select-selected").classList.remove("active");
        this.parentElement.classList.add("select-hide");

        // Remove the selected class from any previously selected option
        document.querySelectorAll(".select-items div").forEach(function (opt) {
            opt.classList.remove("selected-option");
        });

        // Add the selected class to the clicked option
        this.classList.add("selected-option");
    });
});

// Close dropdown when clicking outside
document.addEventListener("click", function (event) {
    const select = document.querySelector(".custom-select");
    const selectItems = document.querySelector(".select-items");
    const selectSelected = document.querySelector(".select-selected");

    if (!select.contains(event.target)) {
        selectItems.classList.add("select-hide");
        selectSelected.classList.remove("active");
    }
});
/**custom select option end */

document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM fully loaded");
    const button = document.querySelector(".button");
    console.log("Button:", button);
    if (button) {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            console.log("Button clicked");
            button.classList.add("animate");
            setTimeout(() => {
                button.classList.remove("animate");
            }, 600);
        });
    } else {
        console.error("Button element not found");
    }
});
