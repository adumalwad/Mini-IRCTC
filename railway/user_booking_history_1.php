<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Booked Tickets History</title>
<link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="new.css">
<style type="text/css">
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
    $mobile=$_SESSION["mobile_number"];
    $pwd=$_SESSION["password"];

    $query1=mysqli_query($conn,"SELECT * FROM user_details WHERE user_details.mobile_number=BINARY $mobile ") or die(mysql_error());
    $query = mysqli_query($conn,"SELECT * FROM user_details WHERE user_details.mobile_number=BINARY $mobile AND user_details.password='".$pwd."' ") or die(mysql_error());

    if($row = mysqli_fetch_array($query))
    {
      //$temp1;//$temp2;
      //echo "Welcome ";
      $temp1=$row['emailid'];
      $temp2=$row['user_id'];
      $temp3=$row['fname'];
      $temp4=$row['lname'];
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
                  <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"http://localhost/railway/cancel_ticket_1.php\"><b>Cancel Ticket</b></a>
                  </li>
                  <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"http://localhost/railway/tatkal_ticket.php\"><b>Tatkal Ticket</b></a>
                  </li>
                  <li class=\"active\">
                    <a class=\"nav-link\" href=\"#\"><b>Booking History</b></a>
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
      $_SESSION["id"]=$temp2;

      $query2 = mysqli_query($conn," SELECT * from user_details,reservation where user_details.user_id=reservation.user_id AND  user_details.mobile_number=BINARY $mobile ORDER BY reservation.journey_date ASC") or die(mysql_error());
      if(mysqli_num_rows($query2) == 0)
      {
        echo "
              <div class=\"alert alert-danger alert-dismissible\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                  </button>
                  <strong>No Ticket booked from this account </strong> <i class=\"far fa-frown\"></i>.
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
                              <h2>Booking History</h2>
                            </div>
                            <div class=\"col-xs-6\">
                              <input type=\"text\"  id=\"myInput\" style=\"width:60%;color: black;\" onkeyup=\"myFunction()\" placeholder=\"Search PNR Number, Train Number, Journey Date\">
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

                        <a href=\"http://localhost/railway/passenger_info.php?pnr_no=".$row["pnr_number"]."\">
                          <button class=\" btn btn-sm text-dark rounded btn-info\">Passenger Details</button>
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
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
  </script>
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
</body>
</html>
