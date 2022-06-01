<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Delete Result</title>
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
        $querry1 = "DELETE from user_details where user_id= ('".$temp_id."')";

        if ($conn->query($querry1) === TRUE) 
        {
            while($row = $result1->fetch_assoc()) 
            {
                echo"
                    <div class=\"alert alert-success alert-dismissible\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                            </button>
                            <strong> ".$row["emailid"]."</strong> has been successfully deleted from record <i class=\"far fa-smile\"></i>.
                    </div>
                ";
            }
        } 
        else 
        {
            echo "Error:" . $conn->error;
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


