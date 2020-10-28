$(document).ready(function() {

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function(event) {
                $("#img-preview").removeClass("d-none");
                $("#img-preview").attr("src", event.target.result);
            };
    
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    
    $("#input-img").change(function() {
        readURL(this);
    });
    
    let flag = false;

    $('.addRow').on('click', function() {
        flag = true;
        addRow();
    })

    

    function addRow() {
        let order = parseInt($('tbody tr:last-child td:first-child').text());
        if(isNaN(order)) {
            order = 1;
        } else {
            order += 1;
        };
        let course_id = $('.card-header div:last-child').text();
        let tr = `<tr>
        <td class="course-order" id="course-order-padding"><div>${order}</div><input type="text" class="d-none" value="${order}" name="course_order[]"></td>
        <td><input type="text" class="form-control" id="title" name="title[]"></td>
        <td><input type="text" class="form-control" id="description" name="description[]"></td>
        <td><input type="text" class="form-control" id="video_url" name="video_url[]"></td>
        <td><a class="btn remove"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-x-square" fill="#dc3545" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg><input type="text" class="d-none" id="course_id" name="course_id" value="${course_id}"></td>
        </tr>`;
        if(!$('#flag-btn').length){
            let trans = $('.trans-data').text();
            let btn = `<button type="submit" form="form-add-lessons" class="btn btn-success mb-3 ml-3" id="flag-btn">${trans}</button>`;
            $('.card-body').append(btn);
        }
        $('tbody').append(tr);
    }

    $('tbody').on('click', '.remove', function() {
        $(this).parent().parent().remove();
    })
})
