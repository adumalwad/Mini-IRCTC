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
			$doj=$_POST["doj"];
			$_SESSION["doj"] = "$doj";
			$cdquery="SELECT * FROM train_details where train_number= '".$trainno."'";
			$cdresult=mysqli_query($conn,$cdquery);			
			$cdrow=mysqli_fetch_array($cdresult);
			date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d');
			$time=date('h:i:s');
			$diff1 = abs(strtotime($doj)-strtotime(date("Y-m-d")));
	        $days = floor($diff1 / (60*60*24));
	        if($days <= 2)
    	    {
        	     echo "
            	    	<div class=\"alert alert-danger alert-dismissible\">
                	    	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                      		<strong>You need to schedule train minimum 3 days before start time.</strong> <i class=\"fa fa-frown\"></i>.
	                  	</div>
    	              	<div class=\"text-center\">
        	            	<br>
            	        	<div class=\"text-center mt-3\">
                	        	<a href=\"http://localhost/railway/schedule_train.php\">
                    	        	<button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
        	                	</a>
        	                	<a href=\"http://localhost/railway/admin_login.html\" class=\" text-dark font-weight-bold\">
            						<button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
               							<span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
            						</button>
        						</a>
            	        	</div>
                		</div>
          		";
          		die();
        	}
			//echo "$date <br> $time <br> $doj <br> ".$cdrow[3]."";
			if (($date == $doj ) && ($time >= $cdrow[3]) ) 
			{
				echo "
					<div class=\"alert alert-danger alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong> Scehdule time must be earlier than train start time <strong> </strong> <i class=\"fa fa-frown-o\"></i>.
                    </div>
                    <div class=\"text-center\">
				        <a href=\"http://localhost/railway/schedule_train.php\" class=\" text-dark font-weight-bold\">
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
											<th class=\"text-center\">Date Of Journey</th>
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
											<td>".$doj."</td>
										</tr>
									</tbody>
								</table>
							</div>
						<div>
					</div>
			";
			
			$cdquery="SELECT * FROM train_schedule where train_number='".$trainno."' ORDER BY distance ASC  ";
			$cdresult=mysqli_query($conn,$cdquery);
			$stations=array();
			$arrival=array();
			$departure=array();
			$i=0;
			while($cdrow=mysqli_fetch_array($cdresult))
			{
				$stations[$i]=$cdrow["station_name"];
				$arrival[$i]=$cdrow["arrival_time"];
				$departure[$i]=$cdrow["departure_time"];
				$i+=1;
			}

			$_SESSION["ns"] = $i-1;
			//echo" ".$_SESSION["ns"]." ";

			echo "
					<div class=\"container-sm\">
						<div class=\"table table-responsive\">
							<div class=\"table-wrapper\">
								<div class=\"table-title\" style=\"width:100%;\">
									<div class=\"row\">
										<div class=\"col-xs-6\">
											<h2>Intermediate Station Details</h2>
										</div>
									</div>
								</div>
								<table class=\"table table-striped table-hover text-center table-bordered\">
									<thead>
									<th style=\"text-align:center;\">Sr. No.</th>
									<th style=\"text-align:center;\">Starting Point</th>
									<th class=\"text-center\">Departure Time</th>
									<th style=\"text-align:center;\">Destination Point</th>
									<th class=\"text-center\">Arrival Time</th>
									<th style=\"text-align:center\">Journey Date</th>
									<th style=\"text-align:center;\">1A seats</th>
									<th style=\"text-align:center;\">1A Fare</th>
									<th style=\"text-align:center;\">2A seats</th>
									<th style=\"text-align:center;\">2A Fare</th>
									<th style=\"text-align:center;\">3A seats</th>
									<th style=\"text-align:center;\">3A Fare</th>
									<th style=\"text-align:center;\">CC seats</th>
									<th style=\"text-align:center;\">CC Fare</th>
									<th style=\"text-align:center;\">2S seats</th>
									<th style=\"text-align:center;\">2S Fare</th>
									<th style=\"text-align:center;\">SL seats</th>
									<th style=\"text-align:center;\">SL Fare</th>
									</thead>
									<tbody>
			";

			echo "
										<form action=\"schedule_train_result.php\" method=\"post\">
			";
			$i=0;
			while ($i<=$_SESSION["ns"]) 
			{
				$_SESSION["st".$i]=$stations[$i];
				$i+=1;
			}

			$i=0;
			$x=0;
			$p=0;
			while ($i<$_SESSION["ns"]) 
			{
				$j=$i+1;
				while($j<$_SESSION["ns"]+1)
				{
					echo "
 									<tr>
 										<td>".($x+1)."</td>
		 								<td>".$stations[$i]."</td>
		 								<td>".$departure[$i]."</td>
										<td>".$stations[$j]."</td>
										<td>".$arrival[$j]."</td>
										<td><input style=\"text-align:center;\" type=\"date\" min=\"".$_SESSION["doj"]."\" name=\"d1".$p."\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"s1".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"f1".$p."\" value=\"0\" required></td>	
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"s2".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"f2".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"s3".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"f3".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"s4".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"f4".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"s5".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"f5".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"s6".$p."\" value=\"0\" required></td>
										<td><input onkeypress=\"return onlyNumberKey(event)\" style=\"text-align:center;\" type=\"text\" name=\"f6".$p."\" value=\"0\" required></td>
									</tr>
					";
					$j=$j+1;
					$p=$p+1;
					$x=$x+1;
				}
 				
				$i+=1;
			}
			echo "
									<tbody>
								</table>
							</div>
						</div>
					</div>
					<div class=\"text-center\" style=\"margin-bottom:30px;\" >
                  				<button type=\"submit\" style=\"margin-right: 2%;\" class=\"btn btn-success\">SUBMIT</button>
                  				<button type=\"reset\" style=\"margin-left: 2%;\" class=\"btn btn-success\">RESET</button>
                		</div>
					</form>
					<div class=\"text-center\">
				        <a href=\"http://localhost/railway/schedule_train.php\" class=\" text-dark font-weight-bold\">
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
							                <li class=\"nav-item nav-dark\">
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
					                  		<li class=\"nav-item active\">
					                    		<a class=\"nav-link\" href=\"#\"><b>Schedule Train</b></a>
					                  		</li>
					                  		<li class=\"nav-item\">
					                    		<a class=\"nav-link\" href=\"http://localhost/railway/add_train.php\"><b>Add Train</b></a>
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
			echo "
						<div class=\"login-form\">
    					<form action=\"http://localhost/railway/schedule_train.php\" method=\"post\">
    						<div class=\"avatar\">
    							<i class=\"fa fa-train\"></i>
    						</div>
        				<h2 class=\"text-center\">Schedule Train</h2>

        				<div class=\"form-group\">
         					<div class=\"input-group\">
              			<span class=\"input-group-addon\"><i class=\"fa fa-train\"></i></span>
                		<select class=\"form-control\" name=\"tno\" required=\"required\">
                			<option value = \"\" selected disabled> -- Select Train -- </option>
            				
   			 ";

				$query="SELECT * FROM train_details";
				$result=mysqli_query($conn,$query);

				while ($row=mysqli_fetch_array($result)) 
				{
					$tno=$row['train_number'];
					$tn=$row['train_name']." starting at ".$row['start_point'];
					echo " 				
											<option value = \"$tno\" > $tn </option>
					";
				}

			echo "
										</select>
									</div>
        				</div>

        				<div class=\"form-group\">
         					<div class=\"input-group\">
               					<span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>
								<input class=\"form-control\" type=\"date\" id=\"jd1\"name=\"doj\" required>
							</div>
						</div>

						<div class=\"text-center\" style=\"margin-top: -5px;\">
                  			<button type=\"submit\" class=\"btn btn-primary\" style=\"margin-right:7%;\">
                  				SUBMIT
                  			</button>
               				<button type=\"reset\" class=\"btn btn-primary style=\"margin-left:7%;\">
               					RESET
               				</button>
             			</div>	
					</form>
				</div>
			";
		}
	?>

	<script>
    function onlyNumberKey(evt) {

        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
  </script>
	<script type="text/javascript">
                  var today = new Date();
                  var dd = today.getDate();
                  var mm = today.getMonth()+1;
                  var yyyy = today.getFullYear();
                  if(dd<10)
                  {
                    dd='0'+dd
                  } 
                  if(mm<10)
                  {
                     mm='0'+mm
                  } 
                  today = yyyy+'-'+mm+'-'+dd;
                  document.getElementById("jd1").setAttribute("min", today);
    </script>
</body>
</html>


