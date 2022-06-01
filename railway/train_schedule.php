<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ticket Booking</title>
  <link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel="stylesheet" type="text/css" href="new.css">
</head>
<body>


	<?php
		require "connect_database.php";
		if ($conn->connect_error) 
    {
        die("Connection failed: ".$conn->connect_error);
    }

		$cdquery="SELECT * FROM train_details WHERE train_number='".$_GET["trainno"]."'";
		$cdresult=mysqli_query($conn,$cdquery);
		echo "
            <div class=\"container-sm\">
             <div class=\"table table-responsive\">
                <div class=\"table-wrapper\">
                  <div class=\"table-title\">
                    <div class=\"row\">
                      <div class=\"col-xs-6\">
                        <h2>Train Information</h2>
                    </div>
                  </div>
                </div>
                <table class=\"table table-striped table-hover text-center table-bordered\">
                  <thead>
                    <tr>
                      <th class=\"text-center\">Train Number</th>
	              			<th class=\"text-center\">Train Name</th>
  	            			<th class=\"text-center\">Start Point</th>
    	          			<th class=\"text-center\">Arrival Time</th>
      	        			<th class=\"text-center\">Destination Point</th>
        	      			<th class=\"text-center\">Destination Time</th>
          	    			<th class=\"text-center\">Day</th>
            	  			<th class=\"text-center\">Distance</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<tr>
    ";
    while ($cdrow=mysqli_fetch_array($cdresult)) 
		{
			echo "
											<td>".$cdrow['train_number']."</td>
											<td>".$cdrow['train_name']."</td>
											<td>".$cdrow['start_point']."</td>
											<td>".$cdrow['arrival_time']."</td>
											<td>".$cdrow['destination_point']."</td>
											<td>".$cdrow['destination_time']."</td>
											<td>".$cdrow['arrival_day']."</td>
											<td>".$cdrow['distance']."</td>
				";
			}
            		
    echo"
      							</tr>
                  </tbody>
                </table>
              </div>
             </div>        
            </div>
    ";

		$cdquery="SELECT * FROM train_schedule where train_number='".$_GET["trainno"]."' ORDER BY distance ASC  ";
		$cdresult=mysqli_query($conn,$cdquery);
		$stations=array();
		$arrival=array();
		$departure=array();
		$distance=array();
		$count=0;
		while($cdrow=mysqli_fetch_array($cdresult))
		{
			$stations[$count]=$cdrow["station_name"];
			$arrival[$count]=$cdrow["arrival_time"];
			$departure[$count]=$cdrow["departure_time"];
			$distance[$count]=$cdrow["distance"];
			$count+=1;
		}
		echo "
            <div class=\"container-sm\">
             <div class=\"table table-responsive\">
                <div class=\"table-wrapper\">
                  <div class=\"table-title\">
                    <div class=\"row\">
                      <div class=\"col-xs-6\">
                        <h2>Intermediate Station Information</h2>
                    </div>
                  </div>
                </div>
                <table class=\"table table-striped table-hover text-center table-bordered\">
                  <thead>
                    <tr>
                      <th class=\"text-center\">Sr. No.</th>
	              			<th class=\"text-center\">Starting Point</th>
  	            			<th class=\"text-center\">Departure Time</th>
    	          			<th class=\"text-center\">Destination Point</th>
      	        			<th class=\"text-center\">Arrival Time</th>
        	      			<th class=\"text-center\">Distance</th>
          	    			<th class=\"text-center\"></th>
                    </tr>
                  </thead>
                  <tbody>
    ";
		$i=0;
		$x=0;
		while ($i<$count-1) 
		{
			$j=$i+1;
			while($j<$count)
			{
				echo "
										<tr>	
											<td>".($x+1)."</td>
											<td>".$stations[$i]."</td>
											<td>".$departure[$i]."</td>
											<td>".$stations[$j]."</td>
											<td>".$arrival[$j]."</td>
											<td>".($distance[$j]-$distance[$i])."</td>
											<td>
												<a href=\"http://localhost/railway/available_seats.php?trainno=".$_GET["trainno"]."&sp=".$stations[$i]."&dp=".$stations[$j]."\">
													<button class=\"btn btn-sm btn-info\">Available Seats</button>
												</a>
											</td>
										</tr>
				";
				$j+=1;
				$x+=1;
			}
			$i+=1;
		}
		echo"
                  </tbody>
                </table>
              </div>
             </div>        
            </div>
    ";
	?>
	    <div class="text-center">
        <a href="http://localhost/railway/train_details.php" class=" text-dark font-weight-bold">
            <button class="btn btn-primary text-dark p-2" style="margin-right: 20px;"> 
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </button>
        </a>
        
        <a href="http://localhost/railway/admin_login.html" class=" text-dark font-weight-bold">
            <button class="btn btn-danger text-dark p-2" style="margin-left: 20px;"> 
               <span style="margin-right:7px;">Logout</span><i class="fa fa-sign-out" aria-hidden="true"></i> 
            </button>
        </a>
    </div>
</body>
</html>
