<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>All User Details</title>
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
		padding-left: 40px;
		padding-right: 50px;
		padding-top: 35px;
		padding-bottom: 25px;
		
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
                      		<a class=\"nav-link\" href=\"http://localhost/railway/admin_menu.php?username=".$_SESSION["username"]."&password=".$_SESSION["password1"]." \"><i class=\"fa fa-home\"></i></a>
                          ";
             		?>
             	</li>
				<li class="nav-item active">
					<a class="nav-link" href="#"><b>User Details</b></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://localhost/railway/train_details.php"><b>Train Details</b></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://localhost/railway/station_details.php"><b>Stations Details</b></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://localhost/railway/schedule_train.php"><b>Schedule Train</b></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://localhost/railway/add_train.php"><b>Add Train</b></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://localhost/railway/tickets_booked.php"><b>Booked Tickets</b></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="http://localhost/railway/tickets_cancelled.php"><b>Cancelled Tickets</b></a>
				</li>
           	</ul>
			<ul class="nav navbar-nav navbar-right" style="background-color: red; color: white;">
	            <li>
    	        	<a href="http://localhost/railway/admin_login.html" style="color:white;"><span class="glyphicon glyphicon-log-in"> </span><b> Logout</b> </a>
            	</li>
            </ul>
        </div>
    </nav>
    <div class="container-sm">
		<div class="table table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-xs-3">
							<h2>ALL User Details</h2>

						</div>
						<div class="col-xs-9">
							<input type="text"  id="myInput" style="width:60%;color: black;" onkeyup="myFunction()" placeholder="Search using user id, name, mobile number, email">
							<a href="http://localhost/railway/signup_1.html" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>						
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover text-center table-bordered" id="myTable">
					<thead>
						<tr>
							<th class="text-center" style="width:4%;">Sr. No.</th>
							<th class="text-center">User ID</th>
							<th class="text-center">Full Name</th>
							<th class="text-center">Email ID</th>
							
							<th class="text-center">Mobile Number</th>
							<th class="text-center">Password</th>
							<th class="text-center">Gender</th>
							<th class="text-center">Date Of Birth</th>
							<th class="text-center">Status</th>
							<th class="text-center">Action </th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							require "connect_database.php";
							if ($conn->connect_error) 
					        {
					            die("Connection failed: " . $conn->connect_error);
    						}
							$cdquery="SELECT * FROM user_details";
							$cdresult=mysqli_query($conn,$cdquery);
							$x=1;
							while ($cdrow=mysqli_fetch_array($cdresult)) 
							{
								echo "
										<tr>
											<td>".$x."</td>
											<td>".$cdrow[0]."</td>
											<td>".$cdrow[1]." ". $cdrow[2]."</td>
											<td>".$cdrow[3]."</td>

											<td>".$cdrow[5]."</td>
											<td>".$cdrow[4]."</td>
											<td>".$cdrow[6]."</td>
											<td>".$cdrow[7]."</td>
											<td>".$cdrow[9]."</td>
											<td>
												<a href=\"http://localhost/railway/mail_user.php?id=".$cdrow[0]."\" style=\"color:#0377fc;\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">email</i></a>
											
												<a href=\"http://localhost/railway/delete_user.php?id=".$cdrow[0]."\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a>
											</td>
										</tr>
								";
								$x+=1;
							}

						?>
					</tbody>
				</table>
			</div>
		</div>        
	</div>
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
        		for(j = 1; j < 5; j++)
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