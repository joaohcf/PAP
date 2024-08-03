<?php

    $dbConnect = mysqli_connect('database', 'root', 'root_password', 'dbGestor');

    if(!$dbConnect){
        echo "<br>Erro: Nao foi possivel ligar à base de dados.";
		exit;
    }

    mysqli_set_charset($dbConnect,"utf8mb4");
?>
