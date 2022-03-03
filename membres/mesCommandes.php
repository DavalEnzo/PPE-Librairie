<?php include_once 'entete.php'?>

<?php

    $com = new Utilisateur($_SESSION['idUtilisateur']);
    $commandes = $com->getCommandes();

?>

<?php

    foreach($commandes as $commande){
?>
        <div class="card mb-3 my-3 container cardlivre" style="max-width: 1400px; height: 230px;">
        <div class="row g-0">
          <div class="col-md-3">
            <div class="card-body">
              <h5 class="card-title">Commande créée le <?=$commande->getDateCommande();?></h5>
              <p class="card-text">Prix total: <?=$commande->getPrixTotal();?>€</p>              
            </div>
          </div>
        </div>
        </div>
                            <?php
    }