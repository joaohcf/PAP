<?php
  include('../dbconnect.php');

  $email = $_POST['email'];
  $nome = $_POST['nome'];
  $nif = $_POST['nif'];
  $password = md5($_POST['password']);
  $password2 = md5($_POST['passwordCheck']);

  if ($password!=$password2) {
    echo "<script type='text/javascript'> alert('As passwords têm de ser iguais!');</scrip>"; 
    exit;
  }

  $check = "SELECT * FROM Clientes WHERE Email='$email'";
  $doCheck = mysqli_query($dbConnect, $check);
  $rCheck = mysqli_num_rows($doCheck);

  if ($rCheck==0){
    $query="INSERT INTO Clientes (Nome, NIF, Email, Password) VALUES ('$nome', '$nif', '$email', '$password')";
    $doQuery=mysqli_query($dbConnect, $query);
    $ID = mysqli_insert_id($dbConnect);

    $log = "SELECT * FROM Clientes WHERE IDCliente = '$ID'";
    $doLog = mysqli_query($dbConnect,$log);

    if(mysqli_num_rows($doLog) == 1){
      $dr = mysqli_fetch_assoc($doLog);

      require('session.php');
    }
    echo "<script type='text/javascript'>window.location.href='/'; alert('Conta registada com sucesso!');</script>";
  }else{ 
    echo "<script type='text/javascript'>window.location.href='/register'; alert('O cliente já se encontra registado!');</scrip>";

    mysql_close($dbConnect);
  }
?>
