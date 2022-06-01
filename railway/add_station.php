<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Signup Page</title>
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
                        <form action=\"http://localhost/railway/add_station.php\" method=\"post\">
                            <div class=\"avatar\">
                                <i class=\"fa fa-train\"></i>
                            </div>
                            <h2 class=\"text-center\">ADD STATION</h2>   
                            <div class=\"form-group\">
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\"><i class=\"fa fa-map-marker\"></i></span>
                                    <input type=\"text\" class=\"form-control\" name=\"sname\" placeholder=\"Station Name\" required=\"required\">
                                </div>
                            </div>
                            <div class=\"form-group text-center\">
                                <input type=\"submit\" name=\"submit\" class=\"btn btn-primary login-btn\" style=\"margin-right: 7%;\" value=\"ADD STATION\">
                                <button type=\"reset\" class=\"btn btn-primary login-btn\" style=\"margin-left:7%;\">Reset</button>
                            </div>
                        </form>
                    </div>
            ";
        }
        else
        {
            $sql = "INSERT INTO station_details(station_name) VALUES ('".$_POST["sname"]."')";
            if ($conn->query($sql) === TRUE) 
            {
                echo "
                        <div class=\"alert alert-success alert-dismissible\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                            </button>
                            <strong>
                ";
                echo " ".$_POST["sname"]." </strong> has been successfully added to record <i class=\"far fa-smile\"></i>.
                    </div>
                ";
            //echo " '".$_POST["sname"]."':New record created successfully";
            }
            else
            {
                echo "Error:" . $conn->error;
            }
        }
        $conn->close();
    ?>
    <div class="text-center">
        <a href="http://localhost/railway/station_details.php" class=" text-dark font-weight-bold">
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