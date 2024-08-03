<nav class="navbar" id="navbarmenu">
    <div class="container">
        <div class="row">
            <ul>
                <?php
                    $query = "SELECT * FROM Categorias";
                    $row = mysqli_query($dbConnect, $query);

                    if(mysqli_num_rows($row) > 0) {
                        while($dr = mysqli_fetch_assoc($row)){ 
                ?>

                <li>
                    <?php echo '<a href="category?id='.$dr['IDCategoria'].'">'.$dr['Categoria'].'</a>'; ?>
                </li>

                <?php
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>