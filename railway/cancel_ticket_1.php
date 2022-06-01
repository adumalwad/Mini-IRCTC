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
  #myInput {
      border-radius: 20px;
      color: black;
      font-size: 15px;
      padding: 10px 5px 10px 15px;
      margin-bottom: 10px;
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
    //echo "".$_SESSION["mobile_number"]."<br> ".$_SESSION["password"]." ";
    echo"
        <nav class=\"navbar navbar-inverse\">
              <div class=\"container-fluid\">
                <div class=\"navbar-header\">
                  <a class=\"navbar-brand\" href=\"#\">Mini IRCTC</a>
                </div>
                <ul class=\"nav navbar-nav\">
                  <li class=\"nav-item\">
                      <a class=\"nav-link\" href=\"http://localhost/railway/booking_history_1.php?mno=".$_SESSION["mobile_number"]."&password=".$_SESSION["password"]." \"><i class=\"fa fa-home\"></i></a>
                  </li>
                  <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"http://localhost/railway/book_ticket_1.php\"><b>Book Ticket</b></a>
                  </li>
                  <li class=\"active\">
                    <a class=\"nav-link\" href=\"#\"><b>Cancel Ticket</b></a>
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
                    <a href=\"http://localhost/railway/index.html\" style=\"color:white;\"><span class=\"glyphicon glyphicon-log-in\"></span> <b>Logout</b> </a>
                  </li>
                </ul>
          </div>
        </nav>
    ";
    $mobile=$_SESSION["mobile_number"];
    $pwd=$_SESSION["password"];
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
                      <strong>You have entered wrong password</strong> <i class=\"far fa-frown\"></i>.
                      <a href=\"http://localhost/railway/signin.html\" class=\"text-danger font-weight-bold\" style=\"color:blue;\">
                        Go to User login page
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
          ";
      }
      die();
    }

    if($row = mysqli_fetch_array($query))
    {
    	$temp1=$row['emailid'];
    	$temp2=$row['user_id'];
      $temp3=$row['fname'];
      $temp4=$row['lname'];
      $_SESSION["id"]=$temp2;
      //$query2 = mysqli_query($conn," SELECT * from user_details,reservation where user_details.user_id=reservation.user_id AND  user_details.mobile_number=BINARY $mobile AND reservation.ticket_status='BOOKED' and reservation.journey_date>=CURDATE() ORDER BY reservation.journey_date") or die(mysql_error());

    	$query2 = mysqli_query($conn," SELECT * from user_details,reservation where user_details.user_id=reservation.user_id AND  user_details.mobile_number=BINARY $mobile AND reservation.ticket_status='BOOKED' ORDER BY reservation.journey_date") or die(mysql_error());
    	if(mysqli_num_rows($query2) == 0)
    	{
    		echo "
              <div class=\"alert alert-danger alert-dismissible\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                  </button>
                  <strong>No Upcoming journey ticket booked from this account </strong> <i class=\"far fa-frown\"></i>.
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
                            <div class=\"col-xs-6\">
                              <input type=\"text\"  id=\"myInput\" style=\"width:60%;color: black;\" onkeyup=\"myFunction()\" placeholder=\"Search using PNR Number, Train Number, Journey Date\">
                            </div>
                          </div>
                        </div>
                        <table class=\"table table-striped table-hover text-center table-bordered\" id=\"myTable\">
                        <thead>
                          <tr>
                            <th class=\"text-center\">PNR Number</th>
                            <th class=\"text-center\">Train Number</th>
                            <th class=\"text-center\">Journey Date</th>
                            <th class=\"text-center\">Start Point</th>
                            <th class=\"text-center\">Destination Point</th>
                            <th class=\"text-center\">Ticket Class</th>
                            <th class=\"text-center\">Number Of Seats</th>
                            <th class=\"text-center\">Journey Fare</th>
                            <th class=\"text-center\">Quota</th>
                            <th class=\"text-center\">Ticket Status</th>
                            <th class=\"text-center\"></th>
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
                    <td>".$row["start_point"]."</td>
                    <td>".$row["destination_point"]."</td>
                    <td>".$row["class_name"]."</td>
                    <td>".$row["number_of_seats"]."</td>
                    <td>".$row["ticket_fare1"]."</td>
                    <td>".$row["quota"]."</td>
                    <td>".$row["ticket_status"]."</td>
                    <td>

                      <a href=\"http://localhost/railway/cancel_ticket_result_1.php?cancpnr=".$row["pnr_number"]."\">
                          <button class=\" btn btn-sm text-dark rounded btn-danger\">Cancel Ticket</button>
                      </a>
                    </td>
                  </tr>
            ";
      	}
      	echo "
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        ";
    	}
 	}
    
  ?>
<script>
    function myFunction()
    {
      var input, filter, table, tr, i, j, column_length, count_td;
        column_length = document.getElementById('myTable').rows[0].cells.length;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");
          for (i = 1; i < tr.length; i++) 
          {
            count_td = 0;
            for(j = 0; j < 3; j++)
            {
                td = tr[i].getElementsByTagName("td")[j];
                if (td)
                {
                    if ( td.innerHTML.toUpperCase().indexOf(filter) > -1) 
                    {            
                      count_td++;
                    }
                }
            }
            if(count_td > 0)
            {
                tr[i].style.display = "";
            }
            else
            {
                tr[i].style.display = "none";
            }
          }
      }
  </script>
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
