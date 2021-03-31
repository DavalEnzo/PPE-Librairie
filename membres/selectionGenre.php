<?php
require_once 'entete.php';

if(isset($_GET['idGenre']) && !empty($_GET['idGenre'])){
    $idGenre= $_GET['idGenre'];
}

$livres=filtreGenre($idGenre);

?>
<div class="alert alert-info">
 <?php
    if(count($livres)<2){
        ?>
        Ce genre contient <?=count($livres);?> livres.
        <?php
    }else{
        ?>
        Cette catégorie contient <?=count($livres);?> livres.
        <?php
    }
?>
</div>
<div class="card-group">
<?php

foreach($livres as $livre){
    ?>
<div class="card mx-3 my-5 cardlivre"
                style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none">

                <img  class="card-img-top" style="max-height:340px;" src="<?=$livre["Photo"]?>">

            <div class="card-body" style="min-height:105px" id="card">
                <h8 class="card-title"><?=$livre["Titre"]?></h8>
                <?php
                if($livre['Prix']== 0.00){
                    ?>
                    <p>Libre de droit</p>
                <?php
                }else{
                    ?>
                    
                <p class="card-text"><?=$livre["Prix"]?> €</p>
             <?php 
               }
             ?>
            </div>

            <div class="card-footer hide">
                <a href="pageProduit.php?idLivre=<?=$livre["idLivre"]?>"> <button  class="btn btn-success mx-5">Voir le produit</button></a> 
            </div>

    </div>
<?php
}
?>
</div>
<?php
require_once 'pied.php';