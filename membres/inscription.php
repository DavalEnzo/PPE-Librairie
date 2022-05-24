<?php


if(isset($_GET["success"])&& $_GET['success'] == 1 ){
    header("refresh:3;index.php");  
    require_once "entete.php";
    ?>
        <div class="alert alert-success">
            Bienvenue dans la librairie Mr/Mme <?=$_GET['nom'];?> , votre inscription a été complétée.<br>
            <a href="index.php">Retour à l'accueil</a> 
        </div>
      <?php
  }else if(isset($_GET["success"])&& $_GET['success'] == 0 ){
      require_once 'entete.php';
      ?>
          <div class="alert alert-danger">
                        Erreur: <?= $_GET['erreurs'];?>
            </div>
      <?php
  }
  
    require_once 'entete.php';
    ?>
    <div class="container my-3">
    <div class="rounded" style="background-color: white; width:50%; margin:auto; padding: 1% 2% 2% 2%;box-shadow: 1px 1px 10px black;">
        <h1 class="text-center my-3">Inscription</h1>
        <form method = "post" action="../traitement/ajoutInscription.php">

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class ="form-control" style="border-radius: 20px;" name="nom" id="nom" placeholder="Saisissez votre nom" value="<?=(isset($_POST["nom"]) ? $_POST["nom"] : "");?>"required/>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class ="form-control" style="border-radius: 20px;" name="prenom" id="prenom" placeholder="Saisissez votre prénom" value="<?=(isset($_POST["prenom"]) ? $_POST["prenom"] : "");?>" required/>
            </div>
            <div class="form-group">
                <label for="email">Adresse Mail</label>
                <input type="email" class ="form-control" style="border-radius: 20px;" name="email" id="email" placeholder="Saisissez votre email" value="<?=(isset($_POST["email"]) ? $_POST["email"] : "");?>" required/>
            </div>
        
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" class ="form-control" style="border-radius: 20px;" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" value="<?=(isset($_POST["mdp"]) ? $_POST["mdp"] : "");?>" required/>
            </div>

            <div class="form-group">
                <label for="mdp">Confirmation mot de passe</label>
                <input type="password" class ="form-control" style="border-radius: 20px;" name="confirmMdp" id="confirmMdp" placeholder="Veuillez confirmer votre mot de passe" value="<?=(isset($_POST["confirmMdp"]) ? $_POST["confirmMdp"] : "");?>" required/>
            </div>
            <span id='message'></span>

            <div class="form-check checkbox1">
        <input class="form-check-input" type="checkbox" value="1" id="consentement" name="consentement" required>
        <label class="form-check-label" for="consentement">
        En cochant cette case, vous consentez au traitement de vos informations 
        personnelles comme expliqué dans les <a href="mentionsLegales.php">Mentions Légales</a>.
        </label>
        </div>

        
            
        <div class="text-center my-2">
        <button type="submit" class="btn-balayage" id="envoi" name="envoi" value ="1">Inscription</button>
        </div>
        </form>
    </div>
    </div>
    <?php
    require_once 'pied.php';
