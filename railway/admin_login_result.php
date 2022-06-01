<!DOCTYPE html>
<html>
<head>
	<title>Admin Menu</title>
	<link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel="stylesheet" type="text/css" href="new.css">
</head>

<body style="background-image: url(images/irctc.jpg);background-repeat: no-repeat;background-size: cover;background-attachment: fixed;">
	<div align="center">

		<?php

			session_start();
			require "connect_database.php";
			if ($conn->connect_error) 
	    {
	      die("Connection failed: " . $conn->connect_error);
  	  } 
			//$_POST["uname"]=='admin' AND $_POST["pwd"]=='admin'
			if (isset($_POST['submit']) && isset($_POST["uname"]) && isset($_POST["pwd"]))
			{
				$uname = $_POST["uname"];             
  				$pass = $_POST["pwd"];
  				$_SESSION["username"]=$uname;
  				$_SESSION["password1"]=$pass;
  				//echo" ".$_SESSION["username"]." <br> ".$_SESSION["password"]." ";
 				$query1=mysqli_query($conn,"SELECT * FROM admin_details WHERE admin_details.username=BINARY '$uname' ") or die(mysql_error());
			    $query = mysqli_query($conn,"SELECT * FROM admin_details WHERE admin_details.username= BINARY '$uname' AND admin_details.password= BINARY'".$pass."' ") or die(mysql_error());
			    if(mysqli_num_rows($query) == 0)
			    {
      				if(mysqli_num_rows($query1) > 0)
				      {
        				  echo "
                			  <div class=\"alert alert-danger alert-dismissible text-left\">
		                      	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
    			                  </button>
          			            <strong>You have entered wrong password</strong> <i class=\"fa fa-frown\"></i>.
			                  </div>
				          ";
		      		}
				      else
			      	{
      			  	echo "
                		  <div class=\"alert alert-danger alert-dismissible text-left\">
                    		  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
		                      </button>
    		                  <strong>Admin does not exist</strong> <i class=\"fa fa-frown\"></i>.  
		                  </div>
          			";
  				    }
  				    echo "
  				    		<div class=\"text-center\">
			                	<a  style=\"margin-right: 3%;\" href=\"http://localhost/railway/admin_login.html\">
                    				<button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                  				</a>
                  				<a style=\"margin-left: 3%;\" href=\"http://localhost/railway/index.html\">
                      				<button class=\"btn btn-primary\"><i class=\"fa fa-home\"></i> Home Page </button>
			                	</a>
            				</div>
  				    ";
				      die();
    			}
    			else
				{
						//echo"HEllo ".$uname." pass";
						echo"
					            <nav class=\"navbar navbar-inverse\">
					            	<div class=\"container-fluid\">
					                	<div class=\"navbar-header\">
					                 		 <a class=\"navbar-brand\" href=\"#\">Mini IRCTC</a>
					                	</div>
					                	<ul class=\"nav navbar-nav\">
					                  		<li class=\"active\">
					                    		<a class=\"nav-link\" href=\"#\"><i class=\"fa fa-home\"></i></a>
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
      					$query3 = mysqli_query($conn," SELECT * from admin_details where admin_details.username=BINARY '$uname' AND admin_details.password=BINARY '$pass' ") or die(mysql_error());

      
				    	while($row1 = mysqli_fetch_array($query3))
      					{
        					echo"
					              <div class=\"login-form text-center\">
					                <form action=\"http://localhost/railway/edit_admin_details.php?id=".$row1["admin_id"]."\" method=\"post\">
					                    <div class=\"avatar\">
					                      <i class=\"fa fa-user\"></i>
					                    </div>
					                    <h2 class=\"text-center\">Admin Details</h2>

					                 	<div class=\"form-group\"><b style=\"margin-right:10px;\">Username:</b> ".$row1["username"]."</div>
					                    <div class=\"form-group\"><b style=\"margin-right:10px;\">Password: </b>".$row1["password"]."</div>					                    
 					                   <div class=\"form-group text-center\">					
					                       <button type=\"submit\" class=\"btn btn-success login-btn\" style=\"margin-right: 7%;\">
                        						Edit
					                        </button>
					                    </div>
					                  </form>
					              </div>
					        ";
					      }
				}
			} 
		?>
</body>

</html>