<?php require_once '../modeles/modele.php'
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" type="text/css" href="css/all.min.css"/>
    <title>Boutique de Livres</title>
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous">
    </script>	
</head>
<body style="background-image:url('https://www.lg.com/ch_fr/images/TV/features/TV-UHD-UM74-02-4K-Resolution-Desktop.jpg'); background-size:cover">
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
          <a class="nav-link active" href="actualités.php">Actualité</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="occasion.php">Occasion</a>
        </li>
      </ul>
      <ul class="navbar-nav mx-2 mb-2 mb-lg-0">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <li class="nav-item">
          <a class="nav-link active btn btn-success btn-sm" href="ajoutLivre.php">Ajouter livre</a>
        </li></ul>
        <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link active" href="connexion.php">Connexion</a>
        </li>
      <li class="nav-item">
          <a class="nav-link active" href="inscription.php">Inscription</a>
        </li></ul>
    </div>
      <form class="d-flex mb-lg-0 collapse navbar-collapse" style="width: 21%;" action="resultatRecherche.php">
        <input class="form-control me-1" type="search" placeholder="Rechercher un livre" aria-label="Rechercher" id="recherche" name="recherche">
        <button class="btn btn-light" type="submit">Rechercher</button>
      </form>
    </div>
  </div>
</nav>

</body>
</html>