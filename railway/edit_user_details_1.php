<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit User Details</title>
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
		padding-right: 50px;
		padding-top: 20px;
		padding-bottom: 20px;
		
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
		if(!isset($_POST["submit"]))
		{ 

			$cdquery="SELECT * FROM user_details WHERE user_id='".$_GET["id"]."'";
			$cdresult=mysqli_query($conn,$cdquery);
			$cdrow=mysqli_fetch_array($cdresult);

			echo "
				<div class=\"container-sm\">
					<div class=\"table table-responsive\">
						<div class=\"table-wrapper\">
							<div class=\"table-title\">
								<div class=\"row\">
									<div class=\"col-xs-6\">
										<h2>User Details</h2>
									</div>
								</div>
							</div>
							<table class=\"table table-striped table-hover text-center table-bordered\">
								<thead>
									<th style=\"text-align:center;\">User Id</th>
									<th style=\"text-align:center;\">First Name</th>
									<th style=\"text-align:center;\">Last Name</th>
									<th style=\"text-align:center;\">Email Id</th>
									<th style=\"text-align:center;\">Password</th>
									<th style=\"text-align:center;\">Mobile Number</th>
									<th style=\"text-align:center;\">Date Of Birth</th>
									<th style=\"text-align:center;\">Gender</th>
								</thead>
							<tbody>
			";

			echo "
								<tr>
									<td style=\"text-align:center;\">".$cdrow["user_id"]."</td>
									<form action=\"edit_user_details_1.php?id=".$_GET["id"]."\" method=\"post\">

									<td style=\"text-align:center;\"><input style=\"text-align:center;\"type=\"text\" name=\"fname\" value=\"".$cdrow["fname"]."\" required></td>
									<td style=\"text-align:center;\"><input style=\"text-align:center;\"type=\"text\" name=\"lname\" value=\"".$cdrow["lname"]."\" required></td>
									<td style=\"text-align:center;\"><input style=\"text-align:center;\"type=\"email\" name=\"emailid\" value=\"".$cdrow["emailid"]."\" required readonly></td>
									<td style=\"text-align:center;\"><input type=\"text\" style=\"text-align:center;\" name=\"password\" value=\"".$cdrow["password"]."\" required></td>
									<td style=\"text-align:center;\"><input placeholder=\"10 digit mobile number\"type=\"text\" style=\"text-align:center;\"pattern=\"[0-9]{10}\" onkeypress=\"return onlyNumberKey(event)\" name=\"mobileno\" value=\"".$cdrow["mobile_number"]."\" required></td>
									<td style=\"text-align:center;\"><input type=\"date\" style=\"text-align:center;\" name=\"dob\" value=\"".$cdrow["dob"]."\" required></td>
									<td style=\"text-align:center;\">
										<select style=\"text-align:center;\" name=\"gender\" required=\"required\">
											<option value = \"\" selected disabled>Select Gender </option>
											<option value=\"M\">Male</option>
											<option value=\"F\">Female</option>
											<option value=\"O\">Other</option>
										</select>
									</td>
								</tr>
			";
			echo "
							</tbody>
							</table>

							<input class=\"btn btn-success text-dark text-center\"value='Update Record' type=\"submit\" name=\"submit\">
							</form>
						</div>
					</div>
				</div>
			";
		}
		else
		{
			$mno=$_POST["mobileno"];
			$dob=$_POST["dob"];
        	$mobile_check = "SELECT * FROM user_details WHERE mobile_number = '$mno' and user_id!='".$_SESSION["id"]."'";
        	$res1 = mysqli_query($conn, $mobile_check);
        	if(mysqli_num_rows($res1) > 0)
        	{
            	echo "
                  		<div class=\"alert alert-danger alert-dismissible\">
                      		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                      		</button>
                      		<strong>Mobile Number is already registered on website.Please use another mobile number</strong> <i class=\"fa fa-frown\"></i>.
                  </div>
                  <div class=\"text-center\">
                    <br>
                    <div class=\"text-center mt-3\">
                        <div class=\"text-center mt-3\">
                        		<a style=\"margin-right:3%;\"class=\"text-dark font-weight-bold\" href=\"http://localhost/railway/booking_history_1.php?mno=".$_SESSION["mobile_number"]."&password=".$_SESSION["password"]." \">
                            		<button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                        		</a>
                    	</div>
                    </div>
                </div>
          ";
          die();
        }
	        $diff1 = abs(strtotime($_POST["dob"])-strtotime(date("Y-m-d")));
    	    $years = floor($diff1 / (365*60*60*24));
        	if($years < 18)
	        {
    	         echo "
        	        	<div class=\"alert alert-danger alert-dismissible\">
            	        	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
                	    	</button>
                    		<strong>Your age is below 18 years. </strong> <i class=\"fa fa-frown\"></i>.
	                  	</div>
                  		<div class=\"text-center\">
                    		<br>
                    		<div class=\"text-center mt-3\">
                        		<a style=\"margin-right:3%;\"class=\"text-dark font-weight-bold\" href=\"http://localhost/railway/booking_history_1.php?mno=".$_SESSION["mobile_number"]."&password=".$_SESSION["password"]." \">
                            		<button class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Back </button>
                        		</a>
                    		</div>
                		</div>
          		";
          		die();
        	}
			$sql = "UPDATE `user_details` SET `fname`='".$_POST["fname"]."',`lname`='".$_POST["lname"]."',`emailid`='".$_POST["emailid"]."',`password`='".$_POST["password"]."',`mobile_number`='".$_POST["mobileno"]."',`dob`='".$_POST["dob"]."',`gender`='".$_POST["gender"]."' WHERE user_id='".$_GET["id"]."'";

			if ($conn->query($sql) === TRUE) 
			{
    			echo"
					<div class=\"alert alert-success alert-dismissible\">
  							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
  							</button>
	  						 <strong>Data has been successfully modified in record <i class=\"far fa-smile\"></i> .<strong>
					</div>
					<a href=\"http://localhost/railway/index.html\" class=\" text-center text-dark font-weight-bold\">
            			<button class=\"btn btn-danger text-dark p-2\" style=\"margin-left: 20px;\"> 
               				<span style=\"margin-right:7px;\">Logout</span><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> 
           				</button>
        			</a>
				";
			}
			else 
			{
	    		echo "Error:" . $conn->error;
			}
		}

		$conn->close();
		die();
	?>
    
    <div class="text-center mt-3" style="font-size: 15px;">
    	 <?php
                  //echo " ".$_SESSION["mobile_number"]." ".$_SESSION["password"]." ";
            echo"
                	<a style=\"margin-right:3%;\"class=\"text-dark font-weight-bold\" href=\"http://localhost/railway/booking_history_1.php?mno=".$_SESSION["mobile_number"]."&password=".$_SESSION["password"]." \"><i class=\"fa fa-arrow-left\"></i> Back</a>
            ";
        ?>

        <a style="margin-left:3%;" class=" text-dark font-weight-bold"href="http://localhost/railway/index.html">
            <i class="glyphicon glyphicon-home"></i> Home Page
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
