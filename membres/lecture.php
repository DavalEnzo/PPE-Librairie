<?php

require_once 'entete.php';

if(isset($_GET["id"]) &&!empty($_GET['id'])){
    $idLivre = $_GET["id"];
    $lectures = new Lecture($idLivre);
}else{
    header("index.php");
}
?>

<style>
    .navbar{
        display: none;
    }
</style>

<div style="background-color: black;">
    <div class="container" style="height:100vh">
        <a href="pageProduit.php?idLivre=<?=$idLivre;?>"><i class="fas fa-long-arrow-alt-left fa-5x back"></i></a>    
        <embed src="<?=$lectures->getContenu()?>#zoom=60" type="application/pdf" class='w-100 h-100'>
    </div>
</div>
