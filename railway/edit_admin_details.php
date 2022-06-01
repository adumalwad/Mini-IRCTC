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

			$cdquery="SELECT * FROM admin_details WHERE admin_id='".$_GET["id"]."'";
			$cdresult=mysqli_query($conn,$cdquery);
			$cdrow=mysqli_fetch_array($cdresult);

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
									<th style=\"text-align:center;\">Admin Id</th>
									<th style=\"text-align:center;\">Admin Usrname</th>
									<th style=\"text-align:center;\">Admin Password</th>
								</thead>
							<tbody>
			";

			echo "
								<tr>
									<td style=\"text-align:center;\">".$cdrow["admin_id"]."</td>
									<form action=\"edit_admin_details.php?id=".$_GET["id"]."\" method=\"post\">
									<td style=\"text-align:center;\"><input style=\"text-align:center;\"type=\"text\" name=\"username\" value=\"".$cdrow["username"]."\" required></td>
									<td style=\"text-align:center;\"><input style=\"text-align:center;\"type=\"text\" name=\"password\" value=\"".$cdrow["password"]."\" required></td>
								</tr>
			";
			echo "
							</tbody>
							</table>

							<input class=\"btn btn-success text-dark text-center\" value='Update Record' type=\"submit\" name=\"submit\">
							</form>
						</div>
					</div>
				</div>
			";
		}
		else
		{
			$sql = "UPDATE `admin_details` SET `username`='".$_POST["username"]."',`password`='".$_POST["password"]."' WHERE admin_id='".$_GET["id"]."'";
			if ($conn->query($sql) === TRUE) 
			{
    			echo"
					<div class=\"alert alert-success alert-dismissible\">
  							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;
  							</button>
	  						 <strong>Data has been successfully modified in record <i class=\"far fa-smile\"></i> .<strong>
					</div>
					<a href=\"http://localhost/railway/admin_login.html\" class=\" text-center text-dark font-weight-bold\">
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
	<br>
    <div class="text-center">
    	<?php

            echo"
                    <a class=\"nav-link\" href=\"http://localhost/railway/admin_menu.php?username=".$_SESSION["username"]."&password=".$_SESSION["password1"]." \">
                    	<button class=\"btn btn-primary text-dark p-2\" style=\"margin-right: 20px;\"> 
                			<i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back
            			</button>
                    </a>
            ";
        ?>
        <a href="http://localhost/railway/admin_login.html" class=" text-dark font-weight-bold">
            <button class="btn btn-danger text-dark p-2" style="margin-left: 20px;"> 
               <span style="margin-right:7px;">Logout</span><i class="fa fa-sign-out" aria-hidden="true"></i> 
            </button>
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
