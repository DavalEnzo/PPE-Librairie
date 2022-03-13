<?php include_once 'entete.php'?>

<?php

    $com = new Commande();
    $commandes = $com->getAllCommandesUser($_SESSION['idUtilisateur']);
?>

<?php

    foreach($commandes as $commande){
?>
<div class="card mb-3 my-3 container cardlivre" style="max-width: 1400px; height: 230px;">
    <div class="row g-0">
        <div class="col-md-3">
            <div class="card-body">
                <h5 class="card-title">Commande créée le <?=date('d-m-Y', strtotime($commande['dateCommande']));;?></h5>
                <p class="card-text">Prix total: <?=$commande['prixTotal'];?>€</p>
            </div>
        </div>
    </div>
</div>
<?php
    }