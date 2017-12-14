<?php
    include("./includes/employee_header.inc.php");
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
            <th>Purchaser</th>
            <th>Done?</th>
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
           url:"./ajax_php/get_student_orders.php",
           success: function(data){
               var orders = data; //JSON.parse(data);
               var html = "";
               for(var i in orders){
                   html += "<tr>";
                   html += "<td>" + orders[i]["time"] + "</td>";
                   html += "<td>" + orders[i]["name"] + "</td>";
                   html += "<td>" + orders[i]["comment"] + "</td>";
                   html += "<td>" + orders[i]["price"] + "</td>";
                   html += "<td>" + orders[i]["full_name"] + "</td>";
                   html += "<td><a class='finished-link' href=\order_done.php?o_id="  + orders[i]["o_id"] + ">Finished</a></td>";
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