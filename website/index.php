<?php
    session_start();
    include('source/php/dbconnect.php');
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
        <!-- Header -->
        <?php require("layouts/header.php") ?>

        <!-- Nav -->
        <?php require("layouts/navbar.php") ?>

        <!-- Slide -->
        <?php require("source/php/slide.php") ?>

        <!-- Informações -->
        <section class="information">
            <div class="container">
                <div class="row">
                    <div class="information-content">
                        <div class="info-container">
                            <div class="info-container-icon">
                                <img style="vertical-align:middle" src="img/icons/delivery-truck.png">
                            </div>
                            <div class="info-container-text">
                                <p>Entrega</p>
                                <p>Rápida</p>
                            </div>
                        </div>
                        <div class="info-container">
                            <div class="info-container-icon">
                                <img style="vertical-align:middle" src="img/icons/credit-card.png">
                            </div>
                            <div class="info-container-text">
                                <p>Pagamento</p>
                                <p>Seguro</p>
                            </div>
                        </div>
                        <div class="info-container">
                            <div class="info-container-icon">
                                <img style="vertical-align:middle" src="img/icons/hand.png">
                            </div>
                            <div class="info-container-text">
                                <p>Envio à</p>
                                <p>Cobrança</p>
                            </div>
                        </div>
                        <div class="info-container">
                            <div class="info-container-icon">
                                <img style="vertical-align:middle" src="img/icons/phone-call.png">
                            </div>
                            <div class="info-container-text">
                                <p>Atendimento</p>
                                <p>10H - 18H</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main -->
        <main>
            <!-- Destaques -->
            <section name="Destaques">
                <div class="container">
                    <div class="row">
                        <div class="section-content">
                            <div class="section-title">
                                <h1>Destaques</h1>
                            </div>
                            <div class="flex">
                                <?php
                                    $query = "SELECT * FROM Produtos ORDER BY RAND() DESC LIMIT 5";
                                    $row = mysqli_query($dbConnect,$query);

                                    if(mysqli_num_rows($row) > 0){
                                        while ($dr = mysqli_fetch_assoc($row)){
                                            require('layouts/product.php');
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Novidades -->
            <section name="Novidades">
                <div class="container">
                    <div class="row">
                        <div class="section-content">
                            <div class="section-title">
                                <h1>Novidades</h1>
                            </div>
                            <div class="flex">
                                <?php
                                    $query = "SELECT * FROM Produtos ORDER BY IDProduto DESC LIMIT 5";
                                    $row = mysqli_query($dbConnect,$query);
                                
                                    if(mysqli_num_rows($row) > 0){
                                        while ($dr = mysqli_fetch_assoc($row)) {
                                        require('layouts/product.php');
                                }}?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Promoções -->
            <section name="Promoções">
                <div class="container">
                    <div class="row">
                        <div class="section-promotion-title">
                            <h1>Promoções</h1>
                        </div>
                        <div class="section-promotion-content">
                            <div class="flex">
                                <?php
                                    $query = "SELECT * FROM Produtos WHERE Desconto <> '' ORDER BY RAND() DESC LIMIT 6";
                                    $row = mysqli_query($dbConnect,$query);

                                    if(mysqli_num_rows($row) > 0){
                                        while ($dr = mysqli_fetch_assoc($row)) {
                                            require('layouts/product.php');
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mais vendidos -->
            <section name="BestSellers">
                <div class="container">
                    <div class="row">
                        <div class="section-content">
                            <div class="section-title">
                                <h1>Mais vendidos</h1>
                            </div>
                            <div class="flex">
                                <?php
                                    $query = "SELECT Factura_Produtos.IDProduto, Produtos.* FROM Factura_Produtos INNER JOIN Produtos ON Factura_Produtos.IDProduto = Produtos.IDProduto GROUP BY Factura_Produtos.IDProduto LIMIT 5";
                                    $row = mysqli_query($dbConnect,$query);

                                    if(mysqli_num_rows($row) > 0){
                                        while ($dr = mysqli_fetch_assoc($row)) {
                                            require('layouts/product.php');
                                        }
                                    }else{
                                        echo '<p style="margin-top:1em">Nenhum produto comprado até agora.</p>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <?php require("layouts/footer.php") ?>
    </body>

    <!-- Scripts -->
    <script src="source/js/default.js"></script>
    <script src="source/js/slideshow.js"></script>
</html>