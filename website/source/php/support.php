<?php
    session_start();
    
    include('dbconnect.php');

    $nome = $_POST['nome'];
    $telemovel = $_POST['telemovel'];
	$email = $_POST['email'];
    $suporte = $_POST['tiposuporte'];
    $descricao = $_POST['desc'];

    $query = "INSERT INTO Suporte (Nome, Telemovel, Email, TipoSuporte, Descricao) VALUES ('$nome','$telemovel','$email','$suporte','$descricao')";
	$doQuery = mysqli_query($dbConnect,$query);

    if(!$doQuery){
        echo mysqli_error($dbConnect);
    }else{
        echo "<script type='text/javascript'> window.location.href='../../index.php'; alert('Pedido de suporte enviado com sucesso!');</script>";
    }
?>