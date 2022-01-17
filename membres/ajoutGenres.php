<?php require_once 'entete.php';

if(isset($_GET["success"])&& $_GET['success'] == 1 ){
    ?>
      <div class="alert alert-success mt-3">Le genre <?=$_GET["nomGenre"];?> a été ajouté</div>
      <?php 
  }else if(isset($_GET["success"])&& $_GET['success'] == 0 ){
      ?>
      <div class="alert alert-danger">Le genre ou le type de genre n'a pas pu être ajouté</div>
      <?php
  }
if(isset($_GET["success"])&& $_GET['success'] == 2 ){
    ?>
      <div class="alert alert-success mt-3">Le type de genre <?=$_GET["typeGenre"];?> a été ajouté</div>
      <?php 
}

 $g= new Genre();
 $genres=$g->getTousGenres();
    ?>

<form method="post" action="../traitement/ajoutGenre.php">
<div class="form-group my-2" style="width: 25%; margin:auto;">
<div class="text-center">
<label for="genre">Genre de l'oeuvre</label>
</div>
<input type="text" class="form-control my-2" name="nomGenre" id="nomGenre" placeholder="Saisissez le genre">
</div>

<div class="form-group text-center">
<button type="submit" class="btn btn-primary my-1">Ajouter un genre</button>
</div>
</form>

<form method="post" action="../traitement/ajoutTypegenre.php">
<div class="form-group my-2" style="width: 25%; margin:auto;">
<div class="text-center my-2">
<label for="typeGenre" class="text-center">Type de genre</label>
</div>
<input type="text" class="form-control" name="typeGenre" id="typeGenre" placeholder="Saisissez le type de genre">

<div class="form-group text-center">
                <select name="genre" id="genre" class="form-control my-2">
                    <?php
    foreach ($genres as $genre) {
        ?>
                            <option
                            value="<?=$genre["idGenre"];?>">
                            <?=$genre["nomGenre"];?>
                            </option>
                            <?php
    }
    ?>
</select>
<button type="submit" class="btn btn-primary my-2">Ajouter le type en fonction de son genre</button>
</div>
</form>

<?php
require_once 'pied.php';