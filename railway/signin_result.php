<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Booked Tickets</title>
<link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body {
        color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
  }
  .table-responsive {
        margin: 30px 0;
    }
  .table-wrapper {
    min-width: 1000px;
        background: #fff;
        
    border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
  .table-title {        
    padding-bottom: 15px;
    background: #435d7d;
    color: #fff;
    padding-left: 20px;
    padding-top: 15px;
    
    border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
  }
  .table-title .btn-group {
    float: right;
  }
  .table-title .btn {
    color: #fff;
    float: right;
    font-size: 13px;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    
  }
  .table-title .btn i {
    float: left;
    font-size: 21px;
  }
  .table-title .btn span {
    float: left;
    margin-top: 2px;
  }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
    }
  table.table tr th:first-child {
    width: 10%;
  }
  table.table tr th:last-child {
    width: 100px;
  }
    table.table-striped tbody tr:nth-of-type(odd) {
      background-color: #fcfcfc;
  }
  table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
  }
    table.table th i {
        font-size: 13px;
        
        cursor: pointer;
    } 
    table.table td:last-child i {
    
    font-size: 22px;
        margin: 0 5px;
    }
  table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
    outline: none !important;
  }
  table.table td a:hover {
    color: #2196F3;
  }
  table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
  table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
  } 
</style>
</head>

<body>
  <?php 
    session_start();
    require "connect_database.php";
    if ($conn->connect_error) 
    {
      die("Connection failed: " . $conn->connect_error);
    } 

    $mobile=$_POST["mno"];
    $pwd=$_POST["password"];
    $query1=mysqli_query($conn,"SELECT * FROM user_details WHERE user_details.mobile_number=$mobile ") or die(mysql_error());
    $query = mysqli_query($conn,"SELECT * FROM user_details WHERE user_details.mobile_number=$mobile AND user_details.password='".$pwd."' ") or die(mysql_error());
    if(mysqli_num_rows($query) == 0)
    {
      if(mysqli_num_rows($query1) > 0)
      {
          echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>You have entered wrong password</strong> <i class=\"far fa-frown\"></i>.
                      <a href=\"http://localhost/railway/signin.html\" class=\"text-danger font-weight-bold\" style=\"color:blue;\">
                        Go to User login page
                      </a>
                  </div>
                  <div class=\"text-center\">
                    <a class=\"font-weight-bold text-dark\"href=\"http://localhost/railway/index.html\"> 
                      <strong><i class='fa fa-home'></i> Go to home page</strong>
                    </a>
                  </div>
          ";
      }
      else
      {
        echo "
                  <div class=\"alert alert-danger alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>User does not Exist</strong> <i class=\"far fa-frown\"></i>. If you are new user 
                      <a href=\"http://localhost/railway/signup.html\" class=\"text-danger font-weight-bold\" style=\"color:blue;\">
                       Signup Here
                      </a>
                  </div>
                  <div class=\"text-center\">
                    <a class=\"font-weight-bold text-dark\"href=\"http://localhost/railway/index.html\"> 
                      <strong><i class='fa fa-home'></i> Go to home page</strong>
                    </a>
                  </div>
          ";
      }
      die();
    }

    if($row = mysqli_fetch_array($query))
    {
    	//$temp1;//$temp2;
    	//echo "Welcome ";
    	$temp1=$row['emailid'];
    	$temp2=$row['user_id'];
      $temp3=$row['fname'];
      $temp4=$row['lname'];
      $_SESSION["id"]=$temp2;
    	echo "<div class=\"container-fluid\" style=\"margin-top:20px;margin-left:-5px; margin-bottom:4%;\">Welcome <strong>$temp3 $temp4</strong>,</div>";

    	$query2 = mysqli_query($conn," SELECT * from user_details,reservation where user_details.user_id=reservation.user_id AND  user_details.mobile_number=$mobile ") or die(mysql_error());
    	if(mysqli_num_rows($query2) == 0)
    	{
    		echo "
              <div class=\"alert alert-danger alert-dismissible\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                  </button>
                  <strong>No Ticket booked from this account </strong> <i class=\"far fa-frown\"></i>.
              </div>
              <div class=\"text-center\">
                <a class=\"font-weight-bold text-dark\"href=\"http://localhost/railway/index.html\"> 
                  <strong><i class='fa fa-home'></i> Go to home page</strong>
                </a>
              </div>
            ";

      		die();
    	}
    	else
    	{
    		echo "
                <div class=\"container-sm\">
                    <div class=\"table table-responsive\">
                      <div class=\"table-wrapper\">
                        <div class=\"table-title\">
                          <div class=\"row\">
                            <div class=\"col-xs-6\">
                              <h2>Booked Ticket Details</h2>
                            </div>
                           </div>
                        </div>
                        <table class=\"table table-striped table-hover text-center table-bordered\">
                        <thead>
                          <tr>
                            <th class=\"text-center\">PNR Number</th>
                            <th class=\"text-center\">Train Number</th>
                            <th class=\"text-center\">Journey Date</th>
                            <th class=\"text-center\">Journey Fare</th>
                            <th class=\"text-center\">Ticket Class</th>
                            <th class=\"text-center\">Nummber Of Seats</th>
                            <th class=\"text-center\">Ticket Status</th>
                          </tr>
                        </thead>
                        <tbody>
        ";

      	while($row = mysqli_fetch_array($query2))
      	{
        		echo "
                  <tr>
                    <td>".$row["pnr_number"]."</td>
                    <td>".$row["train_number"]."</td>
                    <td>".$row["journey_date"]."</td>
                    <td>".$row["ticket_fare1"]."</td>
                    <td>".$row["class_name"]."</td>
                    <td>".$row["number_of_seats"]."</td>
                    <td>".$row["ticket_status"]."</td>
                  </tr>
            ";
      	}
      	echo "
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <br>
              <span>
                <form action=\"http://localhost/railway/cancel_ticket.php\" method=\"post\">
                  <b>Enter PNR number for Cancellation :</b>
                  <input type=\"text\" name=\"cancpnr\" onkeypress=\"return onlyNumberKey(event)\" placeholder=\" Enter PNR Number\" style=\" padding-left:5px;margin-right:30px;width: 30%; height:35px; border-radius: 5px; border:1px solid #435d7d;\" class=\"pr-3 pb-1 pt-1 mr-3\" required>
                  <input type=\"submit\" class=\"btn btn-danger text-dark\" value=\"Cancel Ticket\">
                </form>
              </span>
        ";
    	}
 	}
    
  ?>




<div class="text-center" style="margin: 15px;">
    <a href="http://localhost/railway/signin.html" style="margin-right:6%"class=" text-dark font-weight-bold">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
    </a>
    <a class="font-weight-bold text-dark"href="http://localhost/railway/index.html"> 
    	<strong><i class='fa fa-home'></i> Go to home page</strong>
    </a>
</div>
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
