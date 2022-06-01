<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Available Seats</title>
  <link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel="stylesheet" type="text/css" href="new.css">
<style type="text/css">
		#myInput {
  		border-radius: 20px;
  		color: black;
  		font-size: 15px;
  		padding: 10px 5px 10px 15px;
  		margin-bottom: 10px;
	}
</style>
</head>
<body>
<body>
	<?php
		require "connect_database.php";
		if ($conn->connect_error) 
    {
      die("Connection failed: ".$conn->connect_error);
    }

		echo "
					<div class=\"container-sm\">
             <div class=\"table table-responsive\">
                <div class=\"table-wrapper\">
                  <div class=\"table-title\">
                    <div class=\"row\">
                      <div class=\"col-xs-6\">
                        <h2>Train Details</h2>
                    </div>
                  </div>
                </div>
                <table class=\"table table-striped table-hover text-center table-bordered\">
                  <thead>
										<th class=\"text-center\" style=\"width:25%\">Train Number</th>
										<th class=\"text-center\" style=\"width:37%\">Starting Point</th>
										<th class=\"text-center\" style=\"width:38%\">Destination Point</th>
									</thead>
									<tbody>
										<tr>
										<td class=\"text-center\">".$_GET["trainno"]."</td>
										<td class=\"text-center\">".$_GET["sp"]."</td>
										<td class=\"text-center\">".$_GET["dp"]."</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
		";

		echo "
					<div class=\"container-sm\">
             <div class=\"table table-responsive\">
                <div class=\"table-wrapper\">
                  <div class=\"table-title\">
                    <div class=\"row\">
                      <div class=\"col-xs-6\">
                        <h2>Available Seats</h2>
                    	</div>
                    	<div class=\"col-xs-6\">
												<input type=\"text\"  id=\"myInput\" style=\"width:60%;color: black;\" onkeyup=\"myFunction()\" placeholder=\"Search using journey date\">
											</div>
                  	</div>
                	</div>
                <table class=\"table table-striped table-hover text-center table-bordered\" id=\"myTable\">
                  <thead>
                  	<th class=\"text-center\" style=\"width:8%\">Sr. No.</th>
										<th class=\"text-center\" style=\"width:23%\">Journey Date</th>
										<th class=\"text-center\" style=\"width:23%\">Ticket Class </th>
										<th class=\"text-center\" style=\"width:23%\">Available Seats</th>
										<th class=\"text-center\" style=\"width:23%\">Fare (Single Seat)</th>
									</thead>
									<tbody>
		";

		$cdquery="SELECT classseats.journey_date,classseats.class_name,classseats.available_seats,classseats.ticket_fare1 FROM classseats WHERE classseats.train_number='".$_GET["trainno"]."' AND classseats.start_point='".$_GET["sp"]."' AND classseats.destination_point='".$_GET["dp"]."'";
		$cdresult=mysqli_query($conn,$cdquery);
		$x=1;
		while ($cdrow=mysqli_fetch_array($cdresult)) 
		{
				echo "
										<tr>
											<td class=\"text-center\">".$x."</td>
											<td class=\"text-center\">".$cdrow[0]."</td>
											<td class=\"text-center\">".$cdrow[1]."</td>
											<td class=\"text-center\">".$cdrow[2]."</td>
											<td class=\"text-center\">".$cdrow[3]."</td>
										</tr>
				";
				$x=$x+1;
		}
		echo "
									</tbody>
								</table>
							</div>
						</div>
					</div>
		";
	?>
	<div class="text-center">
				<?php
					echo"
        					<a href=\"http://localhost/railway/train_schedule.php?trainno=".$_GET["trainno"]."\" class=\" text-dark font-weight-bold\">
            					<button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
               					 <i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
            					</button>
        					</a>
        	";
        ?>
        <a href="http://localhost/railway/admin_login.html" class=" text-dark font-weight-bold">
            <button class="btn btn-danger text-dark p-2" style="margin-left: 20px;"> 
               <span style="margin-right:7px;">Logout</span><i class="fa fa-sign-out" aria-hidden="true"></i> 
            </button>
        </a>
  
    </div>
   <script>
		function myFunction()
		{
			var input, filter, table, tr, i, j, column_length, count_td;
		    column_length = document.getElementById('myTable').rows[0].cells.length;
        	input = document.getElementById("myInput");
        	filter = input.value.toUpperCase();
        	table = document.getElementById("myTable");
      		tr = table.getElementsByTagName("tr");
      		for (i = 1; i < tr.length; i++) 
      		{
        		count_td = 0;
        		for(j = 1; j < 2; j++)
        		{
            		td = tr[i].getElementsByTagName("td")[j];
            		if (td)
            		{
              			if ( td.innerHTML.toUpperCase().indexOf(filter) > -1) 
              			{            
                			count_td++;
              			}
            		}
        		}
		        if(count_td > 0)
		        {
        		    tr[i].style.display = "";
        		}
        		else
        		{
            		tr[i].style.display = "none";
        		}
      		}
    	}
	</script>
</body>
</html>