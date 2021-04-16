<?php

require_once 'entete.php';
if(isset($_GET["id"]) &&!empty($_GET['id'])){
    $idLivre = $_GET["id"];
    $lectures = new Lecture($idLivre);
}else{
    header("index.php");
}
?>
<div style="background-color: black;">
    <div class="container" style="height:100vh">
        <embed src="<?=$lectures->getLivre()?>" type="application/pdf" class='w-100 h-100'>
    </div>
</div>