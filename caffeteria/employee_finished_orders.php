<?php
    include("./includes/employee_header.inc.php");
    display_notification();
?>
			<div class="small_dashboard_wrapper">
				<h3>Finished Orders</h3>
				<table class="pure-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Meal</th>
            <th>Price</th>
            <th>Student</th>
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
        getStudentOrders();
    });
    function getStudentOrders(){
        jQuery.ajax({
            type:"get",
            url:"./ajax_php/get_finished_orders.php",
            success: function(data){
                var orders = JSON.parse(data);
                console.log(orders);
                var html = "";
                for(var i in orders){
                    html += "<tr>";
                    html += "<td>" + orders[i]["date"] + "</td>";
                    html += "<td>" + orders[i]["name"] + "</td>";
                    html += "<td>" + orders[i]["price"] + "</td>";
                    html += "<td>" + orders[i]["full_name"] + "</td>";
                    if(orders[i]["paid"] == 0) {
                        html += "<td><a class='finished-link' href='paid_order.php?s_id=" + orders[i]["student"] +
                            "&o_id=" + orders[i]["o_id"] + "'>Paid!</a>" + "</th>";
                    }
                    else{
                        html += "<td>It's paid</td>"
                    }
                    html += "</tr>";
                }
                $("tbody").html(html);
            },
            complete: function(data){
                setTimeout(getStudentOrders, 2000);
            }
        });
    }
</script>
</body>
</html>