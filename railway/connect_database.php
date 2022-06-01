<link rel="stylesheet" href="style.css" />
<?php
	$conn = new mysqli("localhost", "root", "root" , "railway","3308");
	if ($conn->connect_error) 
	{
 		die("Connection failed: " . $conn->connect_error);
	} 
?>
