<?php
require_once 'entete.php';
?>
<?php
$BibliAudio=new Bibliotheque();
try{
$livresAudio = $BibliAudio->getBibliAudio();
}catch (Exception $e){
    ?><div class="alert alert-danger"> Erreur lors de la récupération des livres audio</div>
    <?php
    echo $e->getMessage();
}

if(count($livresAudio)>=1){
    ?>
    <?php
    if(count($livresAudio)==1){
        ?>
    <div class="alert alert-warning text-center">Il y a <?=count($livresAudio);?> livre audio</div>
    <?php
    }else if(count($livresAudio)>1){
        ?>
    <div class="alert alert-warning text-center">Il y a <?=count($livresAudio);?> livres audio</div>
    <?php
    }
    ?>
    <div class="card-group">
    <?php
      foreach($livresAudio as $livre){  
        ?>
        <div class="card mx-3 my-5"style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none;">
            <img  class="card-img-top" style="max-height:340px" src="<?=$livre["Photo"]?>">
          <div class="card-body" id="card" style="min-height:105px;">
              <h6 class="card-title"><?=$livre["Titre"]?></h6>
          </div>
          <div class="card-footer">
            <a href="pageProduit.php?idLivre=<?=$livre["idLivre"]?>"> <button  class="btn btn-success mx-5">Voir le produit</button></a> 
          </div>
        </div>
        <?php
          }
        }else if($livresAudio == false){
            ?>
            <div class="alert alert-warning text-center">Il n'y a pas encore de livre audio disponible.
             Cette section sera bientôt alimentée ! </div>
             <audio controls preload="auto" src="https://archive.org/embed/jane-austen-_-emma-l-3"></audio>
            <?php
}
?>
</div>
