<?php
    session_start();

    if(!isset($_SESSION['SESS_ID'])){
        header('Location: ../../login.php');
        exit;
    }

    $IDCliente = $_SESSION['SESS_ID'];
    $IDProduto = $_GET['id'];

switch($_REQUEST['action']){
    case 'add':
        include('dbconnect.php');
        $query = "SELECT * FROM Favoritos WHERE IDProduto = '$IDProduto' AND IDCliente= '$IDCliente'";
        $doQuery = mysqli_query($dbConnect,$query);
        $checkQuery = mysqli_num_rows($doQuery);

        if($checkQuery == 0){
            $query = "INSERT INTO Favoritos (IDProduto, IDCliente) VALUES ('$IDProduto','$IDCliente')";
            mysqli_query($dbConnect,$query);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            echo 'Este produto já se encontra nos favoritos.';
            exit;
        }
    break;
    case 'remove':
        include('dbconnect.php');
        $query = "DELETE FROM Favoritos WHERE IDProduto='$IDProduto' AND IDCliente='$IDCliente'";
        mysqli_query($dbConnect,$query);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    break;
}

?>