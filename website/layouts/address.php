<div class="list-container">
    <div class="list-container-header">
        <h1><?php echo $dr['Designacao']; ?></h1>
        <a <?php echo 'href="source/php/morada.php?action=remove&id='.$dr['IDMorada'].'"' ?> style="margin-left:auto"><button class="remove-address"><img src="img/icons/trash.png" style="display:block;width:24px;height:24px"></button></a>
    </div>
    <div class="list-container-body">
        <p>Para: <?php echo $dr['Nome']; ?></p>
        <p>Morada: <?php echo $dr['Morada']; ?></p>
        <p>Código-Postal: <?php echo $dr['CodPostal']; ?></p>
    </div>
</div>