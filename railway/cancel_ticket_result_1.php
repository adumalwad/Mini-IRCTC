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
    $refund=0;
    $quota;
    $pnr_number=$_GET["cancpnr"];
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
                  <div class=\"text-center\">
                    <br>
                    <div class=\"text-center mt-3\">

                        <a href=\"http://localhost/railway/cancel_ticket_1.php\">
                            <button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                        </a>
                    </div>
                  </div>
                ";
                die();
        }
        else
        {
            echo "
                  <div class=\"alert alert-success alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>You have successfully Cancelled Your Ticket. Ticket details have been sent to <b>".$_SESSION["emailid11"]."</b>  <i class=\"fa fa-smile-o\"></i>.
                  </div>
                ";
            $query3 = mysqli_query($conn,"SELECT * FROM cancel_ticket WHERE cancel_ticket.pnr_number='".$pnr_number."' ") or die(mysql_error());
            while ($row121=mysqli_fetch_array($query3))
            {
                $refund=$row121["ticket_fare"];
                echo "
                  <div class=\"alert alert-success alert-dismissible\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      </button>
                      <strong>Your refund amont is Rs. ".$row121["ticket_fare"]." <i class=\"far fa-smile\"></i>.
                  </div>
                  <div class=\"text-center\">
                    <br>
                    <div class=\"text-center mt-3\">

                        <a href=\"http://localhost/railway/cancel_ticket_1.php\">
                            <button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                        </a>
                    </div>
                  </div>
                ";
             }
        }
    } 
    else 
    {
        echo "<br><br>Error:" . $conn->error;
    }

    $cdquery11="SELECT * FROM reservation where pnr_number='".$pnr_number."' ";
    $cdresult11=mysqli_query($conn,$cdquery11);
    $cdrow11=mysqli_fetch_array($cdresult11);
    $quota=$cdrow11['quota'];

    $cdquery21="SELECT * FROM train_schedule where train_number='".$cdrow11['train_number']."' ORDER BY distance ASC  ";
    $cdresult21=mysqli_query($conn,$cdquery21);
    $stations11=array();
    $xy=0;
    while($cdrow21=mysqli_fetch_array($cdresult21)) {$stations11[$xy]=$cdrow21["station_name"];$xy+=1;}
    $stations_count= $xy-1;
    $z=0;
    $nos=$cdrow11['number_of_seats'];

    while($stations11[$z]!=$cdrow11['start_point'])
    {$z=$z+1;}
    $p1=0;
    while ( $stations11[$p1]!=$cdrow11['destination_point'] ) 
    {
        $y=$z+1;
        while($y < $stations_count +1 )
        {
            if($quota=='TATKAL')
            {
                $cdquery21="UPDATE tatkal_seats SET available_seats=available_seats+'".$nos."' where train_number='".$cdrow11['train_number']."' AND class_name='".$cdrow11['class_name']."' AND journey_date='".$cdrow11['journey_date']."' AND start_point='".$stations11[$p1]."' AND destination_point='".$stations11[$y]."'";
            }
            else
            {
                $cdquery21="UPDATE classseats SET available_seats=available_seats+'".$nos."' where train_number='".$cdrow11['train_number']."' AND class_name='".$cdrow11['class_name']."' AND journey_date='".$cdrow11['journey_date']."' AND start_point='".$stations11[$p1]."' AND destination_point='".$stations11[$y]."'";
            }
            $cdresult21=mysqli_query($conn,$cdquery21);
            $y=$y+1;
        }
        $p1=$p1+1;
    }
    $cdquery1="SELECT * FROM cancel_ticket WHERE pnr_number='".$cdrow11['pnr_number']."'";
    $cdresult1=mysqli_query($conn,$cdquery1);
    $cdrow1=mysqli_fetch_array($cdresult1);
    $seat11=$_SESSION["nos"];
    $query=" SELECT * FROM user_details WHERE user_id='".$_SESSION["id"]."' ";
    $result=mysqli_query($conn,$query) or die(mysql_error());
    $row=mysqli_fetch_array($result);
    $fname=$row[1];
    $lname=$row[2];
    $eid=$row[3];
        $subject = "Ticket Cancellation on Mini IRCTC";

        $sender = "From: MINI IRCTC <ramdumalwad@gmail.com>\r\n";
        $sender .= "MIME-Version: 1.0\r\n";
        $sender .="Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = "   <html>
                <body>
                    <h1 style=\"color:green;text-align:center\">Ticket Cancellation Details</h1>
                    <p>Hi <b>$fname $lname</b>,<br>
                        You have successfully cancelled ticket on Mini IRCTC.Ticket details are given below:<br>
                        <br>
                        <b>PNR Number:</b><span style=\"margin-right:2px;\"></span> ".$cdrow11['pnr_number']."<br>
                        <b>Train Number:</b><span style=\"margin-right:2px;\"></span> ".$cdrow11['train_number']."<br>
                        <b>Start Point:</b><span style=\"margin-right:2px;\"></span> ".$cdrow11['start_point']."<br>
                        <b>Destination Point:</b><span style=\"margin-right:2px;\"></span> ".$cdrow11['destination_point']."<br>
                        <b>Journey Date:</b><span style=\"margin-right:2px;\"></span> ".$cdrow11['journey_date']."<br>
                        <b>Ticket Class:</b><span style=\"margin-right:2px;\"></span> ".$cdrow11['class_name']."<br>
                        <b> Number Of Seats:</b><span style=\"margin-right:2px;\"></span> ".$cdrow11['number_of_seats']."<br>
                        <b>Total Journey Fare:</b><span style=\"margin-right:2px;\"></span>". $cdrow11['ticket_fare1']."<br>
                        <b>Refund Amount:</b><span style=\"margin-right:2px;\"></span> $refund
                        <h2 style=\"color:#24a3ed;\">Passenger Details</h2>
                        <table style=\"margin-top:10px;border: 1px solid black;border-collapse: collapse;\">
                            <thead style=\"background-color:#c9e3f2;border: 1px solid black;border-collapse: collapse;\">
                                <tr>
                                    <th style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">Sr. No.</th>
                                    <th style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">Name</th>
                                    <th style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">Age</th>
                                    <th style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">Gender</th>
                                    <th style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">Coach</th>
                                    <th style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">Seat</th>
                                    <th style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">Berth</th>
                                </tr>
                            </thead>
                            <tbody>
        ";
        $query123=" SELECT * FROM passenger_details WHERE pnr_number='".$pnr_number."' ";
        $result123=mysqli_query($conn,$query123) or die(mysql_error());
        $xy=1;
        while($row = mysqli_fetch_array($result123))
        {
            $message .= "
                                <tr style=\"text-align:center;\">
                                    <td style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">".$xy."</td>
                                    <td style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">".$row[1]."</td>
                                    <td style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">".$row[2]."</td>
                                    <td style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">".$row[3]."</td>
                                    <td style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">".$row[4]."</td>
                                    <td style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">".$row[5]."</td>
                                    <td style=\"padding:2px;text-align:center;border: 1px solid black;border-collapse: collapse;\">".$row[6]."</td>
                                </tr>
            ";
            $xy+=1;
        }
      
        $message .="
                            </tbody>
                        </table>
                        <div style=\"margin-top:10px;\">
                            <p style=\"color:red\"><b>Ticket Cancellation Charges:</b></p>
                            <ol>
                                <li>If you cancel ticket within 2 days before the scheduled departure of the train, <b>cancellation charges shall be 50%.</b></li>
                                <li>If you cancel ticket within 3 to 10 days before the scheduled departure of the train, <b>cancellation charges shall be 20%.</b></li>
                                <li>Otherwise, <b>no cancellation charges.</b>
                            </ol>
                            <br>
                            We are here to help if you need it.If you face any issue, try to contact our team.Team details are available on website.
                        </div>
                        <br><br><br>
                        - MINI IRCTC Team
                    </p>
                </body>
            </html>
        ";
        mail($eid, $subject, $message, $sender);
    $conn->close(); 
  ?>
</body>
</html>
