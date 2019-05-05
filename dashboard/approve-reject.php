<!-- approve-reject.php -->
<?php 
	// APPROVED 
	if (isset($_GET['approve_id'])) {
		$id =$_GET['approve_id'];
		$sql ="UPDATE `restaurant_info` SET `approve_status`=1 WHERE id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("APPROVED.")</script>';
		echo '<script>window.location="restaurant-list.php"</script>';
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
	// REJECT
	if (isset($_GET['reject_id'])) {
		$id =$_GET['reject_id'];
		$sql ="UPDATE `restaurant_info` SET `approve_status`=0 WHERE id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("REJECTED.")</script>';
		echo '<script>window.location="restaurant-list.php"</script>';
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}

	//DELETE
	if (isset($_GET['delete_id'])) {
		$id =$_GET['delete_id'];
		$sql ="DELETE FROM `restaurant_info` WHERE id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("DELETED.")</script>';
		echo '<script>window.location="restaurant-list.php"</script>';
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}

//customer info approve reject delete 
	// APPROVED 
	if (isset($_GET['capprove_id'])) {
		$id =$_GET['capprove_id'];
		$sql ="UPDATE `restaurant_info` SET `approve_status`=1 WHERE id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("APPROVED.")</script>';
		echo '<script>window.location="customer-list.php"</script>';
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
	// REJECT
	if (isset($_GET['creject_id'])) {
		$id =$_GET['creject_id'];
		$sql ="UPDATE `restaurant_info` SET `approve_status`=0 WHERE id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("REJECTED.")</script>';
		echo '<script>window.location="customer-list.php"</script>';
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}

	//DELETE
	if (isset($_GET['cdelete_id'])) {
		$id =$_GET['cdelete_id'];
		$sql ="DELETE FROM `restaurant_info` WHERE id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("DELETED.")</script>';
		echo '<script>window.location="customer-list.php"</script>';
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
	//reject 
	if (isset($_GET['breject_id'])) {
		$id =$_GET['breject_id'];
		$sql ="UPDATE booking_details SET status = 0 WHERE id = '$id';";
		include_once 'dbCon.php';
		$con = connect();
		if ($con->query($sql) === TRUE) {
		echo '<script>alert("Rejected.")</script>';
		echo '<script>window.location="booking-list.php"</script>';
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}

	// approve booking request
	if (isset($_GET['bapprove_id'])) {
		$id =$_GET['bapprove_id'];
		include_once 'dbCon.php';
		$con = connect();
		$sql ="UPDATE booking_details SET status = 1 WHERE id = '$id';";
		
		$sql2 ="SELECT `id`, `c_id`, (SELECT `restaurent_name` FROM `restaurant_info` WHERE restaurant_info.id= booking_details.c_id) as username,(SELECT `email` FROM `restaurant_info` WHERE restaurant_info.id= booking_details.c_id) as email FROM booking_details WHERE id = '$id';";
		$result= $con->query($sql2);
		foreach ($result as $r ) {
			$cname = $r['username'];
			$email = $r['email'];
		}
		if ($con->query($sql) === TRUE) {
			include 'mailSender.php';
			$mail->Body = '<html><body>
	                Hello '.$cname.' . <br>
					Your booking is confirmed by restaurent. <br>
					Thank You.
	                </body></html>';
	            $mail->addAddress($email, "Booking Approve");
	            if($mail->send()) {
	            	echo  '<script>alert("Booking Confirmed.")</script>';
	                echo '<script>window.location="booking-list.php"</script>';
	            }else{
	                echo  '<script>alert("mail not send")</script>';
	                 echo '<script>window.location="booking-list.php"</script>';
	            } 
		
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}

?>