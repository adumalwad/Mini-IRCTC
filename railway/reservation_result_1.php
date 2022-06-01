<html>
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
<link rel="stylesheet" type="text/css" href="new.css">
<style type="text/css">
    table, th, td,tr {
  border: 1px solid black;border-collapse: collapse;
}
</style>
</head>
<body>

    <?php 
        session_start();
        require "connect_database.php";

        $pname=$_POST["pname"];
        $page=$_POST["page"];
        $pgender=$_POST["pgender"];
        $tno=$_SESSION["tno"];
        $doj=$_SESSION["doj"];
        $sp=$_SESSION["sp"];
        $dp=$_SESSION["dp"];
        $class1=$_SESSION["class"];
        $coach;
        /*if($class1=='1A') {$coach='H1';}
        else if($class1=='2A'){$coach='A1';}
        else if($class1=='3A'){$coach='B1';}
        else if($class1=='CC'){$coach='C1';}
        else if($class1=='2S'){$coach='D1';}
        else if($class1=='SL'){$coach='S1';}*/

        $coach_A1= array('H1','H2','H3','H4','H5','H6','H7','H8','H9','H10');
        $coach_A2= array('A1','A2','A3','A4','A5','A6','A7','A8','A9','A10');
        $coach_A3= array('B1','B2','B3','B4','B5','B6','B7','B8','B9','B10','B11','B12','B13','B14','B15','B16');
        $coach_CC= array('C1','C2','C3','C4','C5','C6','C7','C8','C9','C10','C11','C12','C13','C14','C15','C16');
        $coach_2S= array('D1','D2','D3','D4','D5','D6','D7','D8','D9','D10','D11','D12','D13','D14','D15','D16');
        $coach_SL= array('S1','S2','S3','S4','S5','S6','S7','S8','S9','S10','S11','S12','S13','S14','S15','S16');
        $query=" SELECT ticket_fare1,booked_seats FROM classseats WHERE train_number='".$tno."' AND class_name='".$class1."' AND journey_date='".$doj."' AND start_point='".$sp."' AND destination_point='".$dp."'  ";
        $result=mysqli_query($conn,$query) or die(mysql_error());

        $row=mysqli_fetch_array($result);
        $fare=$row[0];
        $seat_number11=$row[1];
        $A1 = array("UPPER BERTH","LOWER BERTH","UPPER BERTH","LOWER BERTH");
        $A2 = array("SIDE UPPER","LOWER BERTH","UPPER BERTH","LOWER BERTH","UPPER BERTH","SIDE LOWER");
        $A3 = array("SIDE UPPER","LOWER BERTH","MIDDLE BERTH","UPPER BERTH","LOWER BERTH","MIDDLE BERTH","UPPER BERTH","SIDE LOWER");
        $C2 = array("WINDOW SEAT","WINDOW SEAT","MIDDLE SEAT","SIDE SEAT","SIDE SEAT","MIDDLE SEAT");
        $C1= array("WINDOW SEAT","WINDOW SEAT","MIDDLE SEAT","SIDE SEAT","SIDE SEAT");

        $tempfare=0;
        $temp=0;
        $temp1=0;
        for($i=0;$i<$_SESSION["nos"];$i++) 
        {
            if( ($page[$i]>12) && ($page[$i] <60))
            {
                $temp++;
                $tempfare+=$fare;
            }
            else
            {
                if($page[$i]<=12)
                {
                    $temp1++;
                }
                $tempfare+=0.5*$fare;            
            }
        }
        //echo "   $tempfare";
        if(($temp==0) && ($temp1!=0))
        {
            echo"
                    <div class=\"alert alert-sm alert-danger alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                        <strong>Kids (Below 13 years) not allowed to travel without adult</strong> <i class=\"fa fa-frown-o\"></i>.
                        <a href=\"http://localhost/railway/book_ticket1.php\" class=\"text-danger font-weight-bold\" style=\"color:blue;\">
                            Go To booking page
                        </a>
                    </div>
            ";
            die();
        }
        echo"
                <div class=\"alert alert-sm alert-info alert-dismissible\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                    </button>
                     Your Total Fare for Journey is Rs ".$tempfare."
                </div>
        ";
        $sql = "INSERT INTO reservation(user_id,train_number,start_point,destination_point,journey_date,ticket_fare1,class_name,number_of_seats) VALUES ('".$_SESSION["id"]."','".$_SESSION["tno"]."','".$_SESSION["sp"]."','".$_SESSION["dp"]."','".$_SESSION["doj"]."','".$tempfare."','".$_SESSION["class"]."','".$_SESSION["nos"]."' )";

        if ($conn->query($sql) === TRUE) 
        {
            echo "
                <div class=\"alert alert-sm alert-success alert-dismissible\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                    </button>
                    You have succefully booked ticket.Ticket details have been sent to registered email address.
                </div>
            ";
        } 
        else 
        {
            echo "
                <div class=\"alert alert-sm alert-danger alert-dismissible\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                    </button>
                        Unable to book ticket.
                </div>
            ";
            echo "<br><br>Error: " . $conn->error;
        }

        $tid=$_SESSION["id"];
        $ttno=$_SESSION["tno"];
        $tdoj=$_SESSION["doj"];

        $query=" SELECT max(pnr_number) as pnr_number from reservation ";
        $result=mysqli_query($conn,$query) or die(mysql_error());


        $row=mysqli_fetch_array($result);
        $rpnr=$row['pnr_number'];


        $tpname=$_POST['pname'];
        $tpage=$_POST["page"];
        $tpgender=$_POST["pgender"];

        for($i=0;$i<$_SESSION["nos"];$i++) 
        {
            $berth11;
            $coach11;
            if($class1=='1A')     {$berth11=$A1[($seat_number11+1)%4]; $coach11=$coach_A1[($seat_number11+1)/36];}
            else if($class1=='2A'){$berth11=$A2[($seat_number11+1)%6]; $coach11=$coach_A2[($seat_number11+1)/54];}
            else if($class1=='3A'){$berth11=$A3[($seat_number11+1)%8]; $coach11=$coach_A3[($seat_number11+1)/72];}
            else if($class1=='SL'){$berth11=$A3[($seat_number11+1)%8]; $coach11=$coach_SL[($seat_number11+1)/72];}
            else if($class1=='CC'){$berth11=$C1[($seat_number11+1)%5];$coach11=$coach_CC[($seat_number11+1)/120];}
            else if($class1=='2S'){$berth11=$C2[($seat_number11+1)%6];$coach11=$coach_2S[($seat_number11+1)/120];}
            $sql = "INSERT INTO passenger_details(pnr_number,passenger_name,passenger_age,passenger_gender,ticket_coach,seat_number,berth) VALUES  ('".$rpnr."','".$tpname[$i]."','".$tpage[$i]."','".$tpgender[$i]."','".$coach11."','".($seat_number11+1)."','".$berth11."')";

            if ($conn->query($sql) === TRUE) 
            {
               echo "
                    <div class=\"alert alert-sm alert-success alert-dismissible\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                        </button>
                            <strong>".$tpname[$i]." </strong> ticket has been booked.
                    </div>
                ";
            } 
            else 
            {
                echo "<br><br>Error: " . $conn->error;
            }
            $seat_number11+=1;
        }
        $cdquery11="SELECT * FROM train_schedule where train_number='".$ttno."' ORDER BY distance ASC  ";
        $cdresult11=mysqli_query($conn,$cdquery11);
        $stations11=array();
        $xy=0;
        while($cdrow11=mysqli_fetch_array($cdresult11)) {$stations11[$xy]=$cdrow11["station_name"];$xy+=1;}
        $stations_count= $xy-1;
        $z=0;
        while($stations11[$z]!=$sp)
        {$z=$z+1;}
        $nos=$_SESSION["nos"];
        $p1=0;
        while ($stations11[$p1]!=$dp) 
        {
            $y=$z+1;
            while($y < $stations_count +1 )
            {
                
                $cdquery21="UPDATE classseats SET available_seats=available_seats-'".$nos."' where train_number='".$ttno."' AND class_name='".$class1."' AND journey_date='".$tdoj."' AND start_point='".$stations11[$p1]."' AND destination_point='".$stations11[$y]."'";
                $cdresult21=mysqli_query($conn,$cdquery21);

                $cdquery22="UPDATE classseats SET booked_seats=booked_seats+'".$nos."' where train_number=".$ttno." AND class_name='".$class1."' AND journey_date='".$tdoj."' AND start_point='".$stations11[$p1]."' AND destination_point='".$stations11[$y]."'";
                $cdresult22=mysqli_query($conn,$cdquery22);
                $y=$y+1;
            }
            $p1=$p1+1;
        }
        $seat11=$_SESSION["nos"];
        $query=" SELECT * FROM user_details WHERE user_id='".$_SESSION["id"]."' ";
        $result=mysqli_query($conn,$query) or die(mysql_error());
        $row=mysqli_fetch_array($result);
        $fname=$row[1];
        $lname=$row[2];
        $eid=$row[3];
        $subject = "Ticket Booking Confirmation on Mini IRCTC";

        $sender = "From: MINI IRCTC <ramdumalwad@gmail.com>\r\n";
        $sender .= "MIME-Version: 1.0\r\n";
        $sender .="Content-Type: text/html; charset=ISO-8859-1\r\n";
        $message = "   <html>
                <body>
                    <h1 style=\"color:green;text-align:center\">Ticket Booking Details</h1>
                    <p>Hi <b>$fname $lname</b>,<br>
                        You have successfully booked ticket on Mini IRCTC.Ticket details are given below:<br>
                        <br>
                        <b>PNR Number:</b><span style=\"margin-right:2px;\"></span> $rpnr<br>
                        <b>Train Number:</b><span style=\"margin-right:2px;\"></span> $tno<br>
                        <b>Start Point:</b><span style=\"margin-right:2px;\"></span> $sp<br>
                        <b>Destination Point:</b><span style=\"margin-right:2px;\"></span> $dp<br>
                        <b>Journey Date:</b><span style=\"margin-right:2px;\"></span> $doj<br>
                        <b>Ticket Quota:</b><span style=\"margin-right:2px;\"></span> General<br>
                        <b>Ticket Class:</b><span style=\"margin-right:2px;\"></span> $class1<br>
                        <b> Number Of Seats:</b><span style=\"margin-right:2px;\"></span> $seat11<br>
                        <b>Total Journey Fare:</b><span style=\"margin-right:2px;\"></span> $tempfare
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
        $query123=" SELECT * FROM passenger_details WHERE pnr_number='".$rpnr."' ";
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
                            <p style=\"color:red\">Remember,if you cancel Ticket within 10 days before the scheduled departure of the train, cancellation charges shall be 50%.Otherewise refund amount will be 100%.</p>
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
 <?php

        
        echo"
                <a  href=\"http://localhost/railway/booking_history_1.php?mno=".$_SESSION["mobile_number"]."&password=".$_SESSION["password"]." \"><button class=\"btn-primary\"><i class=\"fa fa-home\"></i> Home Page</button></a>
        ";
?>
</body>
</html>
