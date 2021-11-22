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
            ?>

<div class="roundedBorders container" style="width: 45%;">
    <h1 class="text-center"> Modification du mot de passe</h1>

<form method="POST" action="../traitement/modifierMdp.php">

    <input class ="form-control text-center" style="border-radius: 20px; width:30%; margin-top:6%; margin-bottom:2%; margin-left:35%" name="verifMdp" type="password" placeholder="Votre mot de passe actuel">
    <input class ="form-control text-center" style="border-radius: 20px; width:30%; margin-top:1%; margin-bottom:5%; margin-left:35%" name="newMdp" type="password" placeholder="Votre nouveau mot de passe">

    <div class="form-group text-center my-2">
        <button type="submit" class="btn btn-success" style="border-radius: 20px; width:35%" name="envoi">Modifier le profile</button>
    </div>
</form>
</div>