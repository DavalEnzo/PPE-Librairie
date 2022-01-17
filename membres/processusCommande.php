<?php require_once 'entete.php'
;?>

  <div class="alert alert-dark">
    <h2 class="text-center">Processus de commande</h2>
  </div>

  <div class="container rounded my-5" style="background-color:white; box-shadow: 1px 1px 15px black;">
  <div class="card">
  <div class="card-body">
    <h3>Coordonnées</h3>
    <?php
    if(isset($_POST['pays']) && !empty($_POST['pays']) 
    && isset($_POST['nomComplet']) && !empty($_POST['nomComplet']) 
    && isset($_POST['telephone']) && !empty($_POST['telephone']) 
    && isset($_POST['adresse']) && !empty($_POST['adresse']) 
    && isset($_POST['codePostal']) && !empty($_POST['codePostal']) 
    && isset($_POST['ville']) && !empty($_POST['ville'])){
    ?>
    <div class="card">
      <div class="card-body">
        <p style="display: inline-block;">Nom et prénom: <?=$_POST['nomComplet'];?></p><br>
        <p style="display: inline-block;">Adresse: <?=$_POST['adresse'];?>, <?=$_POST['codePostal'];?>, <?=$_POST['ville'];?>, <?=$_POST['pays'];?></p>
        <img style="display: inline-block; width:3%" src="https://i.imgur.com/QWxX3tt.gif">
      </div>
    </div>
    <?php
    }else{
      ?>
      <p>Aucune adresse insérée</p>
      <?php
    }
    ?>
    <button type="button" name="modifCoordonnees" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#coordonnees" style="text-decoration: blue;">Modifier</button>
  </div>

  <div class="modal fade" id="coordonnees" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Coordonnées</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="../traitement/enregisterInformationsCommande.php">
        <div class="modal-body">
      <div class="form-group mt-1">
        <label for="pays">Pays</label>
        <input type="text" class="form-control w-100" readonly name="pays" id="pays" value="France">
    </div>

    <div class="form-group mt-1">
        <label for="nomComplet">Nom et prénom</label>
        <input type="text" class="form-control" name="nomComplet" value="<?=(isset($_POST["nomComplet"]) ? $_POST["nomComplet"] : "");?>" placeholder="Saisissez votre nom complet">
    </div>

    <div class="form-group mt-1">
        <label for="telephone">Téléphone</label>
        <input type="text" class="form-control" name="telephone" value="<?=(isset($_POST["telephone"]) ? $_POST["telephone"] : "");?>" placeholder="Saisissez votre numéro de téléphone">
    </div>
    <div class="form-group mt-1">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" value="<?=(isset($_POST["adresse"]) ? $_POST["adresse"] : "");?>" name="adresse" placeholder="Saisissez votre adresse">
    </div>
    <div class="form-group mt-1">
        <label for="codePostal">Code postal</label>
        <input type="text" class="form-control" value="<?=(isset($_POST["codePostal"]) ? $_POST["codePostal"] : "");?>" name="codePostal" placeholder="Saisissez votre Code postal">
    </div>
    <div class="form-group mt-1">
        <label for="editeur">Ville</label>
        <input type="text" class="form-control" value="<?=(isset($_POST["ville"]) ? $_POST["ville"] : "");?>" name="ville" placeholder="Saisissez votre ville">
    </div>
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
        </div>
      </div>
    </div>
        </form>
  </div>


<form method="POST" class="form" action="../traitement/enregisterInformationsCommande.php" style="margin-top:1.5%"> 
<div class="card">
  <div class="card-body">
    <h3>Moyen de paiement</h3>
    <?php
    if(isset($_POST['pays']) && !empty($_POST['pays']) 
    && isset($_POST['nomComplet']) && !empty($_POST['nomComplet']) 
    && isset($_POST['telephone']) && !empty($_POST['telephone']) 
    && isset($_POST['adresse']) && !empty($_POST['adresse']) 
    && isset($_POST['codePostal']) && !empty($_POST['codePostal']) 
    && isset($_POST['ville']) && !empty($_POST['ville'])){
    ?>
    <div class="card">
      <div class="card-body">
        <p style="display: inline-block;">Nom et prénom: <?=$_POST['nomComplet'];?></p><br>
        <p style="display: inline-block;">Adresse: <?=$_POST['adresse'];?>, <?=$_POST['codePostal'];?>, <?=$_POST['ville'];?>, <?=$_POST['pays'];?></p>
        <img style="display: inline-block; width:3%" src="https://i.imgur.com/QWxX3tt.gif">
      </div>
    </div>
    <?php
    }else{
      ?>
      <p>Aucun moyen de paiement inséré</p>
      <?php
    }
    ?>
    <button type="button" name="modifCoordonneesBancaire" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#coordonneesBancaire" style="text-decoration: blue;">Modifier</button>
  </div>

  <div class="modal fade" id="coordonneesBancaire" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Moyen de paiement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
      <div class="form-group mt-1">
        <label for="pays">Pays</label>
        <input type="text" class="form-control w-100" readonly name="pays" id="pays" value="France">
    </div>
    
    <div class="form-group mt-1">
        <label for="telephone">Numéro de carte</label>
        <input type="text" class="form-control" name="cb" value="<?=(isset($_POST["cb"]) ? $_POST["cb"] : "");?>" placeholder="Saisissez votre numéro de carte bancaire">
    </div>

    <div class="form-group mt-1">
        <label for="nomComplet">Nom et prénom du titulaire de la carte</label>
        <input type="text" class="form-control" name="nomCb" value="<?=(isset($_POST["nomCb"]) ? $_POST["nomCb"] : "");?>" placeholder="Saisissez votre nom complet">
    </div>
    <div class="form-group mt-1">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" value="<?=(isset($_POST["adresse"]) ? $_POST["adresse"] : "");?>" name="adresse" placeholder="Saisissez votre adresse">
    </div>
    <div class="form-group mt-1">
        <label for="codePostal">Code postal</label>
        <input type="text" class="form-control" value="<?=(isset($_POST["codePostal"]) ? $_POST["codePostal"] : "");?>" name="codePostal" placeholder="Saisissez votre Code postal">
    </div>
    <div class="form-group mt-1">
        <label for="editeur">Ville</label>
        <input type="text" class="form-control" value="<?=(isset($_POST["ville"]) ? $_POST["ville"] : "");?>" name="ville" placeholder="Saisissez votre ville">
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
        </div>
      </div>
    </div>
        </form>
    </div>
  </div>
  </div>
<?php

require_once 'pied.php';
?>