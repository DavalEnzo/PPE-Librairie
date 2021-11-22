<?php require_once '../modeles/modele.php'?>

<?php

$u = new Utilisateur;

extract($_POST);

if(isset($verifMdp) && !empty($verifMdp) && isset($newMdp) && !empty($newMdp)){
    $requete = $u->connexion([$_SESSION['email']]);

    $vraiMdp =$requete->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($verifMdp, $vraiMdp["mdp"])) {
        
        $erreur = 1;

        header("location:../membres/modificationMdp.php?id=".$_SESSION['idUtilisateur']."&success=2");
    }else{

        $mdp = password_hash($newMdp, PASSWORD_BCRYPT);

        $u->modifMdp($mdp, $_SESSION['idUtilisateur']);

        header("location:../membres/profile.php?id=".$_SESSION['idUtilisateur']."&success=1");

    }


}