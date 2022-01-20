<?php require_once 'entete.php'
;?>

  <div class="alert alert-dark">
    <h2 class="text-center">Processus de commande</h2>
  </div>

  <div class="container rounded" style="background-color:white; box-shadow: 1px 1px 15px black;">
  <div class="card">
  <div class="card-body">
    <h3>Coordonnées</h3>
    <div style="display: none;" id='coordonees' class="card">
      <div class="card-body">
        <input type="text" id="nomPrenom" style="display: inline-block; border:0px; background-color:white; width:100%" readonly=true></input><br>
        <input type="text" id="coordonneeValues" style="display: inline-block; border:0px; background-color:white; width:100%" readonly=true></input>
        <img style="display: inline-block; width:3%" src="https://i.imgur.com/QWxX3tt.gif">
      </div>
    </div>
      <span id="noAdresse">Aucune adresse insérée</span><br>

    <button type="button" name="modifCoordonnees" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#coordonnees" style="text-decoration: blue;">Modifier</button>
  </div>

  <form method="POST" action="../traitement/enregisterInformationsCommande.php">
  <div class="modal fade" id="coordonnees" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Coordonnées</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
      <div class="form-group mt-1">
        <label for="pays">Pays</label>
        <input type="text" class="form-control w-100" readonly name="pays" value="France">
    </div>

    <div class="form-group mt-1">
        <label for="nomComplet">Nom et prénom</label>
        <input type="text" class="form-control" id="nomComplet" name="nomComplet" placeholder="Saisissez votre nom complet">
    </div>

    <div class="form-group mt-1">
        <label for="telephone">Téléphone</label>
        <input type="text" class="form-control" id="telephone" name="telephone" value="<?=(isset($_POST["telephone"]) ? $_POST["telephone"] : "");?>" placeholder="Saisissez votre numéro de téléphone">
    </div>
    <div class="form-group mt-1">
        <label for="adresse">Adresse</label>
        <input type="text" class="form-control" id="adresse" value="<?=(isset($_POST["adresse"]) ? $_POST["adresse"] : "");?>" name="adresse" placeholder="Saisissez votre adresse">
    </div>
    <div class="form-group mt-1">
        <label for="codePostal">Code postal</label>
        <input type="text" class="form-control" id="codePostal" value="<?=(isset($_POST["codePostal"]) ? $_POST["codePostal"] : "");?>" name="codePostal" placeholder="Saisissez votre Code postal">
    </div>
    <div class="form-group mt-1">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" id="ville" value="<?=(isset($_POST["ville"]) ? $_POST["ville"] : "");?>" name="ville" placeholder="Saisissez votre ville">
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button id="enregistrerCoordonnees" type="button" class="btn btn-primary" data-bs-dismiss="modal">Enregistrer</button>
      </div>
        </div>
      </div>
    </div>
  </div>

<div class="card my-4">
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
              <label for="nomTitulaire">Nom et prénom du titulaire de la carte</label>
              <input type="text" id="nomTitulaire" class="form-control" name="nomCb" value="<?=(isset($_POST["nomCb"]) ? $_POST["nomCb"] : "");?>" placeholder="Saisissez votre nom complet">
          </div>

          <div class="form-group mt-1">
              <label for="numeroCb">Numéro de carte</label>
              <input type="text" id="numeroCb" class="form-control" name="cb" value="<?=(isset($_POST["cb"]) ? $_POST["cb"] : "");?>" placeholder="Saisissez votre numéro de carte bancaire" maxlength="16">
              <span id="msg"></span>
          </div>

          <div class="form-group" style="width: 82%; display:inline-block;">
        <label style="display: block;" for="dateCb">Date d'expiration</label>
        <select id="mois" style="display: inline-block;" class="form-select w-25" name="mois" placeholder="MM">
          <option selected>Mois</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>

        <p style="display: inline-block; font-size:32px">/</p>

        <select style="display: inline-block;" id="année" class="form-select w-25" name="annee" placeholder="YY">
          <option selected>Année</option>
          <?php 
          for ($i = date("Y"); $i <= date('Y-m-d', strtotime('+20 year')); $i++) {
            ?>
            <option value="<?=$i;?>"><?=$i;?></option>
            <?php
        }
        ;?>
        </select><br>

        <label for="cvc">Cryptogramme</label>
        <input type="text" style="width: 15%" id="cvc" class="form-control" name="cvc" value="<?=(isset($_POST["nomCb"]) ? $_POST["nomCb"] : "");?>" maxlength="3" placeholder="CVC">
        <span id="msgCvc"></span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Enregistrer</button>
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