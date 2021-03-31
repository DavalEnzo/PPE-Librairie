<?php
require_once "entete.php";

if(isset($_GET["success"])&& $_GET['success'] == 1 ){
    ?>
      <div class="alert alert-success mt-3">Connexion réussie ! Connecté en tant que <?=$_SESSION['email'];?></div>
      
      <?php
      header("refresh:3;index.php"); 
  }else if(isset($_GET["success"])&& $_GET['success'] == 0 ){
      ?>
      <div class="alert alert-danger">La connexion n'a pas pu être finalisée, veuillez contacter un administrateur<br>
      Erreur: <?= $_GET['erreurs'];?></div>
      <?php
  }
?>
    <div class="container">
    <h1>Formulaire de connexion</h1>
    <form method="post" action="../traitement/connexions.php">
        <div class="form-group">
            <label for="email">Adresse Mail</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Saisissez votre adresse mail" value="<?=(isset($_POST["email"]) ? $_POST["email"] : "")?>" required/>
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe</label>
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" value="<?=(isset($_POST["mdp"]) ? $_POST["mdp"] : "")?>" required/>
        </div>
        <div class="form-group text-center my-2">
            <button type="submit" class="btn btn-success" name="envoi" value="1">Connexion</button>
        </div>
    </form>
    </div>