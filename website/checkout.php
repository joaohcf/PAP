<?php 
    session_start();

    if(!isset($_SESSION['SESS_ID'])){
        header ("Location: login.php");
    }
    
    include('source/php/dbconnect.php');

    $IDCliente = $_SESSION['SESS_ID'];
?>
<!DOCTYPE HTML>
<html>
    <!-- Head -->
    <head>
        <!-- Title -->
        <title>Homepage</title>

        <?php require("layouts/head.php") ?>
    </head>

    <!-- Body -->
    <body>

        <header class="page-header">
            <div class="container">
                <div class="row">
                    <div class="page-header-content">
                        <div class="page-back-button">
                            <a class="back-button" href="/">Voltar</a>
                        </div>
                        <div class="page-title" style="width:300px">
                            <h2>Finalizar compra</h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main -->
        <main>
            <div class="container">
                <div class="row">
                    <div class="checkout-container">
                        <div class="checkout-item">
                            <div class="item-title">
                                <p>Produtos na encomenda</p>
                            </div>
                            <div class="item-body">
                                <table class="cart-table" style="width:100%;background-color:white" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>#</td>
                                        <td>Produto</td>
                                        <td style="text-align:center">Quantidade</td>
                                        <td style="text-align:center">Preço</td>
                                    </tr>
                                    <?php
                                        $total = 0;
                                        
                                        foreach($_SESSION["cart"] as $keys => $values){ ?>
                                            <tr>
                                                <td style="width:70px">
                                                    <?php 
                                                        $dirname = "img/produtos/".$values['item_id']."/";
                                                        $images = glob($dirname."*");
                                                        sort($images);
                                                
                                                        if (count($images) > 0){
                                                            $img = $images[0];
                                                            echo'<a href="produto.php?item='.$values['item_id'].'">
                                                                    <img style="width:auto;height:70px;display:block;margin:auto" src="'.$img.'">
                                                                </a>';
                                                        }else{
                                                            echo'<a href="produto.php?item='.$values['item_id'].'">
                                                                <img style="width:auto;height:100px;display:block;margin:auto" src="img/noimage.png">
                                                            </a>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo '<a href="produto.php?item='.$values['item_id'].'">'.$values["item_name"].'</a>';?></td>
                                                <td style="text-align:center">1</td>
                                                <td style="text-align:center"><?php echo number_format($values['item_price'], 2).' €'; ?></td>
                                            </tr>
                                        <?php } ?>
                                </table>
                            </div>
                        </div>
                        <form class="checkout-form" action="source/php/checkout.php" method="post">
                            <div class="checkout-item">
                                <div class="item-title">
                                    <p>Endereço de envio</p>
                                </div>
                                <div class="item-body">
                                    <?php
                                        $query = "SELECT * FROM Moradas WHERE IDCliente = '$IDCliente'";
                                        $doQuery = mysqli_query($dbConnect,$query);
                                        
                                        if(mysqli_num_rows($doQuery) > 0){
                                            while($dr = mysqli_fetch_assoc($doQuery)){ ?>
                                            <div class="checkout-box">
                                                <?php echo '<input style="margin-right:1em" name="IDMorada" type="radio" value="'.$dr['IDMorada'].'">' ?>
                                                <div class="d-flex" style="flex-direction:column;font-size:10pt">
                                                    <?php echo '<p style="font-size:12pt;margin-bottom:0.25em;font-weight:500">'.$dr['Designacao'].'</p>'; ?>
                                                    <?php echo '<p>Recetor: '.$dr['Nome'].'</p>'; ?>
                                                    <?php echo '<p>Morada: '.$dr['Morada'].'</p>'; ?>
                                                    <?php echo '<p>Código-Postal: '.$dr['CodPostal'].'</p>'; ?>
                                                </div>
                                            </div>
                                    <?php 
                                            }
                                        }else{ 
                                    ?>
                                        <p style="margin-bottom:0.5em;font-size:12pt">Nenhuma morada registada.</p>
                                        <a href="settings.php" style="color:blue;text-decoration:underline">Adicionar morada</a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="checkout-item">
                                <div class="item-title">
                                    <p>Tipo de pagamento</p>
                                </div>
                                <div class="item-body">
                                    <div class="checkout-box">
                                        <input name="Pagamento" type="radio" value="Cobrança" style="margin-right:1em">
                                        <span>Envio à cobrança</span>
                                    </div>
                                    <div class="checkout-box">
                                        <input name="Pagamento" type="radio" value="Multibanco" style="margin-right:1em" disabled>
                                        <span>Multibanco <i style="color:#a9a9a9">Indisponivel</i></span>
                                    </div>
                                </div>
                            </div>                    
                            <div class="checkout-item" style="align-items:flex-end">
                                <button class="checkout-btn">Confirmar compra</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

    </body>

    <!-- Scripts -->
    <script src="source/js/default.js"></script>
</html>