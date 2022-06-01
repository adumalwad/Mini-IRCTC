<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Schesule Train</title>
  <link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
div.login-form {
    width: 385px;
    margin: 30px auto;
  }
    div.login-form form {        
      margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    div.login-form h2 {
        margin: 0 0 15px;
    }
    div.form-control, .login-btn {
        min-height: 38px;
        border-radius: 2px;
    }
    div.input-group-addon .fa {
        font-size: 18px;
    }
    div.login-btn {
        font-size: 15px;
        font-weight: bold;
    }
    div.login-form .avatar {
        color: #fff;
    margin: 0 auto 10px;
    margin-top: -15px;
    text-align: center;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    z-index: 9;
    background: blue;
    padding: 15px;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
  }
  div.login-form .avatar i {
        font-size: 62px;
    }
}
 </style>
</head>

<body style="background-image: url(images/irctc.jpg);background-repeat: no-repeat;background-size: cover;background-attachment: fixed;">
	
	<?php
		session_start();

		require "connect_database.php";
		if ($conn->connect_error) 
    {
        die("Connection failed: ".$conn->connect_error);
    }

			echo "
						<nav class=\"navbar navbar-inverse\">
						<div class=\"container-fluid\">
						    <div class=\"navbar-header\">
						      <a class=\"navbar-brand\" href=\"#\">Mini IRCTC</a>
 							</div>
    						<ul class=\"nav navbar-nav\">
      							<li class=\"nav-item\">
							        <a class=\"nav-link\" href=\"http://localhost/railway/index.html\"><i class=\"fa fa-home\"></i></a>
						      	</li>
						      	<li class=\"nav-item\">
						        	<a class=\"nav-link\" href=\"http://localhost/railway/book_ticket.php\"><b>Find Train</b></a>
					        	</li>
    							<li class=\"active\">
						        	<a class=\"nav-link\" href=\"#\"> <b>Train Info</b></a>
        						</li>
        						<li class=\"nav-item\">
        							<a class=\"nav-link\" href=\"http://localhost/railway/about_us.html\"><b>About us</b></a>
        						</li>
        						<li class=\"nav-item\">
        							<a class=\"nav-link\" href=\"http://localhost/railway/contact_us.html\"> <b>Contact Us</b></a>
       							 </li>     
    						</ul>
    						<ul class=\"nav navbar-nav navbar-right\">
      							<li>
      								<a href=\"http://localhost/railway/signup.html\">
      									<span class=\"glyphicon glyphicon-user\"></span> <b>Sign Up</b>
      								</a>
      							</li>
      							<li>
      								<a href=\"http://localhost/railway/admin_login.html\"><span class=\"glyphicon glyphicon-log-in\"></span> <b>Admin Login</b> </a>
      							</li>
    						</ul>
  						</div>
					</nav>
						<div class=\"login-form\">
	    					<form action=\"http://localhost/railway/train_information_result.php\" method=\"post\">
    							<div class=\"avatar\">
    								<i class=\"fa fa-train\"></i>
    							</div>
        						<h2 class=\"text-center\">Train Details</h2>

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

								<div class=\"text-center\" style=\"margin-top: -5px;\">
                  					<button type=\"submit\" class=\"btn btn-primary\" style=\"margin-right:7%;\">SUBMIT</button>
               						<button type=\"reset\" class=\"btn btn-primary style=\"margin-left:7%;\">RESET</button>
             					</div>	
							</form>
						</div>
			";
	?>
</body>
</html>


