<?php
    include("./includes/employee_header.inc.php");

    if($_SESSION["first_login"]){
        display_msg("Success", "You've successfully logged in!", "success");
        $_SESSION["first_login"] = false;
    }
    display_notification();
?>
			<div class="small_dashboard_wrapper">
				<h3>Welcome</h3>
				<h1 id="employee_name"><?php echo "{$_SESSION["fname"]} {$_SESSION["lname"]}"; ?></h1>
				<div class="active_orders_p">
					<p class="active_orders_number">There are currently</p>
                    <a class="link" href="employee_active_orders.php">
                    <p id="number_of_active_orders">

                    </p>
                    <p class="active_orders_number underline">active orders.</p></a>
				</div>
			</div>
		</div>
	</div>

<script>
    jQuery(document).ready(function(){
        getNumOfOrders();
    });
    function getNumOfOrders(){
        jQuery.ajax({
            type:"get",
            url:"./ajax_php/get_num_orders.php",
            success: function(data){
                $("#number_of_active_orders").html(JSON.parse(data)["num_of_orders"]);
            },
            complete: function(data){
                setTimeout(getNumOfOrders, 2000);
            }
        });
    }
</script>
</body>
</html>