
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php

        session_start();
        require "connect_database.php";
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        if(!isset($_POST['check']))
        {
            echo"
                <div  style=\"margin-top:7%;margin-bottom:2%;margin-left:5%;margin-right:5%;\">
                    <div class=\"row\">
                        <div class=\"col-md-4 offset-md-4 form pt-5 pb-3\">
                            <form action=\"user-otp_2.php\" method=\"POST\" autocomplete=\"off\">
                                <h2 class=\"text-center\">Code Verification</h2>
                                <p class=\"text-center text-danger\">Verification code has been sent to registered email address.</p>
                                <div class=\"form-group\">
                                    <input class=\"form-control\" type=\"number\" name=\"otp\" placeholder=\"Enter verification code\" required>
                                </div>
                                <div class=\"form-group\">
                                    <input class=\"form-control button btn btn-success\" type=\"submit\" name=\"check\" value=\"Verify\">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            ";
        }
        else
        {
            $otp_code = $_POST['otp'];
            $check_code = "SELECT * FROM user_details WHERE code = $otp_code";
            $code_res = mysqli_query($conn, $check_code);
            if(mysqli_num_rows($code_res) > 0)
            {
                $fetch_data = mysqli_fetch_assoc($code_res);
                $fetch_code = $fetch_data['code'];
                $email = $fetch_data['emailid'];
                $fname = $fetch_data['fname'];
                $lname = $fetch_data['lname'];
                $code = 0;
                $status = 'verified';
                $update_otp = "UPDATE user_details SET code = $code, status = '$status' WHERE code = $fetch_code";
                $update_res = mysqli_query($conn, $update_otp);
                if($update_res)
                {
                    echo "
                    <div class=\"alert alert-success alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong> $fname $lname</strong> has been successfully added to database. <i class=\"fa fa-smile-o\"></i>.
                    </div>
                    <div class=\"text-center\">
                        <a class=\"font-weight-bold text-dark\" href=\"http://localhost/railway/users_details.php\">
                            <button class=\"btn btn-primary\" style=\"margin-right:20px;\">
                                <strong><i class=\"fa fa-arrow-left\"></i> Back</strong>
                            </button>
                        </a>
                        <a class=\"font-weight-bold text-dark\" href=\"http://localhost/railway/admin_login.html\">
                            <button class=\"btn btn-danger\" style=\"margin-left:20px;\">
                                <strong><i class='fa fa-sign-out'></i> Logout</strong>
                            </button>
                        </a>
                    </div>
                " ;
                }
                exit();
            }
            else
            {
                 echo "
                    <div class=\"alert alert-danger alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong>Hi!</strong> You have Entered Wrong OTP <i class=\"fa fa-frown-o\"></i>.
                    </div>
                    <div class=\"text-center\">
                        <a class=\"font-weight-bold text-dark\" href=\"http://localhost/railway/user-otp_2.php\">
                            <button class=\"btn btn-primary\" style=\"margin-right:20px;\">
                                <strong><i class=\"fa fa-arrow-left\"></i> Back</strong>
                            </button>
                        </a>
                        <a class=\"font-weight-bold text-dark\" href=\"http://localhost/railway/index.html\">
                            <button class=\"btn btn-primary\" style=\"margin-left:20px;\">
                                <strong><i class='fa fa-home'></i> Home page</strong>
                            </button>
                        </a>
                    </div>
                " ;
                die();
            }
        }
    ?>   
    <div class="text-center">
        <a class="font-weight-bold text-dark" href="http://localhost/railway/signup_1.html">
            <button class="btn btn-primary" style="margin-right: 20px;">
                <strong><i class='fa fa-arrow-left'></i> Back</strong>
            </button>
      </a>
      <a class="font-weight-bold text-dark" href="http://localhost/railway/index.html">
            <button class="btn btn-primary" style="margin-left: 20px;">
                <strong><i class='fa fa-home'></i> Home page</strong>
            </button>
      </a>
    </div> 
</body>
</html>