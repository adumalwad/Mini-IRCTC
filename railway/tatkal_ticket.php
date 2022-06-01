<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tatkal Ticket</title>
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

  <script type="text/javascript">
      
    $(document).ready(function() {
    $(".select-swap").on('click', function (ev) {
        swaper();
    });
});

function swaper () {
    var co=$(".sw1").val();
    $(".sw1").val($(".sw2").val());
    $(".sw2").val(co);
}
  </script>

</head>

<body style="background-image: url(images/irctc.jpg);background-repeat: no-repeat;background-size: cover;background-attachment: fixed;">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Mini IRCTC</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="nav-item">
              <?php
                  session_start();
                  //echo " ".$_SESSION["mobile_number"]." ".$_SESSION["password"]." ";
                  echo"
                      <a class=\"nav-link\" href=\"http://localhost/railway/booking_history_1.php?mno=".$_SESSION["mobile_number"]."&password=".$_SESSION["password"]." \"><i class=\"fa fa-home\"></i></a>
                          ";
             ?>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/railway/book_ticket_1.php"><b>Book Ticket</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/railway/cancel_ticket_1.php"><b>Cancel Ticket</b></a>
          </li>
          <li class="active">
            <a class="nav-link" href="#"><b>Tatkal Ticket</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/railway/user_booking_history_1.php"><b>Booking History</b></a>
          </li>
        </ul>
              
        <ul class="nav navbar-nav navbar-right" style="background-color: red; color: white;">
          <li>
            <a href="http://localhost/railway/index.html" style="color:white;"><span class="glyphicon glyphicon-log-in"></span> <b>Logout</b> </a></li>
        </ul>
    </div>
  </nav>
  </div>
  <div class="login-form">
    <form action="http://localhost/railway/tatkal_booking_result.php" method="post">
        <div class="avatar">
          <i class="fa fa-train"></i>
        </div>
        <h2 class="text-center">Search Train</h2>

        <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>
              <select class="form-control sw1" name="sp"required="required">
                <?php
                    //session_start();
                    //echo "".$_SESSION["mobile_number"]."<br> ".$_SESSION["password"]." ";
                   require "connect_database.php";
                    if ($conn->connect_error) 
                    {
                      die("Connection failed: " . $conn->connect_error);
                    }      
                    $cdquery="SELECT station_name FROM station_details";
                    $cdresult=mysqli_query($conn,$cdquery);
                    echo " <option value = \"\" selected disabled>------- Select Starting Point -------
                          </option>
                    ";

                    while ($cdrow=mysqli_fetch_array($cdresult))
                    {
                      $cdTitle=$cdrow['station_name'];
                      echo " <option value = \"$cdTitle\" >$cdTitle </option>";
                    }
                ?>
              </select>
          </div>
        </div>
        <div class="form-group text-center">
            <a href="#" class="select-swap"><i class="glyphicon glyphicon-sort" ></i></a>
        </div>
        <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon"><i style="font-size: 24px;width: 15px;" class="fa fa-map-marker"></i></span>
              <select class="form-control sw2" name="dp" required="required">
                <?php
                  //session_start();
                   require "connect_database.php";
                    if ($conn->connect_error) 
                    {
                      die("Connection failed: " . $conn->connect_error);
                    }      
                    $cdquery="SELECT station_name FROM station_details";
                    $cdresult=mysqli_query($conn,$cdquery);
                    echo " <option value = \"\" selected disabled>------- Select Destination Point -------
                          </option>
                    ";

                    while ($cdrow=mysqli_fetch_array($cdresult))
                    {
                      $cdTitle=$cdrow['station_name'];
                      echo " <option value = \"$cdTitle\" >$cdTitle </option>";
                    }
                ?>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="date" id="jd1" class="form-control" name="doj"required="required">
              <script type="text/javascript">
                  var today = new Date();
                  var dd = today.getDate();
                  var mm = today.getMonth()+1;
                  var yyyy = today.getFullYear();
                  if(dd<10)
                  {
                    dd='0'+dd
                  } 
                  if(mm<10)
                  {
                     mm='0'+mm
                  } 
                  today = yyyy+'-'+mm+'-'+dd;
                  document.getElementById("jd1").setAttribute("min", today);
              </script>
          </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary login-btn" name="submit" style="margin-right: 7%;">Find Trains</button>
            <button type="reset" class="btn btn-primary login-btn" style="margin-left:7%;">Reset</button>
        </div>
    </form>
</body>
</html>