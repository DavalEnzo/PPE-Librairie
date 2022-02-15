<?php

require_once 'entete.php';


if(isset($_GET["success"])&& $_GET['success'] == 1 ){
    ?>
      <div class="alert alert-success mt-3">Le produit a bien été supprimé</div>
      <?php 
  }else if(isset($_GET["success"])&& $_GET['success'] == 0 ){
      ?>
      <div class="alert alert-danger">Echec lors de la suppression du produit</div>
      <?php
  }

if(isset($_SESSION['idUtilisateur']) && !empty($_SESSION['idUtilisateur'])){
    $idUtilisateur = $_SESSION['idUtilisateur'];
    
    if(isset($_SESSION['idPanier']) && !empty($_SESSION['idPanier'])){
        $idPanier = $_SESSION['idPanier'];
        $Panier = new Panier($idPanier, $idUtilisateur);
        $recupPanier = $Panier->getPanier();
    ?>
    <div class="roundedBorders text-center container" style="margin-top: 2%;">
        <h2>Articles actuellement dans votre panier</h2>
    </div>
    
    
    <?php
    $total = 0;
     foreach($recupPanier as $panier){
         $total += $panier['Prix'] * $panier['quantite'];
         ?>
        <div class="card mb-3 my-3 container" style="max-width: 1400px; height: 230px;">
        <div class="row g-0">
          <div class="col-md-1">
            <img src="<?=$panier['Photo'];?>" style="max-height: 228px;" class="rounded-start" alt="...">
          </div>
          <div class="col-md-10" style="margin-left: 2%;">
            <div class="card-body" style="margin-left: 5%;">
              <h5 class="card-title"><?=$panier['Titre'];?></h5>
              <h5 class="card-subtitle text-muted"><?=$panier['nomEditeur'];?></h5>
              <p class="card-text">Prix : <?=$panier['Prix'];?>€</p>
              <form method="POST" action="../traitement/modifQuantite?idLivre=<?=$panier['idLivre'];?>&idStockage=<?=$panier['idStockage']?>">
                <button type="submit" class="btn btn-danger btn-sm" style="display: inline-block; min-width:28px; max-height: 31px;" name="moins" value="0">-</button>
                <p class="card-text" style="display: inline-block;">Quantité : <?=$panier['quantite'];?></p>
                <button type="submit" style="display: inline-block;" class="btn btn-success btn-sm" name="plus" value="1">+</button>
            </form>
              <p class="card-text">Prix avec quantité : <?=$panier['quantite'] * $panier['Prix'];?> €</p>
              <a type="submit" href="../traitement/suppressionArticlePanier.php?idStockage=<?=$panier['idStockage']?>" style="margin-left: 85%;" class="btn btn-danger">Supprimer l'article</a>
            </div>
          </div>
        </div>
      </div>
      
      <?php
  }
  ?>
  </div>
  </div>
  <div class="roundedBorders" style="width: 12%; padding:0.8%; margin-left:74.5%; margin-top:auto">Prix Total : <?=$total;?>€
  <a type="button" href="processusCommande.php" class="btn btn-success my-2">Passer la commande</a>
  </div>

  <?php
     }else{
         ?>        
    <div class="alert alert-danger container text-center" style="margin-top: 15%;">Vous n'avez pas encore ajouté de livres dans votre panier</div>
    <div style="margin-top: 16.5%;">
        <?php
    require_once 'pied.php';
    ?>
    </div>

    <?php
     }
}else{
    ?>        
    <div class="alert alert-danger container text-center" style="margin-top: 15%;">Vous devez vous <a href="connexion.php">connecter</a> et/ou être <a href="inscription.php">inscrit</a> afin de pouvoir enregistrer des livres dans votre panier<br>
    Sinon, vous pouvez <a href="index.php">Retourner à l'accueil</a>
    </div>
    <div style="margin-top: 16.5%;">
        <?php
    require_once 'pied.php';
    ?>
    </div>

    <?php
}

