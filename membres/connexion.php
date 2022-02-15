<?php 
if(isset($_GET["success"])&& $_GET['success'] == 1 ){
        header("Refresh:3;index.php");
        require_once 'entete.php';
        ?>
        <div class="alert alert-success mt-3">Connexion réussie ! Connecté en tant que <?=$_SESSION['email'];?><br>
        <a href="index.php">Cliquez ici pour revenir à l'accueil</a>
    </div>
        <?php        
    }else if(isset($_GET["success"])&& $_GET['success'] == 0 ){
        require_once 'entete.php';
        ?>        
        <div class="alert alert-danger">La connexion n'a pas pu être finalisée<br>
        Erreur: <?= $_GET['erreurs'];?></div>
        <?php
    }
        require_once 'entete.php';
      ?>
      
    <div class="container my-5">
    <div class="rounded" style="background-color: white; width:50%; margin:auto; padding:2%; box-shadow: 1px 1px 10px black;">
    <h1>Se connecter</h1>
    <form method="post" action="../traitement/connexions.php">
        <div class="form-group rounded">
            <label for="email">Adresse Mail</label>
            <input type="text" class="form-control" style="border-radius: 20px;" name="email" id="email" placeholder="Saisissez votre adresse mail" value="<?=(isset($_POST["email"]) ? $_POST["email"] : "")?>" required/>
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe</label>
            <input type="password" class="form-control" style="border-radius: 20px;" name="mdp" id="mdp" placeholder="Saisissez votre mot de passe" value="<?=(isset($_POST["mdp"]) ? $_POST["mdp"] : "")?>" required/>
        </div>
        <div class="form-check mt-2 mx-3">
            <input class="form-check-input" type="checkbox" name="souvenir" id="souvenir"  value="1" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Se souvenir de moi
            </label><br>
            <span><i class="fas fa-exclamation-triangle" id="exclamation" style="color: red; display:none"></i></span>
            <span id="avertissement"></span>
            </div>
        <div class="form-group text-center my-2">
            <button type="submit" class="btn-balayage" style="border-radius: 20px;" name="envoi" value="1">Connexion</button>
        </div>
    </form>
    </div>
    </div>
    <div style="margin-top: 13.97%;">
    <?php
    require_once 'pied.php';
    ?>
    </div>
    <?php

