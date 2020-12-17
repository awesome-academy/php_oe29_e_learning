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

$(document).ready(function() {
    const url = window.location.href;
    $.ajax({
        type: "GET",
        url: url + "/chart",
        cache: false,
        success: function(data) {
            let myLabels = Object.keys(data);
            let myData = Object.values(data)
            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: myLabels,
                    datasets: [{
                        label: 'Number of lessons',
                        data: myData,
                        backgroundColor: '#007575',
                        borderColor: '#007575',
                        borderWidth: 1,
                        fill: false,
                        lineTension: 0,
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }]
                    }
                }
            });
        }
    });
})
