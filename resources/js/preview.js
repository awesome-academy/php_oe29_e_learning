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
