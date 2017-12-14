<?php
    include("./includes/student_header.inc.php");
?>

			<div class="small_dashboard_wrapper">
				<h3>Finished Orders</h3>
				<table class="pure-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Meal</th>
            <th>Price</th>
            <th>Paid?</th>
        </tr>
    </thead>

    <tbody>

    </tbody>
</table>
			</div>
		</div>
	</div>
    <script>
        $(document).ready(function(){
            getOrders();
        });
        function getOrders(){
            jQuery.ajax({
                type:"get",
                url:"./ajax_php/get_student_finished_orders.php",
                success: function(data){
                    var meals = data; //JSON.parse(data);
                    var html = "";
                    for(var i in meals){
                        html += "<tr>";
                        html += "<td>" + meals[i]["date"] + "</td>";
                        html += "<td>" + meals[i]["name"] + "</td>";
                        html += "<td>" + meals[i]["price"] + "</td>";
                        if(meals[i]["paid"] == 0){
                            html += "<td>No!</td>";
                        }
                        else{
                            html += "<td>Yes!</td>"
                        }
                        html += "</tr>";
                    }
                    $("tbody").html(html);
                },
                complete: function(data){
                    setTimeout(getOrders, 2000);
                }
            });
        };
    </script>
</body>
</html>