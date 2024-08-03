<?php
    session_start();
    include('dbconnect.php');
    $id = mysqli_real_escape_string($dbConnect, $_GET['id']);
    switch($_GET['action']){
        //Adiciona produto ao carrinho
        case "add":
                if(isset($_SESSION["cart"])){
                    $query = "SELECT Produtos.* FROM Produtos WHERE IDProduto='$id'";
                    $row = mysqli_query($dbConnect,$query);
                    $dr = mysqli_fetch_assoc($row);

                    $item_array_id = array_column($_SESSION["cart"], 'item_id');
                    
                    if(!in_array($_GET['id'], $item_array_id)){  
                        $count = count($_SESSION["cart"]);
                        $item_array = array(
                            'item_id' => $dr['IDProduto'],
                            'item_referencia' => $dr['Referencia'],
                            'item_name' => $dr['Produto'],
                            'item_price' => number_format(number_format($dr['Preco'],2)*(1-($dr['Desconto']/100)),2),
                            );
                        
                            $_SESSION["cart"][$count] = $item_array;

                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        //MENSAGEM - ADICIONADO COM SUCESSO
                    }else{
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        //MENSAGEM - ERRO AO ADICIONAR
                    }
                }else{
                    $query = "SELECT Produtos.* FROM Produtos WHERE IDProduto='$id'";
                    $row = mysqli_query($dbConnect,$query);
                    $dr = mysqli_fetch_assoc($row);

                    $item_array = array(
                        'item_id' => $dr['IDProduto'],
                        'item_referencia' => $dr['Referencia'],
                        'item_name' => $dr['Produto'],
                        'item_price' => number_format(number_format($dr['Preco'],2)*(1-($dr['Desconto']/100)),2)
                        );
                        
                    $_SESSION["cart"][0] = $item_array;
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    //MENSAGEM - ADICIONADO COM SUCESSO
                }
                if(!empty($_SESSION["cart"])){  
                    $total = null;
                    foreach($_SESSION["cart"] as $keys => $values)  
                    {
                        echo number_format($values["item_price"], 2);
                        $total = $total + $values['item_id'];
                    }
                }            
        break;

        //Remove produto do carrinho
        case "remove":
            foreach($_SESSION["cart"] as $keys => $values)  
            {  
                    if($values["item_id"] == $_GET["id"])  
                    {
                        unset($_SESSION["cart"][$keys]);
                        //MENSAGEM - REMOVIDO COM SUCESSO
                        header('Location: /cart');
                    }else{
                        echo 'Erro';
                    }
            }  
        break;
    }
?>