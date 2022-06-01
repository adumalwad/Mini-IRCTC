<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ADD NEW TRAIN</title>
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
            die("Connection failed: " . $conn->connect_error);
        }

		if(isset($_POST["ns"]))
		{
			$num_station=$_POST["ns"];
			$train_name=$_POST["tname"];
			$_SESSION["tname"] = "$train_name";
			$start_point=$_POST["sp"];
			$_SESSION["sp"] = "$start_point";
			$start_time=$_POST["st"];
			$_SESSION["st"] = "$start_time";
			$destination_point=$_POST["dp"];
			$_SESSION["dp"] = "$destination_point";
			$destination_time=$_POST["dt"];
			$_SESSION["dt"] = "$destination_time";
			$dd=$_POST["dd"];
			$_SESSION["dd"] = "$dd";
			$_SESSION["ns"] = "".$_POST["ns"]."";
			$ds=$_POST["ds"];
			$_SESSION["ds"] = "$ds";
			if($_SESSION["sp"] == $_SESSION["dp"])
			{
				 echo "
 			            <div class=\"alert alert-sm alert-danger alert-dismissible\">
			                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
    	    		        </button>
        	        		<strong>Starting Point And Destination Point can not be same</strong> <i class=\"fa fa-frown-o\"></i>.
              			</div>
              			<div class=\"text-center\">
					        <a href=\"http://localhost/railway/add_train.php\" class=\" text-dark font-weight-bold\">
					            <button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
                					<i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
            					</button>
        					</a>
        
        					<a href=\"http://localhost/railway/admin_login.html\" class=\" text-dark font-weight-bold\">
            					<button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
               						<span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
            					</button>
        					</a>
    					</div>
              	";
              	die();

			}
			if( ($_SESSION["st"] >= $_SESSION["dt"]) && ($_SESSION["dd"]=="Day 1") )
			{
				echo "
 			            <div class=\"alert alert-sm alert-danger alert-dismissible\">
			                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
    	    		        </button>
        	        		<strong>Starting time can not be greater than or equal to destination time</strong> <i class=\"fa fa-frown-o\"></i>.
              			</div>
              			<div class=\"text-center\">
					        <a href=\"http://localhost/railway/add_train.php\" class=\" text-dark font-weight-bold\">
					            <button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
                					<i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
            					</button>
        					</a>
        
        					<a href=\"http://localhost/railway/admin_login.html\" class=\" text-dark font-weight-bold\">
            					<button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
               						<span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
            					</button>
        					</a>
    					</div>
              	";
              	die();
   		
			}
			if($ds==0)
			{
				echo "
 			            <div class=\"alert alert-sm alert-danger alert-dismissible\">
			                <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
    	    		        </button>
        	        		<strong>Distance can not be zero</strong> <i class=\"fa fa-frown-o\"></i>.
              			</div>
              			<div class=\"text-center\">
					        <a href=\"http://localhost/railway/add_train.php\" class=\" text-dark font-weight-bold\">
					            <button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
                					<i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
            					</button>
        					</a>
        
        					<a href=\"http://localhost/railway/admin_login.html\" class=\" text-dark font-weight-bold\">
            					<button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
               						<span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
            					</button>
        					</a>
    					</div>
              	";
              	die();
			}
			else
			{
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
												<th class=\"text-center\">Train Name </th>
												<th class=\"text-center\"> Starting Point </th>
												<th class=\"text-center\"> Starting Time </th>
												<th class=\"text-center\"> Destination Point </th>
												<th class=\"text-center\"> Destination Time</th>
												<th class=\"text-center\"> Arrival Day </th>
												<th class=\"text-center\">Intermediate Station</th>
												<th class=\"text-center\"> Distance </th>
											</tr>
										</thead>
										<tbody class=\"text-center\">
											<tr>
												<td>".$train_name."</td>
												<td>".$start_point."</td>
												<td>".$start_time."</td>
												<td>".$destination_point."</td>
												<td>".$destination_time."</td>
												<td>".$dd."</td>
												<td>".$num_station."</td>
												<td>".$ds."</td>
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
												<h2>Intermediate Station Information</h2>
											</div>
										</div>
									</div>
									<table class=\"table table-striped table-hover text-center table-bordered\">
										<thead>
											<tr>
												<th class=\"text-center\" style=\"width:25%;\">Station Name </th>
												<th class=\"text-center\" style=\"width:25%;\"> Arrival Time </th>
												<th class=\"text-center\" style=\"width:25%;\"> Departure Time </th>
												<th class=\"text-center\" style=\"width:25%;\"> Distance</th>
											</tr>
										</thead>
										<tbody class=\"text-center\">
											<tr>
												<td>".$start_point."</td>
												<td>".(date('H:i', strtotime($start_time. ' +0 minutes')))."</td>
												<td>".(date('H:i', strtotime($start_time. ' +10 minutes')))."</td>
												<td>0</td>
											</tr>
											<form action=\"add_train_result.php\" method=\"post\">
				";

				$i=1;
				while ($i<=$num_station) 
				{
 					echo "
	 										<tr>
 												<td>
 													<select class=\"text-center\" id=\"stn".$i."\" name=\"stn".$i."\" style=\"height:80%;width:70%;\" required> 
 					";

					$cdquery="SELECT station_name FROM station_details";
					$cdresult=mysqli_query($conn,$cdquery);

					echo "
														<option value = \"select station\" selected disabled>--Select Station-- </option>
					";

					while ($cdrow=mysqli_fetch_array($cdresult)) 
					{
						$cdTitle=$cdrow['station_name'];
						echo "
														<option value = \"$cdTitle\" > $cdTitle </option>
						";
					}

					echo "
													</select>
												</td>
												<td><input type=\"time\" class=\"text-center\" style=\"width:50%\" name=\"st".$i."\" required></td>
												<td><input type=\"time\" class=\"text-center\" style=\"width:50%\" name=\"dt".$i."\" required></td>
												<td><input type=\"text\" class=\"text-center\" style=\"width:50%\" name=\"ds".$i."\" onkeypress=\"return onlyNumberKey(event)\" required></td>	
											</tr>
					";
 					$i+=1;
				}

				echo " 
											<tr>
												<td>".$destination_point."</td>
												<td>".$destination_time."</td>
												<td>".$destination_time."</td>
												<td>".$ds."</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class\" text-center\" style=\"text-align:center; margin-bottom:30px; margin-top:-20px;\">
							<input class=\"btn btn-warning\" style=\"margin-right:5%;\"type=\"submit\" name=\"submit\" value=\"ADD TRAIN\">
							<input class=\" btn btn-warning\" style=\"margin-left:5%;\" type=\"reset\" value=\"RESET\">
						</div>
					</form>
					<div class=\"text-center\">
					    <a href=\"http://localhost/railway/add_train.php\" class=\" text-dark font-weight-bold\">
					        <button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
              					<i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
            				</button>
        				</a>
        
       					<a href=\"http://localhost/railway/admin_login.html\" class=\" text-dark font-weight-bold\">
           					<button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
           						<span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
           					</button>
        				</a>
    				</div>
				";	
			}
		}

		else
		{
			echo"
					            <nav class=\"navbar navbar-inverse\">
					            	<div class=\"container-fluid\">
					                	<div class=\"navbar-header\">
					                 		 <a class=\"navbar-brand\" href=\"#\">Mini IRCTC</a>
					                	</div>
					                	<ul class=\"nav navbar-nav\">
					                  		<li class=\"nav-item\">
					                    		<a class=\"nav-link\" href=\"http://localhost/railway/admin_menu.php?username=".$_SESSION["username"]."&password=".$_SESSION["password1"]."\"><i class=\"fa fa-home\"></i></a>
					                  		</li>
							                <li class=\"nav-item\">
							                	<a class=\"nav-link\" href=\"http://localhost/railway/users_details.php\"><b>User Details</b>
												</a>
					                  		</li>
							                <li class=\"nav-item\">
						                    	<a class=\"nav-link\" href=\"http://localhost/railway/train_details.php\"><b>Train Details</b>
						                    	</a>
					                  		</li>
					                  		<li class=\"nav-item\">
					                    		<a class=\"nav-link\" href=\"http://localhost/railway/station_details.php\"><b>Stations Details</b></a>
					                  		</li>
					                  		<li class=\"nav-item\">
					                    		<a class=\"nav-link\" href=\"http://localhost/railway/schedule_train.php\"><b>Schedule Train</b></a>
					                  		</li>
					                  		<li class=\"nav-item active\">
					                    		<a class=\"nav-link\" href=\"#\"><b>Add Train</b></a>
					                  		</li>
					                  		<li class=\"nav-item\">
					                    		<a class=\"nav-link\" href=\"http://localhost/railway/tickets_booked.php\"><b>Booked Tickets</b></a>
					                  		</li>
					                  		<li class=\"nav-item\">
					                    		<a class=\"nav-link\" href=\"http://localhost/railway/tickets_cancelled.php\"><b>Cancelled Tickets</b></a>
					                  		</li>
                						</ul>
					                	<ul class=\"nav navbar-nav navbar-right\" style=\"background-color: red; color: white;\">
                  							<li>
                    							<a href=\"http://localhost/railway/admin_login.html\" style=\"color:white;\"><span class=\"glyphicon glyphicon-log-in\"> </span><b> Logout</b> </a>
                  							</li>
                						</ul>
              						</div>
            					</nav>
      		";

			echo"
				
				<div class=\"login-form\">
    				<form action=\"http://localhost/railway/add_train.php\" method=\"post\">
    					<div class=\"avatar\">
    						<i class=\"fa fa-train\"></i>
    					</div>
        				<h2 class=\"text-center\">ADD NEW TRAIN</h2> 

        				<div class=\"form-group\">
          					<div class=\"input-group\">
               					<span class=\"input-group-addon\"><i class=\"fa fa-train\"></i></span>
               					<input type=\"text\" class=\"form-control\" name=\"tname\" placeholder=\"Enter Train Name\" required=\"required\">
               				</div>
           	 			</div>

   						<div class=\"form-group\">
        					<div class=\"input-group\">
              					<span class=\"input-group-addon\"><i class=\"fa fa-location-arrow\"></i></span>
             					<select class=\"form-control\" name=\"sp\" required=\"required\">
        							<option value=\"\" disabled selected>-- Select Starting Point --</option>  
			";

			$cdquery="SELECT station_name FROM station_details";
			$cdresult=mysqli_query($conn,$cdquery);

			while ($cdrow=mysqli_fetch_array($cdresult)) 
			{
				$cdTitle=$cdrow['station_name'];
				echo "
									<option value = \"$cdTitle\" > $cdTitle </option>
				";
			}

			echo "
								</select>
							</div>
						</div>

						<div class=\"form-group\">
							
          					<div class=\"input-group\">
               					<span class=\"input-group-addon\">Starting Time</span>
              					 <input type=\"time\" class=\"form-control\" name=\"st\"\"placeholder=\"Enter Starting Time\" required=\"required\">
           	 				</div>
        				</div>

       					<div class=\"form-group\">
        					<div class=\"input-group\">
        	     				<span class=\"input-group-addon\"><i class=\"fa fa-map-marker\"></i></span>
              					<select class=\"form-control\" name=\"dp\" required=\"required\">
        							<option value=\"\" disabled selected>-- Select Destination Point --</option>
			";

			$cdquery="SELECT station_name FROM station_details";
			$cdresult=mysqli_query($conn,$cdquery);

			while ($cdrow=mysqli_fetch_array($cdresult)) 
			{
				$cdTitle=$cdrow['station_name'];
				echo "
									<option value = \"$cdTitle\" > $cdTitle </option>
				";
			}

			echo "
								</select>
							</div>
						</div>

						<div class=\"form-group\">

          					<div class=\"input-group\">
               				<span class=\"input-group-addon\">Destination Time </span>
               					<input type=\"time\" class=\"form-control\" name=\"dt\" placeholder=\"Enter Destination Time\" required=\"required\">
           	 				</div>
        				</div>

       					<div class=\"form-group\">
         					<div class=\"input-group\">
               					<span class=\"input-group-addon\"><i class=\"fa fa-train\"></i></span>
               					<input type=\"text\" class=\"form-control\" name=\"ds\" placeholder=\"Enter Distance\" onkeypress=\"return onlyNumberKey(event)\" required=\"required\">
           	 				</div>
        				</div>

       					<div class=\"form-group\">
         					<div class=\"input-group\">
               					<span class=\"input-group-addon\"><i class=\"fa fa-map-marker\"></i></span>
               					<input type=\"number\" min=\"0\"class=\"form-control\" name=\"ns\" placeholder=\"Enter Intermediate Station Count\"   onkeypress=\"return onlyNumberKey(event)\" required=\"required\">
          		 			</div>
        				</div>

        				<div class=\"form-group\">
          					<div class=\"input-group\">
        	      				<span class=\"input-group-addon\"><i class=\"fa fa-location-arrow\"></i></span>
              					<select class=\"form-control\" name=\"dd\" required=\"required\">
        					</div>
       								<option value=\"\" disabled selected>-- Select Arrival Day --</option>
    								<option value = \"Day 1\" > Day 1 </option>
       								<option value = \"Day 2\" > Day 2 </option>
       								<option value = \"Day 3\" > Day 3 </option>
       							</select>
   						</div>

   						<div class=\"text-center\" style=\"margin-top:5%;margin-bottom:-5%;\">
    						<input type=\"submit\" class=\"btn btn-primary\" name=\"submit\" value=\"SUBMIT\" style=\"margin-right:7%;\">
    						<input type=\"reset\" class=\"btn btn-primary\" style=\"margin-left:7%;\" value=\"RESET\">
    					</div>
  					</form>
				</div>
			";}
		?>
	<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
  </script>
</body>
</html>
