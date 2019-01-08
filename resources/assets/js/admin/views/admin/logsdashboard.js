$(document).ready(function () {

    console.log(chartData);

    new Chart(document.getElementById("stats-doughnut-chart"), {
        type: 'doughnut',
        data: JSON.parse(chartData),
        options: {
            legend: {
                position: 'bottom'
            }
        }
    });
});
