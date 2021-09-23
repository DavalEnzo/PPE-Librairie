<?php
require_once "entete.php";
$BibliNum=new Bibliotheque();

$livrenums = $BibliNum->getBibliNum();
?>
<div class='card-group' style="margin-left: 10%;">
    <?php
    foreach($livrenums as $livrenum){
    ?>
    <div class="card mx-3 my-5 cardlivre"
                style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none" >

                <img  class="card-img-top" style="max-height:340px;" src="<?=$livrenum["Photo"]?>">

            <div class="card-body" style="min-height:105px" id="card" >
                <h8 class="card-title"><?=$livrenum["Titre"]?></h8>
                <?php
                if($livrenum['Prix']== 0.00){
                    ?>
                    <p>Libre de droit</p>
                <?php
                }else{
                    ?>
                    
                <p class="card-text"><?=$livrenum["Prix"]?> €</p>
             <?php 
               }
             ?>
            </div>

            <div class="card-footer hide">
                <a href="pageProduit.php?idLivre=<?=$livrenum["idLivre"]?>"> <button  class="btn btn-success mx-5">Voir le produit</button></a> 
            </div>

    </div>
<?php
}
?>
</div>
<?php
require_once 'pied.php';