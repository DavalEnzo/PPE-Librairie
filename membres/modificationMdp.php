<?php include_once 'entete.php';?>

<?php
    if(isset($_GET['success']) && !empty($_GET['success'])){
        if($_GET['success'] == 2){
            ?>
            <div class="alert alert-danger">Les mots de passe ne correspondent pas
        </div>
            <?php        
        }
    }

    if(isset($_GET['success']) && !empty($_GET['success'])){
        if($_GET['success'] == 3){
            ?>
            <div class="alert alert-danger">Le nouveau mots de passe et la confirmation du mot de passe ne correspondent pas
        </div>
            <?php        
        }
    }

    if(isset($_GET['success']) && empty($_GET['success'])){
            ?>
            <div class="alert alert-danger">Tous les champs n'ont pas été renseignés</div>
            <?php        
    }
            ?>

<div class="roundedBorders container" style="width: 45%;">
    <h1 class="text-center"> Modification du mot de passe</h1>

<form method="POST" action="../traitement/modifierMdp.php">

    <input class ="form-control" style="border-radius: 20px; width:30%; margin-top:6%; margin-bottom:2%; margin-left:35%" name="verifMdp" type="password" placeholder="Votre mot de passe actuel">
    <input class ="form-control" style="border-radius: 20px; width:30%; margin-top:1%; margin-bottom:2%; margin-left:35%" name="newMdp" type="password" placeholder="Votre nouveau mot de passe">
    <input class ="form-control" style="border-radius: 20px; width:30%; margin-top:1%; margin-bottom:4%; margin-left:35%" name="confirmNewMdp" type="password" placeholder="Confirmez votre nouveau mdp">

    <div class="form-group text-center my-2">
        <button type="submit" class="btn btn-success" style="border-radius: 20px; width:35%" name="envoi">Modifier le profil</button>
    </div>
</form>
</div>