
let alertSuccess = document.getElementById('alert-success');
if (alertSuccess) {
    alertSuccess.classList.add("show-me");
    setTimeout(function() {
        alertSuccess.classList.remove("show-me");
    }, 2000);
};

$(document).ready(function() {
    $(document).on('click','.lesson-item',function (e) {
        let urlRequest = this.dataset.url;
        $.ajax({
            type: 'get',
            url: urlRequest, 
            success: function(result){
                if (!result.error) {
                    $("#ajax-lesson-detail").html(result);
                    let currentStudyUrl = document.querySelector(".current-study").dataset.url;
                    let idLesson = currentStudyUrl.slice(currentStudyUrl.lastIndexOf("/") + 1);
                    window.history.pushState({},"", idLesson);
                    showError();
                } else {
                    let errorHtml = `<div class="error-container"><span class="text-error">${result.error}</span></div>`;
                    $("#ajax-lesson-detail").append(errorHtml);
                    showError();
                }
            },
            error: function(result) {

            }
        });
    });

    function showError() {
        let errorContainer = document.querySelector(".error-container");
        if (errorContainer) {
            errorContainer.classList.add("show-error");
            setTimeout(function() {
                errorContainer.classList.remove("show-error");
            }, 2000);
        }
    }
});
