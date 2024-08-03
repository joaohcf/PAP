<?php 
    session_start();

    include('source/php/dbconnect.php');

    $search = mysqli_real_escape_string($dbConnect, $_GET['id']);

    $query = "SELECT Marca FROM Marcas WHERE IDMarca = '$search'";
    $row = mysqli_query($dbConnect,$query);
    $dr = mysqli_fetch_assoc($row);

    $Marca = $dr['Marca'];
?>
<!DOCTYPE HTML>
<html>
    <head>
        <!-- Title -->
        <?php echo '<title>'.$Marca.'</title>' ?>

        <?php require("layouts/head.php") ?>
    </head>
    <body>
        <!-- Header -->
        <?php require("layouts/header.php") ?>

        <!-- Nav -->
        <?php require("layouts/navbar.php") ?>

        <!-- Main -->
        <main>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="section-content">
                            <div class="list-products-title">
                                <?php 
                                    $query = "SELECT * FROM Produtos WHERE IDMarca = '$search'";
                                    $row = mysqli_query($dbConnect,$query);
                            
                                    $find = mysqli_num_rows($row);

                                    if(empty($search)){
                                        $find = 0;
                                    }
                                    
                                    echo '<p>Foram encontrados '.$find.' produtos.</p>';
                                ?>
                            </div>
                            <div class="list-products">
                                <?php
                                    $query = "SELECT * FROM Produtos WHERE IDMarca = '$search'";
                                    $doQuery = mysqli_query($dbConnect,$query);

                                    if(mysqli_num_rows($doQuery) > 0){
                                        while ($dr = mysqli_fetch_assoc($doQuery)) {
                                            require('layouts/product.php');     
                                    }}else{
                                        echo 'Não existe produtos desta marca.';
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
    <script src="source/js/default.js"></script>
</html>