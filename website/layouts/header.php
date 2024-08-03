<header>
    <div class="container">
        <div class="row">
            <div class="flex">
                <!-- Logo -->
                <div class="header-item logo">
                    <a href="/">
                        <img class="logo" src="img/web/logo.png">
                    </a>
                </div>

                <!-- Search -->
                <div class="header-item search">
                    <form class="search-form" action="search.php" method="GET">
                        <input class="search-form-input" type="text" name="search" placeholder="Pesquisar" autocomplete="off">
                        <button class="search-form-button" type=submit>
                            <img class="search-form-button-icon" src="img/icons/search.png">
                        </button>
                    </form>
                </div>

                <!-- Menu -->
                <div class="header-item menu flex">
                    <div class="item-menu">
                        <button class="item-menu-button navbar-button" onClick="navbarmenu()">
                            <img class="item-menu-button-icon" src="img/icons/menu.png">
                        </button>

                    <?php if(isset($_SESSION['SESS_ID'])){ ?>
                        <a class="item-menu-button desktop-button" href="settings" style="margin-left:auto">
                            A minha conta
                        </a>
                        <a class="item-menu-button navbar-button" href="settings" style="margin-left:auto">
                            <img class="item-menu-button-icon" src="img/icons/user.png">
                        </a>
                    <?php }else{ ?>
                        <a class="item-menu-button" href="login" style="margin-left:auto">
                            <img class="item-menu-button-icon" src="img/icons/user.png">
                        </a>
                    <?php } ?>

                    </div>
                    <div class="vertical-divider"></div>
                    <div class="item-menu">
                        <a class="item-menu-button" href="cart" style="width:100%">
                            <img class="item-menu-button-icon" src="img/icons/cart.png">
                            <?php
                                if(!empty($_SESSION["cart"])){
                                $total = null;
                                foreach($_SESSION["cart"] as $keys => $values)  
                                    {
                                        $total = $total + $values['item_price'];
                                    }
                                }else{
                                    $total = number_format(0,2);
                                }
                                echo '<p style="margin-left:auto">'.$total.' €</p>';
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>