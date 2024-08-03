<?php
    session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>

        <title>Suporte</title>

        <link href="source/css/default.css" type="text/css" rel="stylesheet">
        <link href="source/css/responsive.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <link rel="icon" href="img/icon.png">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>

        <header class="page-header">
            <div class="container">
                <div class="row">
                    <div class="page-header-content">
                        <div class="page-back-button">
                            <a class="back-button" href="/">Voltar</a>
                        </div>
                        <div class="page-title" style="width:250px">
                            <h2>Suporte</h2>
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
                                <h1>Pedido de suporte</h1>
                            </div>
                            <form class="main-form" id="suporte" method="post" action="source/php/support.php">
                                <input name="nome" type="text" placeholder="Nome" autocomplete="off" required>
                                <input name="telemovel" type="tel" placeholder="Telemóvel" autocomplete="off" required>
                                <input name="email" type="email" placeholder="Email" autocomplete="off" required>
                                <select form="suporte" name="tiposuporte" required>
                                    <option value="Informações">Informações</option>
                                    <option value="Encomendas">Encomendas</option>
                                </select>
                                <textarea name="desc" type="text" placeholder="Descrição" autocomplete="off" required></textarea>
                                <button type="submit" style="width:initial">Confirmar e enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>



    </body>
</html>