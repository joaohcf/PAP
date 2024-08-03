<?php
    session_start();

    if(!isset($_SESSION['SESS_ID'])){
        header('Location: ../../login.php');
        exit;
    }

    $IDCliente = $_SESSION['SESS_ID'];

switch($_REQUEST['action']){
    case 'add':
        include('dbconnect.php');
        $designacao = $_POST['designacao'];
        $recetor = $_POST['nome'];
        $morada = $_POST['morada'];
        $codpostal = $_POST['cod-postal'];

        $query = "SELECT * FROM Moradas WHERE Designacao='$designacao' AND Morada='$morada' AND CodPostal='$codpostal' AND IDCliente='$IDCliente'";
        $doQuery = mysqli_query($dbConnect,$query);
        $checkQuery = mysqli_num_rows($doQuery);

        if($checkQuery == 0){
            $query = "INSERT INTO Moradas (Morada,CodPostal,Designacao,Nome,IDCliente) VALUES ('$morada','$codpostal','$designacao','$recetor','$IDCliente')";
            $doQuery = mysqli_query($dbConnect,$query);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo 'Uma morada com estes dados já se encontra registada.';
            exit;
        }
    break;
    case 'remove':
        include('dbconnect.php');
        $IDMorada = $_GET['id'];
        $query = "DELETE FROM Moradas WHERE IDMorada='$IDMorada'";
        $doQuery = mysqli_query($dbConnect,$query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    break;
}

?>