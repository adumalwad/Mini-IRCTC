<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Password Sent</title>
  <link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style>
  .login-form {
    width: 385px;
    margin: 30px auto;
  }
    .login-form form {        
      margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .login-btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .input-group-addon .fa {
        font-size: 18px;
    }
    .login-btn {
        font-size: 15px;
        font-weight: bold;
    }
  .social-btn .btn {
    border: none;
        margin: 10px 3px 0;
        opacity: 1;
  }
    .social-btn .btn:hover {
        opacity: 0.9;
    }
  .social-btn .btn-primary {
        background: #507cc0;
    }
  .social-btn .btn-info {
    background: #64ccf1;
  }
  .social-btn .btn-danger {
    background: #df4930;
  }
    .or-seperator {
        margin-top: 20px;
        text-align: center;
        border-top: 1px solid #ccc;
    }
    .or-seperator i {
        padding: 0 10px;
        background: #f7f7f7;
        position: relative;
        top: -11px;
        z-index: 1;
    }
    .login-form .avatar {
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
    .login-form .avatar i {
        font-size: 62px;
    }
</style>
</head>
<body style="background-color: #c0ede1;">

    <?php

        require "connect_database.php";
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        if(!isset($_POST["submit"]))
        {
            echo "
                    <div class=\"login-form\">
                        <form action=\"http://localhost/railway/forgot_password.php\" method=\"post\">
                            <div class=\"avatar\">
                                <i class=\"fa fa-envelope\"></i>
                            </div>
                            <h2 class=\"text-center\">EMAIL ADDRESS</h2>   
                            <div class=\"form-group\">
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"><i class=\"fa fa-envelope\"></i></span>
                                    <input type=\"email\" class=\"form-control\" name=\"emailid\" placeholder=\" Enter Email Address\" required=\"required\">
                                </div>
                            </div>
                            <div class=\"form-group text-center\">
                                <input type=\"submit\" name=\"submit\" class=\"btn btn-primary login-btn\" style=\"margin-right: 7%;\" value=\"SUBMIT\">
                                <button type=\"reset\" class=\"btn btn-danger login-btn\" style=\"margin-left:7%;\">RESET</button>
                            </div>
                        </form>
                    </div>
            ";
        }
        else
        {
            $eid=$_POST["emailid"];
            $query1=mysqli_query($conn,"SELECT * FROM user_details WHERE user_details.emailid=BINARY '".$eid."' ") or die(mysql_error());
      		if(mysqli_num_rows($query1) == 0)
	        {
        		echo "
                		<div class=\"alert alert-danger alert-dismissible\">
                    		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                      		You have entered <strong>wrong email id</strong>.Please enter valid email id <i class=\"far fa-frown\"></i>.
                  		</div>
                  		<div class=\"text-center\">
	                		<br>
    	            		<div class=\"text-center mt-3\">
	                    		<a href=\"http://localhost/railway/forgot_password.php\">
    	                	    	<button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
        	            		</a>
            	    		</div>
            	  		</div>
          		";
          		die();
      		}
            else 
            {
                echo "
                        <div class=\"alert alert-success alert-dismissible\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                            	Password has been successfully sent to <b>".$_POST["emailid"]."</b> <i class=\"far fa-smile\"></i>.
                    	</div>
                ";
                $row1 = mysqli_fetch_array($query1);
                $code= $row1["password"];
                $fname= $row1["fname"];
                $lname= $row1["lname"];

		            $subject = "Mini IRCTC Account Password";
		            $sender = "From: MINI IRCTC <ramdumalwad@gmail.com>\r\n";
		            $sender .= "MIME-Version: 1.0\r\n";
		            $sender .="Content-Type: text/html; charset=ISO-8859-1\r\n";
		            $message = "   <html>
		                                <body>
        		                            <h1 style=\"color:green;text-align:center\"> Account Password</h1>
                		                       <p>Hi <b>$fname $lname</b>,<br>
                        		                    Your Mini IRCTC account password is:<br> 
		                                            <div style=\"font-size:30px;\">
        	    	                                    $code
            	    	                            </div>
                        	                        <br>
                            	                    <div>
                                	                   We are here to help if you need it.If you face any issue, try to contact our team.Team details are available on website.
        	                                        </div>
                        	                        <br><br><br>
                            	                    - MINI IRCTC Team
                                	            </p>
                                		</body>
                            		</html>
            		";
            	mail($eid, $subject, $message, $sender);
        	}
        }
        $conn->close();
    ?>
    <div class="text-center">
        <a href="http://localhost/railway/forgot_password.php" class=" text-dark font-weight-bold">
            <button class="btn btn-primary text-dark p-2" style="margin-right: 20px;"> 
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </button>
        </a>
        
        <a href="http://localhost/railway/index.html" class=" text-dark font-weight-bold">
            <button class="btn btn-primary text-dark p-2" style="margin-left: 20px;"> 
               <i class="fa fa-home" aria-hidden="true"></i> Home 
            </button>
        </a>
    </div>
</body>
</html>