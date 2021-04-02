<?php
require_once "entete.php";

if(isset($_GET["success"])&& $_GET['success'] == 1 ){
    ?>
        <div class="alert alert-success">
            Bienvenue dans la librairie Mr/Mme <?=$_GET['nom'];?> , votre inscription a été complétée.<br>
            <a href="index.php">Retour à l'accueil</a> 
        </div>
      <?php
      header("refresh:3;index.php");  
  }else if(isset($_GET["success"])&& $_GET['success'] == 0 ){
      ?>
          <div class="alert alert-danger">
                        Erreur: <?= $_GET['erreurs'];?>
            </div>
      <?php
  }
    ?>
    <div class="container my-3">
    <div class="rounded" style="background-color: white; width:50%; margin:auto; padding: 1% 2% 2% 2%;box-shadow: 1px 1px 10px black;">
        <h1 class="text-center my-3">Inscription</h1>
        <form method = "post" action="../Traitement/ajoutInscription.php"> 

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class ="form-control" style="border-radius: 20px;" name="nom" id="nom" placeholder="Saisissez votre nom" value="<?=(isset($_POST["nom"]) ? $_POST["nom"] : "");?>"/>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class ="form-control" style="border-radius: 20px;" name="prenom" id="prenom" placeholder="Saisissez votre prénom" value="<?=(isset($_POST["prenom"]) ? $_POST["prenom"] : "");?>"/>
            </div>
            <div class="form-group">
                <label for="email">Adresse Mail</label>
                <input type="text" class ="form-control" style="border-radius: 20px;" name="email" id="email" placeholder="Saisissez votre email" value="<?=(isset($_POST["email"]) ? $_POST["email"] : "");?>"/>
            </div>
        
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" class ="form-control" style="border-radius: 20px;" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" value="<?=(isset($_POST["mdp"]) ? $_POST["mdp"] : "");?>"/>
            </div>
        
            
        <div class="text-center my-2">
        <button type="submit" class="btn-balayage" name="envoi" value ="1">Inscription</button>
        </div>
        </form>
    </div>
    </div>