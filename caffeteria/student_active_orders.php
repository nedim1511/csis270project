<?php
    include("./includes/student_header.inc.php");
    display_notification();
?>
			<div class="small_dashboard_wrapper">
				<h3>Active Orders</h3>
				<table class="pure-table">
    <thead>
        <tr>
            <th>Due Time</th>
            <th>Meal</th>
            <th>Special Notes</th>
            <th>Price</th>
            <th>Cancel Order</th>
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
            url:"./ajax_php/get_student_active_orders.php",
            success: function(data){
                var meals = JSON.parse(data);
                var html = "";
                for(var i in meals){
                    html += "<tr>";
                    html += "<td>" + meals[i]["time"] + "</td>";
                    html += "<td>" + meals[i]["name"] + "</td>";
                    html += "<td>" + meals[i]["comment"] + "</td>";
                    html += "<td>" + meals[i]["price"] + "</td>";
                    html += "<td><a class='delete-link' href='cancel_order.php?o_id=" + meals[i]["o_id"] +  "'>Cancel</a></td>";
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