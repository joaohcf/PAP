<?php 
    session_start();
    include('source/php/dbconnect.php');
?>
<!DOCTYPE HTML>
<html>
    <head>

        <title>Homepage</title>

        <link href="source/css/default.css" type="text/css" rel="stylesheet">
        <link href="source/css/responsive.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <link rel="icon" href="img/icon.png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!-- Header -->
        <?php include('layouts/header.php') ?>

        <!-- Nav -->
        <?php require("layouts/navbar.php") ?>

        <!-- Main -->
        <main>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="section-content">
                            <div class="cart-title">
                                <h2>Carrinho</h2>
                            </div>
                            <?php if(!empty($_SESSION['cart'])){ ?>
                                <table class="cart-table" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="cart-table-img" style="width:100px">#</td>
                                        <td>Produto</td>
                                        <td style="text-align:center">Qtd</td>
                                        <td style="text-align:center">Preço</td>
                                        <td style="text-align:center">Ações</td>
                                    </tr>
                                    <?php
                                        $total = null;
                                        foreach($_SESSION['cart'] as $keys => $values){
                                    ?>
                                    <tr>
                                    <?php
                                            $dirname = "img/produtos/".$values['item_id']."/";
                                            $images = glob($dirname."*");
                                            sort($images);
                                    
                                            if (count($images) > 0){
                                                $img = $images[0];
                                                echo'<td class="cart-table-img"><a href="product.php?id='.$values['item_id'].'"><img style="width:auto;height:100px;display:block;margin:auto" src="'.$img.'"></a></td>';
                                            }else{
                                                echo'<td class="cart-table-img"><a href="product.php?id='.$values['item_id'].'"><img style="width:auto;height:100px;display:block;margin:auto" src="img/noimage.png"></a></td>';
                                            }

                                            echo '<td><a href="product.php?id='.$values['item_id'].'" style="width:fit-content"><span class="cart-product-name">'.$values["item_name"].'</span></a><p style="margin-top:-0.5em"><span class="cart-product-ref">REF: '.$values['item_referencia'].'</span></p></td>';
                                            echo '<td style="text-align:center"><span class="cart-product-quantidade">1</span></td>';
                                            echo '<td style="text-align:center"><p><span class="cart-product-price">'.number_format($values['item_price'], 2).' €</span></p></td>';
                                            echo '<td style="text-align:center"><a href="source/php/cart.php?action=remove&id='.$values["item_id"].'" style="text-decoration:none;color:black"><img src="img/icons/trash.png" style="display:block;width:24px;height:24px;margin:auto"></a></td>';
                                    ?>
                                    </tr>
                                    <?php
                                            $total = $total + $values['item_price'];
                                        }
                                    ?>
                                </table>
                            <?php
                                echo '<div class="cart-bottom"><a href="checkout.php">Finalizar compra</a><span class="cart-total">Total: '.$total.' €</span></div>';
                                }else{
                                    echo'<div style="padding-top:1em"><p>Nenhum produto selecionado para compra.</p></div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        
        <!-- Footer -->
        <?php include('layouts/footer.php') ?>

    </body>
    <script src="source/js/default.js"></script>
</html>