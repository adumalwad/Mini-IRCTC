<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Verification Mail</title>
<link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="bg-success">

    <?php

        require "connect_database.php";
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $temp_id=$_GET["id"];
        $querry2="SELECT * FROM user_details where user_id=('".$temp_id."')";
        $result1 = $conn->query($querry2);
        $row = $result1->fetch_assoc();
        $status=$row["status"];
        $emailid=$row["emailid"];
        $fname=$row["fname"];
        $lname=$row["lname"];
        if ($status=='verified') 
        {

            echo"
                <div class=\"alert alert-danger alert-dismissible\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    <strong> ".$row["emailid"]."</strong> has been already verified. No need to send verifcation notice email.
                </div>
            ";
        } 
        else
        {
            echo"
                <div class=\"alert alert-success alert-dismissible\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    Verifcation mail has been successfully sent to <strong> ".$row["emailid"].".
                </div>
            ";

            $subject = "Account Verifcation Notice";

            $sender = "From: MINI IRCTC <ramdumalwad@gmail.com>\r\n";
            $sender .= "MIME-Version: 1.0\r\n";
            $sender .="Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = "   <html>
                                <body>
                                    <h1 style=\"color:green;text-align:center\">Account Verification </h1>
                                    <p>Hi <b>$fname $lname</b>,<br>
                                        Your Mini IRCTC account is <b style=\"color:tomato;\">not verified</b>. Please verify your account within next 72 hours. Otherwise, your account will be deleted from record.<br><br>
                                        <div>
                                            <b>Steps for Account Verifcation:</b>
                                            <ol>
                                                <li>Open Mini IRCTC website.</li>
                                                <li>Enter your mobile number and password.</li>
                                                <li>You will receive email from our team regarding OTP,click on \"Enter OTP\" button and enter OTP.
                                                <li> You will be successfully registered on website.
                                            </ol>
                                        </div>
                                        <div style=\"margin-top:10px;\">
                                            <br>
                                            We are here to help if you need it.If you face any issue, try to contact our team.Team details are available on website.
                                        </div>

                                        <br><br><br>
                                        - MINI IRCTC Team
                                    </p>
                                </body>
                            </html>
            ";
            mail($emailid, $subject, $message, $sender);
        }
        $conn->close();
    ?>
    <div class="text-center">
        <a href="http://localhost/railway/users_details.php" class=" text-dark font-weight-bold">
            <button class="btn btn-primary text-dark p-2" style="margin-right: 20px;">
                <i class="fa fa-arrow-left"></i> Back
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


