<?php 
    session_start();
    include('source/php/dbconnect.php');

    $id = mysqli_real_escape_string($dbConnect, $_GET['id']);
    $query = "SELECT Produtos.*, Marcas.* FROM Produtos INNER JOIN Marcas ON Produtos.IDMarca = Marcas.IDMarca WHERE Produtos.IDProduto = '$id'";
    $row = mysqli_query($dbConnect,$query);

    if(mysqli_num_rows($row) == 1){
        $datareader = mysqli_fetch_assoc($row);
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <!-- Title -->
        <title><?php echo $datareader['Produto']; ?></title>

        <?php require("layouts/head.php") ?>
    </head>
    <body>
        <!-- Header -->
        <?php require("layouts/header.php") ?>

        <!-- Nav -->
        <?php require("layouts/navbar.php") ?>

        <!-- Main -->
        <main>

            <!-- Top Product -->
            <section name="top" id="productpage">
                <div class="container">
                    <div class="row">
                        <div class="section-content">
                                <div class="flex">
                                    <div class="top-product-img">
                                        <div class="product-img">
                                        <?php 
                                            $dirname = "img/produtos/".$datareader['IDProduto']."/";
                                            $images = glob($dirname."*");
                                            sort($images);

                                            if (count($images) > 0){ 
                                                $img = $images[0];
                                                echo '<img id="expandedImg" src="'.$img.'">'; 
                                            } else {
                                                echo '<img src="img/noimage.png">'; 
                                            }
                                        ?>
                                        </div>
                                        <div class="product-img-list flex">
                                            <?php
                                                foreach($images as $image){
                                                    echo '<img src="'.$image.'" onclick="setImageProduto(this)">';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="top-product-text">
                                        <div class="top-product-name">
                                            <h1><?php echo $datareader['Produto'];?></h1>
                                        </div>
                                        <div class="top-product-ref">
                                            <p>REF: <?php echo $datareader['Referencia'];?></p>
                                        </div>

                                        <div class="top-product-price">

                                            <?php if(isset($datareader['Desconto'])){ ?>
                                                <div class="old-price">
                                                    <p>PVPR</p>
                                                    <?php echo '<p><span class="price">'.$datareader['Preco'].' €</span></p>';?>
                                                </div>
                                                <div class="current-price">
                                                    <?php 
                                                        $newprice = number_format(number_format($datareader['Preco'],2)*(1-($datareader['Desconto']/100)),2);
                                                        echo '<p><span class="price">'.$newprice.' €</span></p>';
                                                    ?>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="current-price">
                                                    <p style="margin-bottom:-0.75em">PVPR</p>
                                                    <?php echo '<p><span class="price">'.number_format($datareader['Preco'],2).' €</span></p>';?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="top-product-stock">
                                            <?php if($datareader['Quantidade'] > 10){ ?>
                                                <span title="Disponível" style="color:var(--stockgreen)">Disponível</span>
                                                <img src="img/icons/ready.png">
                                            <?php }elseif($datareader['Quantidade'] > 0 and $datareader['Quantidade'] < 10){ ?>
                                                <span title="Poucas unidades" style="color:var(--stockblue)">Disponível</span>
                                                <img src="img/icons/half-ready.png">
                                            <?php }else{ ?>
                                                <span title="Indisponível" style="color:var(--stockred)">Indisponível</span>
                                                <img src="img/icons/close.png">
                                            <?php
                                                }
                                            ?>
                                        </div>

                                        <div class="top-product-buttons">
                                            <?php 
                                                if($datareader['Quantidade'] > 0){
                                                    echo '<a class="button-buy" href="source/php/cart.php?action=add&id='.$datareader['IDProduto'].'">Adicionar ao carrinho</a>'; 
                                                }else{
                                                    echo '<a class="button-buy out-stock">Sem stock</a>';
                                                }
                                                echo '<a class="button-fav" href="source/php/favoritos.php?action=add&id='.$datareader['IDProduto'].'"><img src="img/icons/heart.png"></a>';
                                            ?>
                                        </div>

                                        <div class="top-product-extras">
                                            <?php echo '<p><span>Marca: </span><a class="link" href="/marca.php?id='.$datareader['IDMarca'].'">'.$datareader['Marca'].'</a></p>' ?>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Description -->
            <section name="description">
                <div class="container">
                    <div class="row">
                        <div class="section-content">
                            <div class="section-title">
                                    <h1>Descrição</h1>
                            </div>
                            <div class="product-description">
                                <?php echo $datareader['Descricao'];?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <?php include('layouts/footer.php') ?>
    </body>
    <script src="source/js/default.js"></script>
</html>
