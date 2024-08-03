<?php
    session_start();

    include('dbconnect.php');

    $IDCliente = $_SESSION['SESS_ID'];
    $IDMorada = $_POST['IDMorada'];
    $Pagamento = $_POST['Pagamento'];

    $morada = "SELECT * FROM Moradas WHERE IDMorada = '$IDMorada' AND IDCliente = '$IDCliente'";
    $doMorada = mysqli_query($dbConnect,$morada);
    
    if(mysqli_num_rows($doMorada) == 1){
        $drMorada = mysqli_fetch_assoc($doMorada);

        $morada_nome = $drMorada['Nome'];
        $morada_morada = $drMorada['Morada'];
        $morada_codpostal = $drMorada['CodPostal'];

        $cliente = "SELECT Nome, NIF, Email FROM Clientes WHERE IDCliente = '$IDCliente'";
        $doCliente = mysqli_query($dbConnect, $cliente);
        $drCliente = mysqli_fetch_assoc($doCliente);

        $cliente_nome = $drCliente['Nome'];
        $cliente_nif = $drCliente['NIF'];
        $cliente_email = $drCliente['Email'];

        $factura = "INSERT INTO Facturas (Nome, NIF, Morada, CodPostal) VALUES ('$cliente_nome', '$cliente_nif', '$morada_morada', '$morada_codpostal')";
        $doFactura = mysqli_query($dbConnect,$factura);
        $LastFactura = mysqli_insert_id($dbConnect);

        if(!empty($LastFactura)){
            foreach($_SESSION["cart"] as $keys => $values){
                $IDProduto = $values['item_id'];
                $Price = $values['item_price'];

                $query = "INSERT INTO Factura_Produtos (IDFactura, IDProduto, Price, Quantidade) VALUES ('$LastFactura', '$IDProduto', '$Price', 1)";
                $doQuery = mysqli_query($dbConnect,$query);
            }

            $encomenda = "INSERT INTO Encomendas (IDCliente, IDFactura, Nome, Morada, CodPostal, TipoPagamento) VALUES ('$IDCliente','$LastFactura', '$morada_nome', '$morada_morada', '$morada_codpostal', '$Pagamento')";
            $doEncomenda = mysqli_query($dbConnect,$encomenda);
            $IDEncomenda = mysqli_insert_id($dbConnect);

            require('email/encomenda.php');
        }else{
            echo 'Não existem produtos';
        }
    }else{
        echo 'Não é sua morada';
    }
?>