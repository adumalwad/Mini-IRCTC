<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ticket Booking</title>
  <link rel="icon" type="image/x-icon" href="images/IRCTC1.jpg">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<style type="text/css">
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
    padding-right: 50px;
    padding-top: 15px;
    padding-bottom: 15px;
    
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
    margin-left: 10px;
  }
  .table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
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
        margin: 0 5px;
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

        $mobile=$_SESSION["mobile_number"];
        $pwd=$_SESSION["password"];

        $query = mysqli_query($conn,"SELECT * FROM user_details WHERE user_details.mobile_number=$mobile AND user_details.password='".$pwd."' ") or die(mysql_error());
        if(mysqli_num_rows($query) == 0)
        {
            echo "
                    <div class=\"alert alert-sm alert-danger alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong>You have entered wrong mobile number or password</strong> <i class=\"fa fa-frown-o\"></i>.
                    </div>
                    <div class=\"text-center\">
                        <a href=\"http://localhost/railway/booking_result_11.php?doj=".$doj."&sp=".$_SESSION["sp"]."&dp=".$_SESSION["dp"]."\" class=\" text-dark font-weight-bold\">
                          <button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
                            <i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
                          </button>
                        </a>
        
                        <a href=\"http://localhost/railway/index.html\" class=\" text-dark font-weight-bold\">
                            <button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
                                <span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
                            </button>
                        </a>
                    </div>
            ";
            //$conn->close();
            die();
        }
        $row = mysqli_fetch_array($query);
        $temp=$row['user_id'];
        $doj= $_SESSION["doj"];
        $_SESSION["id"] = "$temp";
        $tno=$_POST["tno"];
        $_SESSION["tno"] = "$tno";
        $class=$_POST["class"];
        $_SESSION["class"] = "$class";
        $nos=$_POST["nos"];
        $_SESSION["nos"] = "$nos";
        $query2 = mysqli_query($conn,"SELECT available_seats FROM classseats WHERE classseats.journey_date= '$doj' AND classseats.train_number= $tno AND classseats.class_name= '$class' AND classseats.start_point= '".$_SESSION["sp"]."'  AND classseats.destination_point= '".$_SESSION["dp"]."'; ") or die(mysql_error());
        $row11=mysqli_fetch_array($query2);
        if(  $nos>=7 )
        {
            echo "
                    <div class=\"alert alert-sm alert-danger alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong>Maximum Six bookings allowed at a time.</strong> <i class=\"fa fa-frown-o\"></i>.
                    </div>
                    <div class=\"text-center\">
                        <a href=\"http://localhost/railway/booking_result_11.php?doj=".$doj."&sp=".$_SESSION["sp"]."&dp=".$_SESSION["dp"]."\" class=\" text-dark font-weight-bold\">
                          <button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
                            <i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
                          </button>
                        </a>
        
                        <a href=\"http://localhost/railway/index.html\" class=\" text-dark font-weight-bold\">
                            <button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
                                <span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
                            </button>
                        </a>
                    </div>
            ";
            //$conn->close();
            die();
        }
        if( (mysqli_num_rows($query2)> 0) && ($nos>=$row11[0]) )
        {
            echo "
                    <div class=\"alert alert-sm alert-danger alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong>Number of seats you are looking are not available at the moment.</strong> <i class=\"fa fa-frown-o\"></i>.
                    </div>
                    <div class=\"text-center\">
                        <a href=\"http://localhost/railway/booking_result_11.php?doj=".$doj."&sp=".$_SESSION["sp"]."&dp=".$_SESSION["dp"]."\" class=\" text-dark font-weight-bold\">
                          <button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
                            <i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
                          </button>
                        </a>
        
                        <a href=\"http://localhost/railway/index.html\" class=\" text-dark font-weight-bold\">
                            <button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
                                <span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
                            </button>
                        </a>
                    </div>
            ";
            die();
        }
        if(mysqli_num_rows($query2) == 0)
        {
            echo "
                    <div class=\"alert alert-sm alert-danger alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong>Selected Ticket Class is not present.</strong> <i class=\"fa fa-frown-o\"></i>.
                    </div>
                    <div class=\"text-center\">
                        <a href=\"http://localhost/railway/booking_result_11.php?doj=".$doj."&sp=".$_SESSION["sp"]."&dp=".$_SESSION["dp"]."\" class=\" text-dark font-weight-bold\">
                          <button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
                            <i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
                          </button>
                        </a>
        
                        <a href=\"http://localhost/railway/index.html\" class=\" text-dark font-weight-bold\">
                            <button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
                                <span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
                            </button>
                        </a>
                    </div>
            ";
            //$conn->close();
            die();
        }
        echo"
                <div class=\"container-sm\">
                    <form action=\"http://localhost/railway/reservation_result.php\" method=\"post\">
                        <div class=\"table table-responsive\">
                            <div class=\"table-wrapper\">
                                <div class=\"table-title\">
                                    <div class=\"row\">
                                        <div class=\"col-xs-6\">
                                            <h2>Passenger Details</h2>
                                        </div>
                                    </div>
                                </div>
                                <table class=\"table table-striped table-hover text-center table-bordered\">
                                    <thead>
                                        <tr>
                                            <th class=\"text-center\" style=\"width:33%;\">Passenger Name</th>
                                            <th class=\"text-center\" style=\"width:33%;\">Passenger Age</th>
                                            <th class=\"text-center\" style=\"width:34%;\">Passenger Gender</th>                   
                                        </tr>
                                    </thead>
                                    <tbody>
        ";

        for($i=0;$i<$nos;$i++) 
        {
            echo "
                                <tr>
                                    <td ><input style=\"padding:5px;\" type='text' name='pname[]' class=\"text-center\" placeholder=\"Enter Name\" required></td>
                                    <td><input style=\"padding:5px;\" type='number' min=\"1\" name='page[]' class=\"text-center\" placeholder=\"Enter Age\" onkeypress=\"return onlyNumberKey(event)\" required></td>
                                    <td>
                                        <select style=\"padding:5px; width:50%;\" name='pgender[]' class=\"text-center\" required>
                                            <option value=\"\" selected disabled>---- Select Gender ---- </option>
                                            <option value=\"M\"> Male </option>
                                            <option value=\"F\"> Female </option>
                                            <option value=\"O\"> Other </option>
                                    </td>
                                </tr>";
        }

        echo "
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class=\"text-center\" style=\"margin-top:-20px;\">
                            <input type=\"submit\" name=\"submit\" class=\" btn btn-primary\" style=\"margin-right: 4%;\" value=\"BOOK TICKET\">
                            <input type=\"reset\"  class=\" btn btn-danger\" style=\"margin-left: 4%;\" value=\"RESET\">
                        </div>
                    </form>
                </div>
                <div style=\"margin-left:20px;color: red;margin-top:30px;\">
                    <b>Important:</b>
                </div>
                <ol>
                        <li>Kids (Below 13 years) not allowed to travel without adult partner.</li> 
                        <li>Passenger below 13 years or above 60 years will have 50% concession on booking.</li>
                        <li>Passenger need to carry Aadhar Card with them (for identification & age proof).</li>
                        
                </ol>                
        ";

        $conn->close(); 
        
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
    <div class="text-center" style="margin-top:30px;">
        <?php
                echo"
                    <a href=\"http://localhost/railway/booking_result_11.php?doj=".$doj."&sp=".$_SESSION["sp"]."&dp=".$_SESSION["dp"]."\"  style=\" font-size:15px;margin-right:25px;margin-top:30px;\">
                        <button class=\"btn btn-primary\"> <i class=\"fa fa-arrow-left\"></i> Back</button>
                    </a>
                    <a style=\" font-size:15px;margin-left:25px;margin-top:30px;\" href=\"http://localhost/railway/booking_history_1.php?mno=".$_SESSION["mobile_number"]."&password=".$_SESSION["password"]." \">
                        <button class=\"btn btn-primary\"><i class=\"fa fa-home\"> Home Page</i></button>
                    </a>
                ";
        ?>
    </div>
</body>
</html>
