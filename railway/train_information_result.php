<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Schedule Train</title>
  <link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel="stylesheet" type="text/css" href="new.css">
</head>

<body class="bg-success">
	
	<?php
		session_start();

		require "connect_database.php";
		if ($conn->connect_error) 
        {
            die("Connection failed: ".$conn->connect_error);
         }
		if(isset($_POST["tno"]))
		{
			$trainno=$_POST["tno"];
			$_SESSION["trainno"] = "$trainno";

			$cdquery="SELECT * FROM train_details where train_number='".$trainno."'";
			$cdresult=mysqli_query($conn,$cdquery);			
			$cdrow=mysqli_fetch_array($cdresult);

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
										<tr>
											<th class=\"text-center\">Train Number </th>
											<th class=\"text-center\">Train Name </th>
											<th class=\"text-center\"> Starting Point </th>
											<th class=\"text-center\"> Starting Time </th>
											<th class=\"text-center\"> Destination Point </th>
											<th class=\"text-center\"> Destination Time</th>
											<th class=\"text-center\"> Arrival Day </th>
											<th class=\"text-center\"> Distance </th>
										</tr>
									</thead>
									<tbody class=\"text-center\">
										<tr>
											<td>".$cdrow[0]."</td>
											<td>".$cdrow[1]."</td>
											<td>".$cdrow[2]."</td>
											<td>".$cdrow[3]."</td>
											<td>".$cdrow[4]."</td>
											<td>".$cdrow[5]."</td>
											<td>".$cdrow[6]."</td>
											<td>".$cdrow[7]."</td>
										</tr>
									</tbody>
								</table>
							</div>
						<div>
					</div>
			";
			
			$cdquery1="SELECT * FROM train_schedule where train_number='".$trainno."' ORDER BY distance ASC  ";
			$cdresult1=mysqli_query($conn,$cdquery1);
			$i=1;
			echo "

					

					<div class=\"container-sm\">
						<div class=\"table table-responsive\">
							<div class=\"table-wrapper\">
								<div class=\"table-title\" style=\"width:100%;\">
									<div class=\"row\">
										<div class=\"col-xs-6\">
											<h2>Station Details</h2>
										</div>
									</div>
								</div>
								<table class=\"table table-striped table-hover text-center table-bordered\">
									<thead>
										<th style=\"text-align:center;\">Sr.No.</th>
										<th style=\"text-align:center;\">Staion Name</th>
										<th style=\"text-align:center;\">Arrival Time</th>
										<th style=\"text-align:center;\">Departure Time</th>
										<th style=\"text-align:center;\">Distance</th>
									</thead>
									<tbody>
			";
			while ($row=mysqli_fetch_array($cdresult1))
			{
				echo "					<tr>
											<td>".$i."</td>
											<td>".$row[2]."</td>
											<td>".$row[3]."</td>
											<td>".$row[4]."</td>
											<td>".$row[5]."</td>
										</tr>
				";
				$i=$i+1;
			}
				
			echo "
									<tbody>
								</table>
							</div>
						</div>
					</div>
					<div class=\"text-center\">
							<a href=\"http://localhost/railway/train_information.php\" class=\" text-dark\">
									<button class=\"btn btn-primary\"style=\"margin-right:3%\">
               			<i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
               		</button>
       				</a>
        
            	<a href=\"http://localhost/railway/index.html\" class=\" text-dark\">
									<button class=\"btn btn-primary\"style=\"margin-left:3%\">
               			<i class=\"fa fa-home\" aria-hidden=\"true\"></i> Home Page
               		</button>
       				</a>
        	</div>
				";
		}

	?>
</body>
</html>


