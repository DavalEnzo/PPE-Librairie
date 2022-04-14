<?php include_once 'entete.php'?>

<?php

    $com = new Utilisateur($_SESSION['idUtilisateur']);
    $commandes = $com->getCommandes();
    ?>

<?php


foreach($commandes as $commande){
    $det = $commande->getDetailCommande();

    
?>
<div class="card mb-3 my-3 container cardlivre" style="max-width: 1420px; height: 270px;">
    <div class="row g-0">
        <div class="col-md-3">
            <div class="card-body">
              <h4 class="card-title">Commande n° <?=$commande->getIdCommande();?></h4>
              <h5 class="card-title">Commande créée le <?=date('d-m-Y', strtotime($commande->getDateCommande()));?></h5>
            
    <?php
        foreach($det as $d){
            ?>
            <img style="width: 20%;" src="<?=$d->getLivre()->getPhoto();?>">
            <?php
    }
    ?>
</div>

              <?php 
                if($commande->getStatut() == 0){
                    ?>
                    <h5 class="card-title" style="color: orange;">En attente</h5>
                    <?php
                }else if($commande->getStatut() == 1 && date("Y-m-d") <=  date("Y-m-d", strtotime($commande->getDateLivraison()))){
                    ?>
                    <h5 class="card-title"  style="color: yellow;">En cours d'envoi</h5>
                    <?php
                }else if($commande->getStatut() == 1 && date("Y-m-d") >  date("Y-m-d", strtotime($commande->getDateLivraison()))){
                    ?>
                    <h5 class="card-title"  style="color: green;">Commande livrée</h5>
                    <?php
                }else if($commande->getStatut() == 1 && date("Y-m-d") >  date("Y-m-d", strtotime($commande->getDateLivraison()))){
                    ?>
                    <h5 class="card-title"  style="color: red;">Retard sur la commande</h5>
                    <?php
                }
              ?>
              <p class="card-text">Prix total: <?=$commande->getPrixTotal();?>€</p>              
            </div>
        </div>
    </div>
</div>
<?php
    }