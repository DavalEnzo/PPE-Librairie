<?php
require_once 'entete.php';

if(isset($_GET["id"]) &&!empty($_GET['id'])){
    $idLivre = $_GET["id"];
    $lectures = selectLectureid($idLivre);
}else{
    header("index.php");
}
    ?>
<div style="background-color: black;">
    <div class="container">
        <embed src="<?=$lectures['contenu']?>" type="application/pdf" class='w-100 h-100'>
    </div>
</div>