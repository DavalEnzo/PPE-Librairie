<?php
require_once 'entete.php';

if(isset($_GET['idTypeGenre']) && !empty($_GET['idTypeGenre'])){
    $idTypeGenre= $_GET['idTypeGenre'];
}

$tgenre =    new TypeGenre($idTypeGenre);
$tgenre->initLivreTypeGenre($idTypeGenre);
$livresGenre = $tgenre->getLivre();
$arrObj = new ArrayObject($livresGenre);


?>
<main style="min-height:70vh">
<div class="alert alert-info">
 <?php
    if($arrObj->count()<2){
        ?>
        Ce genre contient <?=$arrObj->count();?> livres.
        <?php
    }else{
        ?>
        Cette catégorie contient <?=$arrObj->count();?> livres.
        <?php
    }
?>
</div>
<div class="card-group">
<?php

foreach($livresGenre as $livre){
    ?>
<div class="card mx-3 my-5 cardlivre"
                style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none">
                <a style="text-decoration: none; color:black" href="pageProduit.php?idLivre=<?=$livre->getIdLivre()?>">

                <img  class="card-img-top imgCard" style="max-height:340px;" src="<?=$livre->getPhoto()?>">

            <div class="card-body" style="min-height:105px" id="card">
                <h8 class="card-title"><?=$livre->getTitre()?></h8>
                <?php
                if($livre->getPrix()== 0.00){
                    ?>
                    <p><strong>Libre de droit</strong></p>
                <?php
                }else{
                    ?>
                    
                <p class="card-text"><strong><?=$livre->getPrix()?> €</strong></p>
             <?php 
               }
             ?>
        </a> 
            </div>


    </div>
<?php
}
?>
</div>
</main>
<?php
require_once 'pied.php';