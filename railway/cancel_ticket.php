<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cancel Ticket Result</title>
<link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php 

    session_start();
    require "connect_database.php";
    if ($conn->connect_error) 
    {
        die("Connection failed: ".$conn->connect_error);
    }
    $pnr_number=$_POST["cancpnr"];
    $user_id=$_SESSION["id"];
    $sql=" UPDATE reservation SET ticket_status ='CANCELLED' WHERE reservation.pnr_number='".$pnr_number."' AND reservation.user_id='".$user_id."' ";
    $query1 = mysqli_query($conn,"SELECT * FROM reservation WHERE reservation.pnr_number='".$pnr_number."' AND reservation.user_id='".$user_id."' ") or die(mysql_error());
    if ($conn->query($sql) === TRUE) 
    {
        if(mysqli_num_rows($query1) == 0)
        {
          echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>You have entered wrong PNR number</strong> <i class=\"far fa-frown\"></i>.
                  </div>
                ";
        }
        else
        {
            echo "
                  <div class=\"alert alert-success alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>You have successfully Cancelled Your Ticket <i class=\"far fa-smile\"></i>.
                  </div>
                ";
        }
    } 
    else 
    {
        echo "<br><br>Error:" . $conn->error;
    }
    $conn->close(); 
  ?>
   </div>
      <div class="text-center">
        <br><br>
        <div class="text-center mt-3">
            <a class=" text-dark font-weight-bold"href="http://localhost/railway/index.html">
                <i class="glyphicon glyphicon-home"></i> Home Page
            </a>
        </div>
    </div>
</body>
</html>
