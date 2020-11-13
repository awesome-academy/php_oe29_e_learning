
let alertSuccess = document.getElementById('alert-success');
if (alertSuccess) {
    alertSuccess.classList.add("show-me");
    setTimeout(function() {
        alertSuccess.classList.remove("show-me");
    }, 2000);
}
