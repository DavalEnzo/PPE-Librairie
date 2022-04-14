<?php
require_once 'entete.php';
$e=new Bibliotheque();
$editeurs=$e->getEditeurs();
?>
<div class="alert alert-secondary text-center">
  <h1>Page de sélection des livres selon l'éditeur</h1>
</div>

<ul class="list-group rouded-pill">
    <p class="list-group-item text-center" style="width: 100%; margin:auto">Editeurs</p>
  </ul>
<?php

foreach($editeurs as $editeur){
    ?>
  <ul class="list-group rounded-pill text-center my-2" style="width: 100%;">
    <a href="selectionEditeur.php?idEditeur=<?=$editeur->getIdEditeur();?>" class="list-group-item btn-grad" style="text-decoration:none; color:black;margin:auto;"><?=$editeur->getNomEditeur();?></a>
    </ul>
<?php
}
?>
<?php

require_once 'pied.php';