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
                            <h2>Login</h2>
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
                                <h1>Iniciar Sessão</h1>
                            </div>
                            <form class="main-form" method="post" action="source/php/auth/login.php">
                                <input name="email" type="email" placeholder="Email" required>
                                <input name="password" type="password" placeholder="Password" required>
                                <button type="submit" required>Entrar</button>
                            </form>
                            <div class="page-section-footer">
                                <p style="margin-bottom:0.5em">Esqueceu a palavra-passe? <a href="password_request"> Recuperar palavra-passe.</a></p>
                                <p>Não tem uma conta? <a href="register">Crie uma aqui.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
