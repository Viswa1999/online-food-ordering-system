<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['Address'];
  $phone = $_POST['phone'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];
  $food = $_POST['food'];
  $address = $address.' '.$city.' '.$state.' '.$zip;
  //echo $name.$email.$address.$locality.$state.$city.$zip.$description;
}

	$servername = "localhost";
	$username = "root"; // For MYSQL the predifined username is root
	$password = ""; // For MYSQL the predifined password is " "(blank)

	$dbname = "sample";
	$ins = 1;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		$conn->close();
		die("Connection failed: " . $conn->connect_error);
		echo "<script>alert('Unable connect'); window.history.go(-1);</script>";
	}

	if( $ins )
	{
		$sql = "INSERT INTO vendor (vname,email,address,contact,food,city) 
		values('$name','$email','$address','$phone','$food','$city')";
		$result = $conn->query($sql);
		if( $conn->error )
		{
			//echo("Error description: " . $conn -> error."<br>");
			$conn->close();
			echo "<script>alert('Unable connect as there seems to be a connection error'); window.history.go(-1);</script>";
		}
		else 
		{
			//echo "<br>Rows inserted : ".$result."<br>";
			$conn->close();
			echo "<script>alert('Successfully Submitted , we will shortly contact you '); window.history.go(-1);</script>";
			// Mail code
		}
	}
/*	$sql = "SELECT vname,email,city FROM vendor";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		echo " " . $row["vname"]. " - vname: " . $row["email"]. $row["city"]."<br>";
	  }
	} else {
	  echo "0 results";
	}
*/
	$conn->close();
?>