window.addEventListener("load", function () {
    const dropdownItems = document.querySelectorAll(
        "#lightdropdown .dropdown-item"
    );
    const dropdownSelect = document.querySelector(
        "#lightdropdown .dropdown-select"
    );
    const dropdownSelectText = document.querySelector(
        "#lightdropdown .dropdown-selected"
    );
    const dropdownList = document.querySelector(
        "#lightdropdown .dropdown-list"
    );
    const dropdownCaret = document.querySelector(
        "#lightdropdown .dropdown-caret"
    );

    dropdownSelect.addEventListener("click", function () {
        dropdownList.classList.toggle("show");
        dropdownCaret.classList.toggle("fa-angle-up");
    });

    function handleSelectDropdown(e) {
        const { value } = e.target.dataset;
        dropdownSelectText.textContent = value;
        dropdownSelectText.dataset.id = e.target.dataset.id;
        dropdownList.classList.remove("show");
        dropdownCaret.classList.remove("fa-angle-up");
        console.log(dropdownSelectText.dataset.id);
        console.log(dropdownSelectText.dataset.url);
        console.log(dropdownSelectText.dataset.url.lastIndexOf("/"));
        let subUrl = dropdownSelectText.dataset.url.slice(0, dropdownSelectText.dataset.url.lastIndexOf("/") + 1);
        let urlRequest = subUrl + dropdownSelectText.dataset.id;
        console.log(urlRequest);
        $.ajax({
            type: 'get',
            url: urlRequest, 
            success: function(result){
                $("#ajax-container").html(result);
            },
            error: function(result) {

            }
        });
    }

    dropdownItems.forEach((el) =>
        el.addEventListener("click", handleSelectDropdown)
    );

    for(let element of dropdownItems) {
        console.log(element.dataset.id);
    }

});
