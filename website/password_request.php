<?php
    session_start();
    if(isset($_SESSION['SESS_ID'])){
        header('Location: index.php');
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <!-- Title -->
        <title>Recuperar palavra-passe</title>

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
                        <div class="page-title" style="width:400px">
                            <h2>Recuperar palavra-passe</h2>
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
                                <h1>Recuperar palavra-passe</h1>
                            </div>
                            <form class="main-form" method="post" action="source/php/auth/password_reset.php?action=request" style="border:none">
                                <input name="email" type="email" placeholder="Email" required>
                                <button type="submit" required>Confirmar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

    </body>
</html>