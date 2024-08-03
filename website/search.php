<?php 
    session_start();

    include('source/php/dbconnect.php');
    $search = mysqli_real_escape_string($dbConnect, $_GET['search']);

?>
<!DOCTYPE HTML>
<html>
    <head>
        <!-- Title -->
        <?php echo '<title>'.$search.'</title>' ?>

        <?php require("layouts/head.php") ?>
    </head>
    <body>

        <!-- Header -->
        <?php include('layouts/header.php') ?>

        <!-- Nav -->
        <?php require("layouts/navbar.php") ?>

        <main>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="section-content">
                            <div class="list-products-title">
                                <?php 
                                    $query = "SELECT * FROM Produtos WHERE Produto LIKE '%$search%'";
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
                                    if(!empty($search)){
                                        if(mysqli_num_rows($row) > 0){
                                            while ($dr = mysqli_fetch_assoc($row)) {
                                                require('layouts/product.php');
                                            }
                                        }else{
                                            echo 'Nada encontrado.';
                                        }
                                    }else{
                                        echo 'Nada encontrado porque não foi inserido nenhum texto no campo de pesquisa.';
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
</html>
