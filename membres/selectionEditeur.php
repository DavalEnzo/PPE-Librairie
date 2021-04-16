<?php require_once 'entete.php';

if(isset($_GET['idEditeur']) && !empty($_GET['idEditeur'])){
    $idEditeur=$_GET['idEditeur'];
}
$e=new Editeur($idEditeur);
$editeurs=$e->getLEditeur();
$nom=$e->getLEditeur();

if(count($editeurs)!=0){
?>
<div class="alert alert-info">
<?php
foreach($nom as $n){}
 if(count($editeurs)<2){
     ?>
     L'éditeur <?=$n['nom'];?> possède <?=count($editeurs);?> livre.
     <?php
 }else{
     ?>
     L'éditeur <?=$n['nom'];?> possède <?=count($editeurs);?> livres.
     <?php
 }
?>
 </div>
 <?php
}else{
    ?>
    <div class="alert alert-warning">
    Cet éditeur ne possède aucun livre. Revenez plus tard !
    </div>
    <?php
}
?>
 <div class="card-group">
 <?php
    foreach($editeurs as $editeur){
?>
    <div class="card mx-3 my-5 cardlivre"
                style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none">

                <img  class="card-img-top" style="max-height:340px;" src="<?=$editeur["Photo"]?>">

            <div class="card-body" style="min-height:105px" id="card">
                <h8 class="card-title"><?=$editeur["Titre"]?></h8>
                <?php
                if($editeur['Prix']== 0.00){
                    ?>
                    <p>Libre de droit</p>
                <?php
                }else{
                    ?>
                    
                <p class="card-text"><?=$editeur["Prix"]?> €</p>
             <?php 
               }
             ?>
            </div>

            <div class="card-footer hide">
                <a href="pageProduit.php?idLivre=<?=$editeur["idLivre"]?>"> <button  class="btn btn-success mx-5">Voir le produit</button></a> 
            </div>

    </div>
<?php
    }
    ?>
    </div>
<?php
require_once 'pied.php';