<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Train Result</title>
<link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body class="bg-success">

    <?php
        session_start();
        require "connect_database.php";
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO train_details (train_name,start_point,arrival_time,destination_point,destination_time,arrival_day,distance) VALUES ('".$_SESSION["tname"]."','".$_SESSION["sp"]."','".$_SESSION["st"]."','".$_SESSION["dp"]."','".$_SESSION["dt"]."','".$_SESSION["dd"]."','".$_SESSION["ds"]."')";

        if ($conn->query($sql) === TRUE)
        {
            echo "
                    <div class=\"alert alert-success alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong>".$_SESSION["tname"]."</strong> has been successfully added <i class=\"far fa-smile\"></i>.
                    </div>
            ";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $cdquery="SELECT train_number FROM train_details where train_name='".$_SESSION["tname"]."' AND start_point='".$_SESSION["sp"]."' AND destination_point='".$_SESSION["dp"]."'";
        $cdresult=mysqli_query($conn,$cdquery);			
        $cdrow=mysqli_fetch_array($cdresult);
        $trainno=$cdrow['train_number'];

        $sql = "INSERT INTO train_schedule (train_number,station_name,arrival_time,departure_time,distance) VALUES ('".$trainno."','".$_SESSION["sp"]."','".$_SESSION["st"]."','".$_SESSION["st"]."','0')";
        $flag=($conn->query($sql));
        $temp=1;
        while ($temp<=$_SESSION["ns"]) 
        {
	       $sql = "INSERT INTO train_schedule (train_number,station_name,arrival_time,departure_time,distance) VALUES ('".$trainno."','".$_POST["stn".$temp]."','".$_POST["st".$temp]."','".$_POST["dt".$temp]."','".$_POST["ds".$temp]."')";
	       $flag=($conn->query($sql));
	       $temp+=1;
        }
        $sql = "INSERT INTO train_schedule (train_number,station_name,arrival_time,departure_time,distance) VALUES ('".$trainno."','".$_SESSION["dp"]."','".$_SESSION["dt"]."','".$_SESSION["dt"]."','".$_SESSION["ds"]."')";
        $flag=($conn->query($sql));

        if ($flag === TRUE)
        {
            echo "
                    <div class=\"alert alert-success alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong>".$_SESSION["tname"]."</strong> has been successfully scheduled <i class=\"far fa-smile\"></i>.
                    </div>
            ";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    ?>
        <div class="text-center">
        <a href="http://localhost/railway/add_train.php" class=" text-dark font-weight-bold">
            <button class="btn btn-primary text-dark p-2" style="margin-right: 20px;margin-left: 20px;">
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
