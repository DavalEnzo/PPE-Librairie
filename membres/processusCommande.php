<?php require_once 'entete.php';
;?>

<?php
    if(isset($_GET['success']) && !empty($_GET['success'])){
        require_once 'entete.php';
        if($_GET['success'] == 1){
            ?>
            <div class="alert alert-success">Votre commande a bien été enregistrée !
        </div>
            <?php        
      }else if($_GET['success'] == 0 ){
        ?>        
        <div class="alert alert-danger">La commande n'a pas pu être enregistrée, veuillez contacter un administrateur.<br></div>
        <?php
      }else if($_GET['success'] == 2 ){
        ?>        
        <div class="alert alert-danger">Format du code CVC incorrect. Il doit être uniquement composé de chiffres et ne doit pas faire plus de 3 chiffres</div>
        <?php
      }else if($_GET['success'] == 3 ){
        ?>        
        <div class="alert alert-danger">Format du code de carte bancaire incorrect. Il doit être uniquement composé de chiffres et ne doit pas faire plus de 16 chiffres</div>
        <?php
      }else if($_GET['success'] == 4 ){
        ?>        
        <div class="alert alert-danger">Le nom de ville doit être composé de caractères alphanumériques (ex: A) seulement</div>
        <?php
      }else if($_GET['success'] == 5 ){
        ?>        
        <div class="alert alert-danger">Format du code postal incorrect. Il doit être uniquement composé de chiffres et il ne doit pas faire plus de 5 chiffres</div>
        <?php
      }else if($_GET['success'] == 6 ){
        ?>        
        <div class="alert alert-danger">Format du numéro de téléphone incorrect. Il doit être uniquement composé de chiffres et ne doit pas faire plus de 10 chiffres</div>
        <?php
      }else if($_GET['success'] == 7 ){
        ?>        
        <div class="alert alert-danger">Un des champs n'a pas été rempli</div>
        <?php
    }
  }
?>

<?php
    $idPanier = $_SESSION['idPanier'];
    $Panier = new Panier($idPanier, $_SESSION['idUtilisateur']);
    $recupPanier = $Panier->getPanier();
?>

  <div class="alert alert-dark">
    <h2 class="text-center underline"><u>Processus de commande</u></h2>
  </div>
  
  <div class="container rounded" style="background-color:white; box-shadow: 1px 1px 15px black; padding-top:1%; margin-left:13%; padding-bottom:0.1%">
    <h1 class="text-center mb-4">Vos informations</h1>
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

  <form method="POST" action="../traitement/ajoutCommande.php">
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
        <input type="text" class="form-control w-100" readonly id="pays" name="pays" value="France">
    </div>

    <div class="form-group mt-1">
        <label for="nomComplet">Nom et prénom</label>
        <input type="text" class="form-control" id="nomComplet" name="nomComplet" placeholder="Saisissez votre nom complet">
    </div>

    <div class="form-group mt-1">
        <label for="telephone">Téléphone</label>
        <input type="text" class="form-control" id="telephone" name="telephone" maxlength="10" value="<?=(isset($_POST["telephone"]) ? $_POST["telephone"] : "");?>" placeholder="Saisissez votre numéro de téléphone">
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
      <span id="insertionMoyenPaiement">Aucun moyen de paiment inséré</span><br>
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
        <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" id="enregistrerCb" class="btn btn-primary" data-bs-dismiss="modal">Enregistrer</button>
      </div>
        </div>
      </div>
    </div>
    </div>
    <h2 class="text-center" style="margin-bottom: 2%;"><u>Résumé de la commande</u></h2>
    <h2 style="color: green; font-weight:bold; text-decoration:underline;">Date de livraison estimée : <?=date('d/m/Y', strtotime('10 days'));?></h2>
    <?php
    foreach($recupPanier as $panier){
      ?>
      <input style="display: none;" name="idLivre[]" type="text" value="<?=$panier['idLivre'];?>">
      <input style="display: none;" name="quantite[]" type="text" value="<?=$panier['quantite'];?>">
      <div class="card mb-3 my-3 container cardlivre" style="max-width: 1400px; height: 230px;">
        <div class="row g-0">
          <div class="col-md-1">
            <img class="imgCard" src="<?=$panier['Photo'];?>" style="max-height: 228px; width:182px" class="rounded-start" alt="...">
          </div>
          <div class="col-md-10" style="margin-left: 2%;">
            <div class="card-body" style="margin-left: 5%;">
              <h5 class="card-title"><?=$panier['Titre'];?></h5>
              <h5 class="card-subtitle text-muted mb-4"><?=$panier['nomEditeur'];?></h5>
              <p style="font-size: 20px;" class="card-subtitle">Quantité: <?=$panier['quantite'];?></p>
              <p class="card-text">Prix total: <?=$panier['Prix'] * $panier['quantite'];?>€</p>
              <input type="text" style="display: none;" name="prixTotal" value="<?=$panier['Prix'] * $panier['quantite'];?>"></input>
              
            </div>
          </div>
        </div>
    </div>
    <?php
}
?>
</div>
  </div>

  <div class="card container" style="margin-left:13%; margin-bottom:1%; margin-top:1%">
    <div class="card-body">
      <?php
        $total = 0;
          foreach($recupPanier as $detailCommande){
        $total += $detailCommande['Prix']*$detailCommande['quantite'];
      }
      ?>

    <h4 style="color: #50C878; margin-bottom:0">Total à payer: <?=$total;?>€</h4><br>
    <button type="submit" class="btn btn-success">Compléter la commande et payer</button>
    </div>
  </div>
  </div>


  <div class="card" id="scroll" style="margin-left: 83%;">
    <div class="card-body">
      <h5 class="card-title text-center">Paiement</h5>
      <div style="border: 1px solid black;"></div>
      <h4 class="card-text text-center my-2">Détails de commande</h4>
      <h5 style="margin-left: 3%;">Livres:</h5>
      <?php
        $total = 0;
          foreach($recupPanier as $detailCommande){
        ?>
        <p style="font-size: 15px;">x<?=$detailCommande['quantite'];?> <?=$detailCommande['Titre'];?>: <?=$detailCommande['Prix']*$detailCommande['quantite'];?>€</p>
        <?php
        $total += $detailCommande['Prix']*$detailCommande['quantite'];
      }
      ?>
      <div style="border: 1px solid black; margin-bottom:5%"></div>

      <h4 style="color: #50C878;">Total à payer: <?=$total;?>€</h4>
      <button type="submit" class="btn btn-success">Compléter la commande et payer</button>
    </div>
  </div>
  </form>
</div>


<?php

require_once 'pied.php';
?>