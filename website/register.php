<?php
    session_start();
    
    if(isset($_SESSION['SESS_ID'])){
        header('Location: index.php');
    }
?>

<!DOCTYPE HTML>
<html>
    <!-- Head -->
    <head>
        <!-- Title -->
        <title>Homepage</title>

        <?php require("layouts/head.php") ?>
    </head>
    <body>

        <header class="page-header">
            <div class="container">
                <div class="row">
                    <div class="page-header-content">
                        <div class="page-back-button">
                            <a class="back-button" href="/">Voltar</a>
                        </div>
                        <div class="page-title">
                            <h2>Registar</h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="section-content" style="padding:0;margin-top:3em;border:1px solid var(--gray)">
                            <div class="page-section-title">
                                <h1>Criar conta</h1>
                            </div>
                            <form class="main-form" method="post" action="source/php/auth/register.php">
                                <input name="nome" type="text" placeholder="Nome" autocomplete="off" required>
                                <input name="nif" type="text" placeholder="NIF" autocomplete="off" required>
                                <input name="email" type="email" placeholder="Email" autocomplete="off" required>
                                <input name="password" type="password" placeholder="Password" required>
                                <input name="passwordCheck" type="password" placeholder="Confirmar password" required>
                                <button type="submit">Registar e entrar</button>
                            </form>
                            <div class="page-section-footer">
                                <p>Já tem uma conta? <a href="password_request"> Faça login aqui.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
