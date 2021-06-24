<?php

//echo "<br><script> alert('Not able to connect');window.history.go(-1); </script><br>";
// Form Contents
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['Address'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];
  $description = $_POST['description'];
  $vendor = $_POST['vendor'];
  $food = $_POST['food'];
  $address = $address.' '.$city.' '.$state.' '.$zip;
  echo $name.$email.$address.$state.$city.$zip.$description;
}
	//$servername = "localhost";
	//$username = "root"; // For MYSQL the predifined username is root
	//$password = ""; // 000Webhost20mx117#  --> webhost password      For MYSQL the predifined password is " "(blank)

	//$dbname = "sample";
	$servername = "localhost";
	$username = "id16227818_root";
	$password = "000Webhost20mx117#";
	$dbname = "id16227818_sample";
	
	$ins = 1;
// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	//echo "<br><script> alert('Not able to connect'); </script><br>";
	//header( "Location: contactus.html" );
	$conn->close();
	echo "<script>alert('Unsuccessful Connection Click to go back'); window.history.go(-1);</script>";
  
}
//else
//echo "<script>alert('successful Connection Click to go back'); window.history.go(-1);</script>";

if( $ins )
{
	$sql = "INSERT INTO user (name,email,address,description,food,vname) 
	values('$name','$email','$address','$description','$food','$vendor')";
	$result = $conn->query($sql);
	if( $conn->error )
	{
		echo("Error description: " . $conn -> error);
		//echo "<br><script> alert('Unable to send mail'); </script><br>";
		//header( "Location: New_user_otp.php" );
		$conn->close();
		echo "<script>alert('Unable to send mail'); window.history.go(-1);</script>";
	}
	else 
	{
	/*	$conn->close();
		$to="praneshs333@gmail.com";
		$subject = "Thank you!";
		$txt = "This is a test: ".$email;
		$headers = "From: praneshs333@gmail.com";
		mail($to,$subject,$txt,$headers);
		echo "<p>Thank you for being patient.</p>";
	*/	
		$sql = "select food,email from vendor where food = '$food'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$row = $result->fetch_assoc();
			$vemail = $row["email"];
		}
		else{
			echo "<br><script> alert('mail not sent and vendor not available'); window.history.go(-1); </script><br>";
		}
		
			
			
		
		$to=$email;
		$subject = "Submitted successfully!";
		$txt = "Thank you for being patient : ".$email."Your Request has been submitted to vendor of ".$food;
		$headers = "From: praneshs333@gmail.com";
		mail($to,$subject,$txt,$headers);
		//echo "<p></p>";
		// Send to vendor also
		$to=$vemail;
		$subject = "Request from user!";
		$txt = "Thank you for being patient : ".$vemail."A Request has been submitted to you from "
		.$name." \nEmail : " .$email. "\nAddress : ".$address ."\n and the user says that " .$description;
		$headers = "From: praneshs333@gmail.com";
		mail($to,$subject,$txt,$headers);
		
	    $conn->close();
		echo "<script>alert('Submitted your request and Mail sent succesfully'); window.history.go(-1);</script>";
	}
}

	/*$sql = "SELECT name,email,vname FROM user";
	$result = $conn->query($sql);
	/echo "<br><script> alert('mail not sent'); </script><br>";
	//header( "Location: contactus.html" );
	echo "<script>alert('message sent succesfully'); window.history.go(-1);</script>";
	if ($result->num_rows > 0) {
	// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "id: " . $row["name"]. " - name: " . $row["email"]. $row["vname"]."<br>";
	}
	} else {
	echo "0 results";
	}
	*/
?>