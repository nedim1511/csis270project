<?php
    include("./includes/student_header.inc.php");

    if($_SESSION["first_login"]){
        display_msg("Success", "You've successfully logged in!", "success");
        $_SESSION["first_login"] = false;
    }
?>
			<div class="small_dashboard_wrapper">
				<h3>Welcome</h3>
				<h1 id="student_name"><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></h1>
				<div class="active_orders_p">
					<p class="active_orders_number">You have</p>
                    <a class="link" href="student_active_orders.php">
                        <p id="number_of_active_orders">

                        </p>
                        <p class="active_orders_number underline">active order(s).</p><br>
                        <p>You owe <span id="owns"></span> KM</p>
                    </a>
				</div>
			</div>
		</div>
	</div>
<script>
    $(document).ready(function(){
        getNumOfOrders();
    });
    function getNumOfOrders(){
        jQuery.ajax({
           type:"get",
           url:"./ajax_php/get_num_orders_student.php",
           success: function(data){
               data = JSON.parse(data);
               $("#number_of_active_orders").html(data["num_of_orders"]);
               $("#owns").html(data["owns"]);
           },
           complete: function(data){
               setTimeout(getNumOfOrders, 2000);
           }
        });
    }
</script>
</body>
</html>