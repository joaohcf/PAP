<?php
  session_start();
  include('../dbconnect.php');

  $IDCliente = mysqli_real_escape_string($dbConnect, $_SESSION['SESS_ID']);
  $query="DELETE FROM Clientes WHERE IDCliente = '$IDCliente'";
  $doQuery=mysqli_query($dbConnect, $query);

	session_destroy();

  echo "<script type='text/javascript'> window.location.href='/'; alert('Conta eliminada com sucesso!');</script>";
?>