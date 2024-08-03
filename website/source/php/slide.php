<?php
    $query = "SELECT SlideOne, SlideTwo, SlideThree FROM Empresa WHERE ID=1";
    $row = mysqli_query($dbConnect,$query);

    $dr = mysqli_fetch_assoc($row);

    $slideone = $dr['SlideOne'];
    $slidetwo = $dr['SlideTwo'];
    $slidethree = $dr['SlideThree'];
?>


<div class="main-banner" id="main-banner">
    <div class="imgbanbtn imgbanbtn-prev" id="imgbanbtn-prev"></div>
    <?php echo '<a href="'.$slidethree.'"><div class="imgban" id="imgban3"></div></a>' ?>
    <?php echo '<a href="'.$slidetwo.'"><div class="imgban" id="imgban2"></div></a>' ?>
    <?php echo '<a href="'.$slideone.'"><div class="imgban" id="imgban1"></div></a>' ?>
    <div class="imgbanbtn imgbanbtn-next" id="imgbanbtn-next"></div>
</div>

<style>
    .main-banner{margin:0 auto;width:100%;height:500px;overflow:hidden;background-color:#fff;position:relative}
    .main-banner .imgban{width:100%;height:100%;position:absolute;top:0px;transition: all ease-in-out 500ms}
    .main-banner #imgban3{background-image:url("img/slide/3.jpg");background-size:cover;background-position:center;background-repeat:no-repeat}
    .main-banner #imgban2{background-image:url("img/slide/2.jpg");background-size:cover;background-position:center;background-repeat:no-repeat}
    .main-banner #imgban1{background-image:url("img/slide/1.jpg");background-size:cover;background-position:center;background-repeat:no-repeat}
    .imgbanbtn{width:40px;height:40px;background-color:black;border-radius:25px;position:absolute;top:250px;z-index:3000;opacity:0.8;cursor:pointer}
    .imgbanbtn:hover{opacity:1}
    .imgbanbtn-prev{left:1em;background-image:url("img/slide/prev.png");background-size:60%;background-position:center;background-repeat:no-repeat}
    .imgbanbtn-next{right:1em;background-image:url("img/slide/next.png");background-size:60%;background-position:center;background-repeat:no-repeat}
</style>