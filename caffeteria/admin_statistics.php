<?php
    include("./includes/admin_header.inc.php");
?>

<div class="small_dashboard_wrapper">
    <h3>Statistics for months(revenue)</h3>
    <canvas id="myChart" style="max-width:600px; margin:0 auto;"></canvas>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js">
</script>
<script>
    $(document).ready(function(){
        // draw chart
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Revenue (KM)',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1   )',
                        'rgba(153, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 255, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        // get data from database
        jQuery.ajax({
            type:"get",
            url:"./ajax_php/get_revenue_details.php",
            success: function(data){
                data = JSON.parse(data);
                for(var i = data.length - 1; i >= 0; i--){
                    myChart.data.labels.push(data[i]["monthyear"]);
                    myChart.data.datasets[0].data.push(data[i]["revenue"]);
                }
                myChart.update();
            }
        });
    });


</script>
</body>
</html>
