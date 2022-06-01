<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Passenger Details</title>
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

		$cdquery="SELECT distinct pnr_number,passenger_name,passenger_age,passenger_gender,ticket_coach,seat_number,berth FROM passenger_details WHERE pnr_number='".$_GET["pnr_no"]."'";
		$cdresult=mysqli_query($conn,$cdquery);
		echo "
            <div class=\"container-sm\">
             <div class=\"table table-responsive\">
                <div class=\"table-wrapper\">
                  <div class=\"table-title\">
                    <div class=\"row\">
                      <div class=\"col-xs-6\">
                        <h2>Passenger Details</h2>
                    </div>
                  </div>
                </div>
                <table class=\"table table-striped table-hover text-center table-bordered\">
                  <thead>
                    <tr>
                    	<th style=\"width:7%;\"class=\"text-center\">Sr. No.</th>
                      <th style=\"width:10%;\" class=\"text-center\">PNR Number</th>
                      <th style=\"width:26%;\"class=\"text-center\">Passenger Name</th>
                      <th style=\"width:10%;\" class=\"text-center\">Passenger Age</th>
                      <th style=\"width:10%;\"class=\"text-center\">Passenger Gender</th>
                      <th style=\"width:10%;\"class=\"text-center\">Coach</th>
                      <th style=\"width:10%;\"class=\"text-center\">Seat Number</th>
                      <th style=\"width:17%;\"class=\"text-center\">Berth</th>
                    </tr>
                  </thead>
                  <tbody>
    ";
    $x=1;
    while ($cdrow=mysqli_fetch_array($cdresult)) 
		{
			echo "
											<tr>
											<td>".$x."</td>
                      <td>".$cdrow['pnr_number']."</td>
                      <td>".$cdrow['passenger_name']."</td>
                      <td>".$cdrow['passenger_age']."</td>
                      <td>".$cdrow['passenger_gender']."</td>
                      <td>".$cdrow['ticket_coach']."</td>
                      <td>".$cdrow['seat_number']."</td>
                      <td>".$cdrow['berth']."</td>
											</tr>
				";
				$x=$x+1;
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
        <a href="http://localhost/railway/tickets_booked.php" class=" text-dark font-weight-bold">
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
