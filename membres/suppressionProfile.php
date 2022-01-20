<?php include_once 'entete.php';?>

<div class="rounded" style="background-color: white; padding: 1% 2% 2% 2%;box-shadow: 1px 1px 5px black; margin-top:10%; margin-left:15%; width:70%">

    <img style="width: 10%; margin-bottom:1%; margin-right:2%; margin-left:15%; display:inline-block" src="https://i1.wp.com/fabriquet.fr/wp-content/uploads/2018/02/warning-icon.png?ssl=1" alt="">
    <h2 class="text-center" style="display:inline-block"> Êtes-vous sûr/e de vouloir supprimer votre compte ?</h2>

    <div style="margin-top:5%; margin-left:36.5%">

        <a href="../traitement/supprimerProfile.php" type="button" class="btn btn-danger" style="width: 20%;">Supprimer</a>
        
        <a href="profil.php?id=<?=$_SESSION['idUtilisateur'];?>" type="button" class="btn btn-success" style="width: 20%;">Annuler</a>
    
    </div>
</div>