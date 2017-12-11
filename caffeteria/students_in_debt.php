<?php
    session_start();
    if(isset($_SESSION["e_id"])){
        session_abort();
        include("./includes/employee_header.inc.php");
    }
    else if(isset($_SESSION["a_id"])){
        session_abort();
        include("./includes/admin_header.inc.php");
    }
    else{
        require("../restaurant_config/helper.php");
        redirect_to("login.php");
    }
?>
<div class="small_dashboard_wrapper">
    <h3>Students in debt</h3>
    <table class="pure-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Debt</th>
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
        getStudentsInDebt();
    });
    function getStudentsInDebt(){
        jQuery.ajax({
            type:"get",
            url:"./ajax_php/get_students_in_debt.php",
            success: function(data){
                var meals = JSON.parse(data);
                var html = "";
                for(var i in meals){
                    html += "<tr>";
                    html += "<td>" + meals[i]["full_name"] + "</td>";
                    html += "<td>" + meals[i]["owns"] + " KM</td>";
                    html += "</tr>";
                }
                $("tbody").html(html);
            },
            complete: function(data){
                setTimeout(getStudentsInDebt, 2000);
            }
        });
    };
</script>
</body>
</html>