<?php
  session_start();
  include('../dbconnect.php');

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $nif = $_POST['nif'];

    $oldpsw = md5($_POST['oldpsw']);
    $newpsw = md5($_POST['newpsw']);
    $newpsw2 = md5($_POST['newpsw2']); 

    $IDCliente = $_SESSION['SESS_ID'];

    $query = "SELECT * FROM Clientes WHERE IDCliente = '$IDCliente'";
    $row = mysqli_query($dbConnect,$query);

    if(mysqli_num_rows($row) == 1){
      $dr = mysqli_fetch_assoc($row);

      if(isset($_POST['checknewpsw'])){

        if($oldpsw != $dr['Password']){
          echo "<script type='text/javascript'> window.location.href='/settings'; alert('A palavra-passe antiga inserida não coincide com a existente.');</script>";
            exit;
        }

        if($newpsw != $newpsw2){
            echo "<script type='text/javascript'> window.location.href='/settings'; alert('As palavras-passe inseridas não coincidem!');</script>";
            exit;
          }

        $query="UPDATE Clientes SET nome='$nome', nif='$nif', email='$email', password='$newpsw' WHERE IDCliente='$IDCliente'";
      }else{
        $query="UPDATE Clientes SET nome='$nome', nif='$nif', email='$email' WHERE IDCliente='$IDCliente'";
      }
      $doQuery=mysqli_query($dbConnect, $query);

			$_SESSION['SESS_Nome'] = $pnome;
      $_SESSION['SESS_Email'] = $email;
      
      echo "<script type='text/javascript'> window.location.href='/settings'; alert('Dados atualizados com sucesso!');</script>";
      exit;
    }else{ 
      echo "<script type='text/javascript'> window.location.href='/settings'; alert('Erro ao atualizar dados!');</scrip>";
      exit;
  }
?>