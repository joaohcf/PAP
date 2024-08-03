<div class="list-container">
    <div class="list-container-header">
        <h1><?php echo 'Nº #'.$dr['IDEncomenda']; ?></h1>
        <div class="delivery-status">
            <?php
                if($dr['Pronta'] == 1){
                    echo '<span class="delivery-content">Pronto <img src="img/icons/ready.png"></span>';
                }else{
                    echo '<span class="delivery-content">Em processamento <img src="img/icons/waiting.png"></span>';
                }
            ?>
            <div class="vertical-divider"></div>
            <?php
                if($dr['Enviada'] == 1){
                    echo '<span class="delivery-content">Enviada <img src="img/icons/ready.png"></span>';
                }else{
                    echo '<span class="delivery-content">Em espera <img src="img/icons/waiting.png"></span>';
                }
            ?>
        </div>
    </div>
    <div class="list-container-body">
        <p>Para: <?php echo $dr['Nome']; ?></p>
        <p>Morada: <?php echo $dr['Morada']; ?></p>
        <p>Código-Postal: <?php echo $dr['CodPostal']; ?></p>
        <br>
        <p>Data: <?php echo $dr['Data']; ?></p>
        <br>
            <?php
                $id = $dr['IDFactura'];
                $qry = "SELECT Factura_Produtos.Quantidade, Produtos.Preco FROM Factura_Produtos INNER JOIN Produtos ON Factura_Produtos.IDProduto = Produtos.IDProduto WHERE Factura_Produtos.IDFactura = '$id'";
                $doQry = mysqli_query($dbConnect,$qry);

                $totalprice = 0;

                if(mysqli_num_rows($doQry) > 0){
                    while($dtr = mysqli_fetch_assoc($doQry)){
                        $item_total = $dtr['Preco'] * $dtr['Quantidade'];
                        $totalprice = $totalprice + $item_total;;
                    }
                }
                echo '<p><b>Valor a pagar:</b> '.$totalprice.'€</p>';
            ?>
    </div>
</div>