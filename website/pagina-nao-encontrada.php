<?php
    session_start();
    include('source/php/dbconnect.php');
?>
<!DOCTYPE HTML>
<html>
    <!-- Head -->
    <head>
        <!-- Title -->
        <title>Página não encontrada</title>

        <?php require("layouts/head.php") ?>
    </head>

    <!-- Body -->
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
                        <div class="section-content not-found">
                            <h1>404 PAGE NOT FOUND!</h1>
                            <p>A página que procura não existe.</p>
                            <a href="/">Voltar à página inicial</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

    </body>
    <!-- Scripts -->
    <script src="source/js/default.js"></script>
</html>