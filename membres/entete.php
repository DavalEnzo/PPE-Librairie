<?php 
require_once '../modeles/modele.php';

?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" type="text/css" href="css/all.min.css"/>
    <script
			  src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>
    	
    <title>Boutique de Livres</title>
</head>
<body class="body">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">
      <img src="https://img2.freepng.fr/20180623/zv/kisspng-used-book-online-book-printing-publishing-book-publishing-5b2e15ab53d0f7.7402729415297468593433.jpg" alt="" width="45" height="30">
    </a>
    <a class="navbar-brand" href="index.php">Boutique de livres</a>
    <h1 style="color:white">|</h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="categorie.php">Catégories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="editeurs.php">Editeurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="offres.php">Offres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="audio.php">Audio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="numerique.php">Numérique</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="occasion.php">Occasion</a>
        </li>
      </ul>
      <ul class="navbar-nav mx-2 mb-2 mb-lg-0">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php 
        if(isset($_SESSION['idUtilisateur']) && !empty($_SESSION['idUtilisateur'])){
          ?>
          <li class="nav-item">
              <a class="btn btn-success btn" href="ajoutLivre.php">Ajouter livre</a>
            </li></ul>
            <?php
            ?>
          <form method="POST" action="../traitement/deconnexion.php?email=<?=$_SESSION['email']?>">
          <button type="submit" name="deco" class="btn btn-danger" style="margin-left: 5%;" value="1">Déconnexion</button>
        </form>
        <?php 
            if (isset($_SESSION['idPanier']) && !empty($_SESSION['idPanier'])) {
              
            ?>
              <a href="panier.php" style="width: 3%;"><img style="width: 125%; margin-left:65%" src="https://cdn0.iconfinder.com/data/icons/minimal-set-seven/32/minimal-49-512.png" alt=""></a>
              <?php
            }
        }else{
          ?>
        <ul class="navbar-nav">
      <li class="nav-item mx-2">
          <a class="btn btn-success" href="connexion.php">Connexion</a>
        </li>
      <li class="nav-item">
          <a class="btn btn-dark" href="inscription.php">Inscription</a>
        </li></ul>
         <?php
        }
        ?>

    </div>
      <form class="d-flex mb-lg-0 collapse navbar-collapse" style="width: auto; margin-left:2%" action="resultatRecherche.php">
        <input class="form-control me-1" type="search" placeholder="Rechercher un livre" aria-label="Rechercher" id="recherche" name="recherche">
        <button class="btn btn-light" type="submit">Rechercher</button>
      </form>
    </div>
</nav>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="margin-top: 10%;">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Autorisation des cookies</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <p>Notre site est susceptible de collecter des cookies afin d'améliorer votre expérience utilisateur.
                        Néanmoins, vous êtes en droit de refuser cette collecte.
                      </p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Je n'autorise pas la collecte</button>
                      <button type="button" class="btn btn-primary"  data-bs-dismiss="modal">J'accepte la collecte de cookie</button>
                  </div>
              </div>
          </div>
      </div>
  
