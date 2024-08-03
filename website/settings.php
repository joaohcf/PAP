<?php 
    session_start();

    if(!isset($_SESSION['SESS_ID'])){
        header ("Location: index.php");
    }
    
    include('source/php/dbconnect.php');

    $IDCliente = $_SESSION['SESS_ID'];
?>
<!DOCTYPE HTML>
<html>
    <head>

        <title>Definições</title>

        <?php require("layouts/head.php") ?>

    </head>
    <body class="settings-page">

    <header class="page-header">
            <div class="container">
                <div class="row">
                    <div class="page-header-content">
                        <div class="page-back-button">
                            <a class="back-button" href="/">Voltar</a>
                        </div>
                        <div class="page-title">
                            <h2>Definições</h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    <section name="main">
        <div class="container">
            <div class="row">
                <div class="settings-box">

                    <div class="settings-leftside">
                        <div class="title">CONTA</div>
                        <button class="side-button active" onclick="setSettings(this)" id="toInformações">Informações pessoais</button>
                        <button class="side-button" onclick="setSettings(this)" id="toMoradas">Moradas</button>
                        <button class="side-button" onclick="setSettings(this)" id="toEncomendas">Encomendas</button>
                        <div class="title">PRODUTOS</div>
                        <button class="side-button" onclick="setSettings(this)" id="toFavoritos">Favoritos</button>
                        <div class="title">SESSÃO</div>
                        <a class="side-button logout" href="source/php/auth/logout.php">Terminar sessão</a>
                    </div>
                    
                    <div class="settings-rightside">

                        <!-- Informações -->
                        <div class="wrapper active" id="Informações">
                            <div class="wrapper-header">
                                <h1 class="setting-title">Informações</h1>
                            </div>
                            <div class="wrapper-body">
                                <?php
                                    $query = "SELECT * FROM Clientes WHERE IDCliente = '$IDCliente'";
                                    $row = mysqli_query($dbConnect,$query);

                                    if(mysqli_num_rows($row) > 0){
                                        $dr = mysqli_fetch_assoc($row)
                                    ?>

                                <form class="settings-form" action="source/php/auth/updateaccount.php" method="post" style="padding:0px">
                                    <div style="padding-bottom:0.5em;margin-bottom:0.5em">
                                        <label style="font-size:11pt">Nome</label>
                                    <?php echo '<input class="settings-input" name="nome" type="text" value="'.$dr['Nome'].'" autocomplete="off">'; ?>
                                        <label style="font-size:11pt">NIF</label>
                                    <?php echo '<input class="settings-input" name="nif" type="text" value="'.$dr['NIF'].'" autocomplete="off">'; ?>
                                    </div>
                                    <div style="padding-bottom:0.5em;margin-bottom:0.5em">
                                        <label style="font-size:11pt">Email</label>
                                    <?php echo '<input class="settings-input" name="email" type="text" value="'.$dr['Email'].'">'; } ?>
                                    </div>
                                    <div style="margin-bottom:0.5em">
                                        <label>Mudar palavra-passe</label>
                                        <input id="check" name="checknewpsw" type="checkbox" onclick="shownewpsw()">
                                    </div>
                                    <div id="newpassword" style="display:none;padding-bottom:1em;margin-bottom:0.5em">
                                        <label style="font-size:11pt">Antiga palavra-passe</label>
                                        <input class="settings-input" name="oldpsw" type="password">
                                        <label style="font-size:11pt">Nova palavra-passe</label>
                                        <input class="settings-input" name="newpsw" type="password">
                                        <label style="font-size:11pt">Repetir palavra-passe</label>
                                        <input class="settings-input" name="newpsw2" type="password">
                                    </div>
                                    <div>
                                        <button type="submit">Atualizar dados</button>
                                    </div>
                                </form>
                                <div style="border-bottom:1px solid #d9d9d9;width:100%;margin:1em 0em"></div>
                                <div>
                                    <p style="margin-bottom:0.25em;font-size:14pt">Quero eliminar a minha conta.</p>
                                    <a class="delete-account-btn" onclick="document.getElementById('delete-account').style.display='block'">Eliminar conta</a>
                                </div>
                            </div>
                        </div>

                        <div class="wrapper" id="Moradas">
                            <div class="wrapper-header">
                                <h1 class="setting-title">Moradas</h1>
                                <button class="setting-button" onclick="document.getElementById('new-address').style.display='block'">Adicionar morada <img src="img/icons/plus.png" style="display:block;margin-left:0.25em;width:24px;height:24px"></button>
                            </div>
                            <div class="wrapper-body">
                                <?php
                                    $query = "SELECT * FROM Moradas WHERE IDCliente = '$IDCliente'";
                                    $doQuery = mysqli_query($dbConnect,$query);

                                    if(mysqli_num_rows($doQuery) > 0){
                                        while($dr = mysqli_fetch_assoc($doQuery)){
                                            require 'layouts/address.php';
                                        }
                                    }else{
                                        echo 'Nenhuma morada registada.';
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="wrapper" id="Encomendas">
                            <div class="wrapper-header">
                                <h1 class="setting-title">Encomendas</h1>
                            </div>
                            <div class="wrapper-body">
                                <?php
                                    $query = "SELECT * FROM Encomendas WHERE Encomendas.IDCliente = '$IDCliente'";
                                    $doQuery = mysqli_query($dbConnect,$query);

                                    if(mysqli_num_rows($doQuery) > 0){
                                        while($dr = mysqli_fetch_assoc($doQuery)){
                                            require 'layouts/encomenda.php';
                                        }
                                    }else{
                                        echo 'Nenhuma encomenda realizada.';
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="wrapper" id="Favoritos">
                            <div class="wrapper-header">
                                <h1 class="setting-title">Favoritos</h1>
                            </div>
                            <div class="wrapper-body">
                                <table class="settings-table" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <?php
                                            $query = "SELECT Favoritos.*, Produtos.Produto, Produtos.Quantidade FROM Favoritos LEFT JOIN Produtos ON Favoritos.IDProduto = Produtos.IDProduto WHERE IDCliente = '$IDCliente'";
                                            $doQuery = mysqli_query($dbConnect,$query);
        
                                            if(mysqli_num_rows($doQuery) > 0){
                                                while($dr = mysqli_fetch_assoc($doQuery)){ ?>
                                                <tr>
                                                    <td>
                                                        <div class="settings-favorite">
                                                            <div class="settings-favorite-name">
                                                                <?php echo '<a href="http://localhost/website/produto.php?item='.$dr['IDProduto'].'">'.$dr['Produto'].'</a>' ?>
                                                            </div>
                                                            <div class="settings-favorite-delete">
                                                                <?php echo '<a href="source/php/favoritos.php?action=remove&id='.$dr['IDProduto'].'">Eliminar</a>' ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php 
                                                }
                                            }else{
                                                echo 'Nenhuma produto adicionado aos favoritos.';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="pop-container" id="new-address" onclick="newaddress()">
        <div class="pop-content">
            <div style="text-align:right">
                <button onclick="document.getElementById('new-address').style.display='none'" style="background-color:transparent;border:none;outline:none;cursor:pointer;font-size:18px"><img src="img/icons/close-black.png"></button>
            </div>
            <div style="font-size:18pt;font-weight:600">
                Criar nova morada
            </div>    
            <form class="main-form" action="source/php/morada.php" method="post" style="padding:1.5em 0em;padding-bottom:0">
                <input name="action" type="hidden" value="add">
                <div>
                    <label>Designação</label>
                    <input name="designacao" placeholder="Designação" required autocomplete="off">
                </div>
                <div>
                    <label>Nome do recetor</label>
                    <input name="nome" placeholder="Nome" required autocomplete="off">
                </div>
                <div>
                    <label>Morada</label>
                    <input name="morada" placeholder="Morada" required autocomplete="off">
                </div>
                <div>
                    <label>Código-Postal</label>
                    <input name="cod-postal" placeholder="Código-Postal" required autocomplete="off">
                </div>
                <button type="submit">Adicionar morada</button>
            </form>
        </div>
    </div>

    <div class="pop-container" id="delete-account" onclick="deleteaccount()" style="display:none;position:absolute;z-index:9999;top:0;left:0;width:100%;height:100%;background-color: rgba(0, 0, 0, 0.5)">
        <div class="pop-content">
            <div style="text-align:right">
                <button onclick="document.getElementById('delete-account').style.display='none'" style="background-color:transparent;border:none;outline:none;cursor:pointer;font-size:18px"><img src="img/icons/close-black.png"></button>
            </div>
            <h2 style="margin-bottom:15px">Tem a certeza que pretende eliminar a sua conta?</h2>
            <p style="margin-bottom:5px">Se eliminar a conta irá perder todos os registos de compras efetuadas no nosso website.</p>
            <a class="button-deleteaccount" href="source/php/auth/deleteaccount.php">Eliminar mesmo assim</a>
        </div>
    </div>

    </body>
    <script src="source/js/default.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(".side-button").on('click', function(){
            $(this).addClass('active').siblings().removeClass('active');
        })
    </script>
</html>