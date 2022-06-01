<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Signup Result</title>
<link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<body>
	<?php 

		require "connect_database.php";
		if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $fname=$_POST["fname"];
        $lname=$_POST["lname"];
        $gender=$_POST["gender"];
		$eid=$_POST["emailid"];
		$pwd=$_POST["password"];
		$mno=$_POST["mobileno"];
		$dob=$_POST["dob"];
		$_SESSION['emailid']=$eid;
		$email_check = "SELECT * FROM user_details WHERE emailid = '$eid'";
    	$res = mysqli_query($conn, $email_check);
        //echo"$dob";
    	if(mysqli_num_rows($res) > 0)
    	{
        	 echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>Email Id already registered on website.Please use another email id</strong> <i class=\"fa fa-frown\"></i>.
                  </div>
                  <div class=\"text-center\">
                    <br>
                    <div class=\"text-center mt-3\">
                        <a href=\"http://localhost/railway/signup.html\">
                            <button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                        </a>
                    </div>
                </div>
          ";
          die();
    	}
        $mobile_check = "SELECT * FROM user_details WHERE mobile_number = '$mno'";
        $res1 = mysqli_query($conn, $mobile_check);
        if(mysqli_num_rows($res1) > 0)
        {
             echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>Mobile Number is already registered on website.Please use another mobile number</strong> <i class=\"fa fa-frown\"></i>.
                  </div>
                  <div class=\"text-center\">
                    <br>
                    <div class=\"text-center mt-3\">
                        <a href=\"http://localhost/railway/signup.html\">
                            <button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                        </a>
                    </div>
                </div>
          ";
          die();
        }
        date_default_timezone_set('Asia/Kolkata');
        $diff1 = abs(strtotime($dob)-strtotime(date("Y-m-d")));
        $years = floor($diff1 / (365*60*60*24));
        if($years < 18)
        {
             echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>Your age is below 18 years. You can not register on website</strong> <i class=\"fa fa-frown\"></i>.
                  </div>
                  <div class=\"text-center\">
                    <br>
                    <div class=\"text-center mt-3\">
                        <a href=\"http://localhost/railway/signup.html\">
                            <button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                        </a>
                    </div>
                </div>
          ";
          die();
        }
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO user_details (fname, lname, gender, emailid, password, mobile_number, dob, code, status)
                        values('$fname', '$lname', '$gender', '$eid', '$pwd', '$mno', '$dob', '$code', '$status')";
        $data_check = mysqli_query($conn, $insert_data);
        if($data_check)
        {
            $subject = "Email Verification Code For MINI IRCTC";
            $sender = "From: MINI IRCTC <ramdumalwad@gmail.com>\r\n";
            $sender .= "MIME-Version: 1.0\r\n";
            $sender .="Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = "   <html>
                                <body>
                                    <h1 style=\"color:green;text-align:center\">Welcome to Mini IRCTC &#128512;</h1>
                                       <p>Hi <b>$fname $lname</b>,<br>
                                            Your verification code is<br> 
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
            if(mail($eid, $subject, $message, $sender))
            {
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }
            else
            {
                $errors['otp-error'] = "Failed while sending code!";
            }
        }
        /*else
        {
             echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>Your age is below 18 years.You can not register on website</strong> <i class=\"fa fa-frown\"></i>.
                  </div>
                  <div class=\"text-center\">
                    <br>
                    <div class=\"text-center mt-3\">
                        <a href=\"http://localhost/railway/signup.html\">
                            <button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                        </a>
                    </div>
                </div>
          ";
          die();
        }*/
		$conn->close(); 
	?>
	<div class="text-center">

	  <a class="font-weight-bold text-dark" href="http://localhost/railway/index.html">
			<button class="btn btn-primary">
				<strong><i class='fa fa-home'></i> Home page</strong>
			</button>
	  </a>
	</div>
</body>
</html>
