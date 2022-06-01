<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Details</title>
<link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<link rel="stylesheet" type="text/css" href="new.css">
</head>

<body style="background-image: url(images/irctc.jpg);background-repeat: no-repeat;background-size: cover;background-attachment: fixed;">
  <?php 
    session_start();
    require "connect_database.php";
    if ($conn->connect_error) 
    {
      die("Connection failed: " . $conn->connect_error);
    }
    $mobile=$_POST["mno"];
    $_SESSION["mobile_number"]=$mobile;
    $pwd=$_POST["password"];
    $_SESSION["password"]=$pwd;
    $query1=mysqli_query($conn,"SELECT * FROM user_details WHERE user_details.mobile_number=BINARY $mobile ") or die(mysql_error());
    $query = mysqli_query($conn,"SELECT * FROM user_details WHERE user_details.mobile_number=BINARY $mobile AND user_details.password=BINARY '".$pwd."' ") or die(mysql_error());
    if(mysqli_num_rows($query) == 0)
    {
      if(mysqli_num_rows($query1) > 0)
      {
          echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>You have entered wrong Password</strong> <i class=\"far fa-frown\"></i>.
                  </div>
                  
          ";
      }
      else
      {
        echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>User does not exist</strong> <i class=\"far fa-frown\"></i>. If you are new user 
                      <a href=\"http://localhost/railway/signup.html\" class=\"text-danger font-weight-bold\" style=\"color:blue;\">
                       Signup Here
                      </a>
                  </div>
          ";
      }
      echo"
            <div class=\"text-center\">
                <br>
                <div class=\"text-center mt-3\">

                    <a href=\"http://localhost/railway/index.html\">
                        <button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                    </a>
                </div>
            </div>
      ";
      die();
    }

    if($row = mysqli_fetch_array($query))
    {

      $temp1=$row['emailid'];
      $_SESSION["emailid11"]=$temp1;
      $temp2=$row['user_id'];
      $temp3=$row['fname'];
      $temp4=$row['lname'];
      $temp5=$row['status'];
      $temp6=(int)$row['code'];
      if($temp6>0)
      {
            $subject = "Email Verification Code For MINI IRCTC";
            $sender = "From: MINI IRCTC <ramdumalwad@gmail.com>\r\n";
            $sender .= "MIME-Version: 1.0\r\n";
            $sender .="Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = "   <html>
                                <body>
                                    <h1 style=\"color:green;text-align:center\">Welcome to Mini IRCTC &#128512;</h1>
                                       <p>Hi <b>$temp3 $temp4</b>,<br>
                                            Your verification code is<br> 
                                            <div style=\"font-size:30px;\">
                                                $temp6
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
            if(mail($temp1, $subject, $message, $sender)){
                $_SESSION['email'] = $temp1;
                $_SESSION['password'] = $pwd;
            }
           echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>You did not verify your email address</strong> <i class=\"far fa-frown\"></i>.OTP has been sent to $temp1.<br>
                  </div>
                  <div class=\"text-center\">
                      <a href=\"http://localhost/railway/user-otp_1.php\" class=\"text-danger font-weight-bold\">
                      <button class=\"btn btn-primary\"> Enter OTP</button>
                      </a>
                  </div>
          ";
          die();
      }
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
                  <li class=\"nav-item nav-dark\">
                    <a class=\"nav-link\" href=\"http://localhost/railway/book_ticket_1.php\"><b>Book Ticket</b></a>
                  </li>
                  <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"http://localhost/railway/cancel_ticket_1.php\"><b>Cancel Ticket</b></a>
                  </li>
                  <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"http://localhost/railway/tatkal_ticket.php\"><b>Tatkal Ticket</b></a>
                  </li>
                  <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"http://localhost/railway/user_booking_history_1.php\"><b>Booking History</b></a>
                  </li>
                </ul>
                <ul class=\"nav navbar-nav navbar-right\" style=\"background-color: red; color: white;\">
                  <li>
                    <a href=\"http://localhost/railway/index.html\" style=\"color:white;\"><span class=\"glyphicon glyphicon-log-in\"> </span><b> Logout</b> </a>
                  </li>
                </ul>
              </div>
            </nav>
      ";
      $_SESSION["id"]=$temp2;
      $query3 = mysqli_query($conn," SELECT * from user_details where user_details.mobile_number=BINARY $mobile ") or die(mysql_error());

      
      while($row1 = mysqli_fetch_array($query3))
      {
        echo"
              <div class=\"login-form text-center\">
                <form action=\"http://localhost/railway/edit_user_details_1.php?id=".$row1["user_id"]."\" method=\"post\">
                    <div class=\"avatar\">
                      <i class=\"fa fa-user\"></i>
                    </div>
                    <h2 class=\"text-center\">User Details</h2>
        ";            
        echo"
                    <div class=\"form-group\"><b style=\"margin-right:10px;\">Full Name:</b> ".$row1["fname"]." ".$row1["lname"]."</div>
                    <div class=\"form-group\"><b style=\"margin-right:10px;\">Email Id: </b>".$row1["emailid"]."</div>
                    <div class=\"form-group\"><b style=\"margin-right:10px;\">Mobile Number: </b>".$row1["mobile_number"]."</div>
                    <div class=\"form-group\"><b style=\"margin-right:10px;\">Date Of Birth:</b>".$row1["dob"]." </div>
                    <div class=\"form-group\"><b style=\"margin-right:10px;\">Password: </b>".$row1["password"]." </div>
                    <div class=\"form-group\"><b style=\"margin-right:10px;\">Gender: </b>".$row1["gender"]." </div>
                    
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
