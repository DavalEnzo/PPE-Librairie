<?php
require_once 'entete.php';
$e=new Editeur();
$editeurs=$e->getTousEditeurs();
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
  <ul class="list-group rounded-pill text-center my-2">
    <a href="selectionEditeur.php?idEditeur=<?=$editeur['idEditeur'];?>" class="list-group-item btn-grad" style="text-decoration:none; color:black; width:20%;margin:auto;"><?=$editeur['nom'];?></a>
    </ul>
<?php
}
?>