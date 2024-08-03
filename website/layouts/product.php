<div class="product">
    <?php
        $dirname = "img/produtos/".$dr['IDProduto']."/";
        $images = glob($dirname."*");
        sort($images);

        if (count($images) > 0){
            $img = $images[0];
            echo'<a href="product?id='.$dr['IDProduto'].'">
                    <img class="product-image" src="'.$img.'">
                </a>';
        }else{
            echo'<a href="product?id='.$dr['IDProduto'].'">
                <img class="product-image" src="img/noimage.png">
            </a>';
        }

        echo'<div class="product-name">
                <a href="product?id='.$dr['IDProduto'].'" title="'.$dr['Produto'].'">'.$dr['Produto'].'</a>
            </div>';

        if($dr['Quantidade'] > 10){
            echo'<div class="product-stock">
                    <span title="Disponível" style="color:var(--stockgreen)">
                        Disponível
                        <img class="product-stock-icon" src="img/icons/ready.png">
                    </span>
                </div>';
        }elseif($dr['Quantidade'] > 0 and $dr['Quantidade'] < 10){
            echo'<div class="product-stock">
                    <span title="Poucas unidades" style="color:var(--stockblue)">
                        Poucas unidades
                        <img class="product-stock-icon" src="img/icons/half-ready.png">
                    </span>
                </div>';
        }else{
            echo'<div class="product-stock">
                    <span title="Indisponível" style="color:var(--stockred)">
                        Indisponível
                        <img class="product-stock-icon" src="img/icons/close.png">
                    </span>
                </div>';
            }
        
        if($dr['Quantidade'] <= 0){
           echo '<a class="product-button-disable">Indisponível</a>'; 
        }else{
            if(isset($dr['Desconto'])){
                $newprice = number_format(number_format($dr['Preco'],2)*(1-($dr['Desconto']/100)),2);
                echo'<a class="product-button" href="source/php/cart.php?action=add&id='.$dr['IDProduto'].'">'.$newprice.' €</a>';
                echo '<div class="product-prom"><p>PVPR</p><p><span class="price">'.$dr['Preco'].' €</span></p></div>';
            }else{
                echo'<a class="product-button" href="source/php/cart.php?action=add&id='.$dr['IDProduto'].'">'.number_format($dr['Preco'],2).' €</a>';
            }
        }
    ?>
</div>