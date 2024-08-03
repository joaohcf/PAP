<?php
    include('../dbconnect.php');
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$query = "SELECT * FROM Clientes WHERE Email='$email'";
	$row = mysqli_query($dbConnect,$query);

	if(mysqli_num_rows($row) == 1) {
		$dr = mysqli_fetch_assoc($row);
		if($password == $dr['Password']){

			require('session.php');

			echo "<script type='text/javascript'> window.location.href='/';</script>";
			exit();
		}else {
			echo "<script type='text/javascript'> window.location.href='/login'; alert('Credenciais não combinam!'); </script>";
			exit();
		}
	}else {
		echo "<script type='text/javascript'> window.location.href='/register'; alert('Nenhuma conta existente contem esse email!'); </script>";
		exit();
	}
?>