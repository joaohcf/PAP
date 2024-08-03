<?php
    $query = "SELECT * FROM Empresa WHERE ID = 1";
    $doQuery = mysqli_query($dbConnect,$query);
    $dr = mysqli_fetch_assoc($doQuery);
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="footer-row">
                <div class="footer-column logo">  
                    <img src="img/web/logo-white-text.png">
                </div>
                <div class="footer-column">    
                    <div class="footer-column-title">
                        <p>LOJA</p>
                    </div> 
                    <p><a href="cart">Carrinho</a></p>
                </div>
                <div class="footer-column">
                    <div class="footer-column-title">
                        <p>AJUDA</p>
                    </div> 
                    <p><a href="support">Suporte</a></p>
                </div>
                <div class="footer-column">    
                    <div class="footer-column-title">
                        <p>CONTA</p>
                    </div>
                    <?php 
                        if(!isset($_SESSION['SESS_ID'])){
                    ?>
                        <p><a href="register">Nova conta</a></p>
                        <p><a href="login">Login</a></p>
                    <?php
                        }else{
                    ?>
                        <p><a href="settings">Definições de conta</a></p>
                        <p><a href="source/php/auth/logout">Logout</a></p>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>