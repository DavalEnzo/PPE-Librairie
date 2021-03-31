<?php
require_once "entete.php";
?>
<?php
try {
    $genres = selectGenre();
} catch (Exception $e) {
    ?>
    <div class="alert alert-danger">
        Erreur lors de la récupération des genres
    </div>
    <?php
}
try {
    $auteurs = selectAuteur();
} catch (Exception $e) {
    ?>
    <div class="alert alert-danger">
        Erreur lors de la récupération des auteurs
    </div>
    <?php
}
try {
    $bilio = selectBibli();
} catch (Exception $e) {
    ?>
    <div class="alert alert-danger">
        Erreur lors de la récupération des auteurs
    </div>
    <?php
}  
if(isset($_GET["success"])&& $_GET['success'] == 1 ){
    ?>
      <div class="alert alert-success mt-3">
        Le formulaire a bien été enregistré
        </div>
      <?php 
  }else if(isset($_GET["success"])&& $_GET['success'] == 0 ){
      ?>
        <div class="alert alert-danger mt-3">
        Le formulaire n'a pas pu être enregistré !<br>
        </div>
      <?php
  }

?>
<div class="container">
<h1 class="text-center">Ajout d'un nouveau produit</h1>
<form method="post" class="form" action="../traitement/ajoutLivres.php"> 

    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="text" class="form-control w-100" name="photo" id="photo" placeholder="Entrez le lien de l'image">
    </div>

    <div class="form-group">
        <label for="auteur">Auteur (ne rien écrire si le/les auteur(s) est/sont déjà dans la base de données)</label>
        <input type="text" class="form-control" name="auteur" placeholder="Saisissez l'auteur du livre">
    </div>

    <div class="form-group">
        <label for="titre">Titre</label>
        <input type="text" class="form-control" name="titre" placeholder="Saisissez le titre du livre">
    </div>
    <div class="form-group">
        <label for="editeur">Editeur</label>
        <input type="text" class="form-control" name="editeur" placeholder="Saisissez l'éditeur du livre">
    </div>

    <div class="form-group">
        <label for="date">Date de parution</label>
        <input type="text" class="form-control" name="date" placeholder="Saisissez la date de sortie du livre (jj-mm-aaaa)">
    </div>

    <div class="form-group">
        <label for="prix">Prix</label>
        <input type="number" class="form-control" name="prix" placeholder="Saisissez le prix du livre" step="0.01" value="0.00">
        <br>
    </div>    
    <div class="form-group">
            <label for="auteurs">Si le ou les auteur(s) est/sont déjà dans la base de données</label>
                <select name="auteurs" id="auteurs" class="form-control">
                    ?>
                    <option value="0">Pas dans la base de données</option>
                    <?php
    foreach ($auteurs as $a) {
        ?>
                            <option
                            value="<?=$a["idAuteur"];?>">
                            <?=$a["nom"];?>
                            </option>
                            <?php
    }
    ?>
                </select>
    <div class="form-group">
            <label for="genre">Genre de l'oeuvre</label>
                <select name="genre" id="genre" class="form-control">
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
        <div class="form-check" style="margin-left: 43%; margin-top: 2%;">
        <input class="form-check-input" type="checkbox" value="1" id="audio" name="audio">
        <label class="form-check-label" for="audio">
        Est-ce un livre audio ?
        </label>
        </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary my-4">Ajouter le livre</button>
    </div>


            </div>
</form>