<?php
require_once "entete.php";
$Bibli = new Bibliotheque();

?>
<?php
try {
    $genres = $Bibli->getGenres();
} catch (Exception $e) {
    ?>
    <div class="alert alert-danger">
        Erreur lors de la récupération des genres
    </div>
    <?php
}
try {
    $editeurs = $Bibli->getEditeurs();
} catch (Exception $e) {
    ?>
    <div class="alert alert-danger">
        Erreur lors de la récupération des genres
    </div>
    <?php
}
try {
     $auteurs =  $Bibli->getAuteurs();
} catch (Exception $e) {
    ?>
    <div class="alert alert-danger">
        Erreur lors de la récupération des auteurs
    </div>
    <?php
}
try {
    $Livres = $Bibli->getLivres();
} catch (Exception $e) {
    ?>
    <div class="alert alert-danger">
        Erreur lors de la récupération des livres
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
  }else if(isset($_GET["success"])&& $_GET['success'] == 21 ){
    ?>
        <div class="alert alert-danger mt-3">
            La photo doit être au format JPG ou PNG<br>
        </div>
    <?php
    }else if(isset($_GET["success"])&& $_GET['success'] == 22 ){
        ?>
            <div class="alert alert-danger mt-3">
               La photo ne doit pas faire plus de 5 mb<br>
            </div>
        <?php
    }else if(isset($_GET["success"])&& $_GET['success'] == 23 ){
        ?>
            <div class="alert alert-danger mt-3">
               La dimension de la photo est impossible à récupérer<br>
            </div>
        <?php
    }
?>
<div class="container rounded my-5" style="background-color:white; box-shadow: 1px 1px 15px black;">
<h1 class="text-center" style="padding-top: 2%;">Ajout d'un nouveau produit</h1>
<form method="post" class="form" enctype="multipart/form-data" action="../traitement/ajoutLivres.php"> 

    <div class="form-group mt-1">
        <label for="photo">Couverture du livre</label>
        <input type="file" class="form-control w-100" name="photo" id="photo" >
    </div>

    <div class="form-group mt-1">
        <label for="titre">Titre</label>
        <input type="textarea" class="form-control" name="titre" placeholder="Saisissez le titre du livre">
    </div>

    <div class="form-group mt-1">
        <label for="description">Résumé</label>
        <input type="text" class="form-control" name="description" placeholder="Saisissez le résumé du livre">
    </div>

    <div class="form-group mt-1" id="nouvAuteur">
        <label for="auteur">Auteur</label>
        <input type="text" class="form-control" name="auteur" id="inputAuteur" placeholder="Saisissez l'auteur du livre">
    </div>

    <div class="form-check form-switch my-3">
  <input class="form-check-input" type="checkbox" id="auteurEnregistré">
  <label class="form-check-label" for="flexSwitchCheckDefault">Auteur déjà enregistré ?</label>
    </div>

    <div class="form-group mt-1" id="nouvEditeur">
        <label for="editeur">Editeur</label>
        <input type="text" class="form-control" id="inputEditeur" name="editeur" placeholder="Saisissez l'éditeur du livre">
    </div>

    <div class="form-check form-switch my-3">
  <input class="form-check-input" type="checkbox" id="editeurEnregistré">
  <label class="form-check-label" for="flexSwitchCheckDefault">Editeur déjà enregistré ?</label>
    </div>

    <div class="row mt-1">
        <div class="col-4">
        <label for="date">Date de parution</label>
        <input type="date" class="form-control" name="date" placeholder="Saisissez la date de sortie du livre">
        </div>
    </div>

    <div class="form-group mt-1">
        <label for="prixAjout">Prix</label>
        <input type="number" class="form-control" id="prixAjout" name="prix" min="0.00" placeholder="Saisissez le prix du livre (chiffre uniquement, pas de symboles)" step="0.01"">
    </div>    

    <div class="form-group mt-1" id="auteur" style="display: none;">
        <label for="auteurs">Si le ou les auteur(s) est/sont déjà dans la base de données</label>
        <select name="auteurs" id="auteurs" disabled class="form-control">
                    ?>
                    <option value="0">Pas dans la base de données</option>
                    <?php
    foreach ($auteurs as $a) {
        ?>
                            <option
                            value="<?=$a->getIdAuteur();?>">
                            <?=$a->getNomAuteur();?>
                        </option>
                        <?php
    }
    ?>
                </select>
            </div>
            
            <div class="form-group mt-1" id="editeur" style="display: none;">
                <label for="editeurs">Si l'éditeur est déjà dans la base de données</label>
                <select name="editeurs" id="editeurs" disabled class="form-control">
                    ?>
                    <option value="0">Pas dans la base de données</option>
                    <?php
    foreach ($editeurs as $editeur) {
        ?>
                            <option
                            value="<?=$editeur->getIdEditeur();?>">
                            <?=$editeur->getNomEditeur();?>
                        </option>
                        <?php
    }
    ?>
                </select>
            </div>
            <div class="form-group mt-1">
                <label for="genre">Genre de l'oeuvre</label>
                <select name="genre" id="genre" class="form-control">
                <option selected disabled>Selectionner un Genre</option>
                    <?php
                    foreach ($genres as $genre) {
                        ?>
                                            <option
                                            value="<?=$genre->getIdGenre();?>">
                                            <?=$genre->getNomGenre();?>
                                        </option>
                                        <?php
                    }
                    ?>
                </select>
                <label for="typeGenre">sous-genre de l'oeuvre</label>
                <select name="typeGenre" id="typeGenre" class="form-control">
                    <option selected disabled>Selectionner un sous-genre</option>
                    <?php
                    foreach ($genres as $genre) {
                        foreach($genre->gettypeGenre() as $tp){
                        ?>
                            <option data-idGenre="<?=$tp->getIdGenre();?>"
                                            value="<?=$tp->getIdTypeGenre();?>">
                                <?=$tp->getLibelle();?>
                            </option>
                                        <?php
                        }
                    }
                    ?>
                </select>

                            <div class="form-group" id="numerique">
                                <label for="numerique">Entrez le pdf du livre numérique</label>
                                <input type="file" class="form-control" id="inputGroupFile01" name="numerique">
                            </div>  
                
                <div class="form-group mt-1 text-center">
                    <button type="submit" class="btn btn-primary my-4">Ajouter le livre</button>
                </div>
                
                
            </div>
        </form>
    </div>
    
    <?php

require_once 'pied.php';
