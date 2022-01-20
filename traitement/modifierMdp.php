<?php require_once '../modeles/modele.php'?>

<?php

$u = new Utilisateur;

extract($_POST);

if(isset($verifMdp) && !empty($verifMdp) && isset($newMdp) && !empty($newMdp) && isset($confirmNewMdp) && !empty($confirmNewMdp)){
    $requete = $u->connexion([$_SESSION['email']]);

    $vraiMdp =$requete->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($verifMdp, $vraiMdp["mdp"])){ 

        header("location:../membres/modificationMdp.php?id=".$_SESSION['idUtilisateur']."&success=2");
    }else if($newMdp != $confirmNewMdp){
        header("location:../membres/modificationMdp.php?id=".$_SESSION['idUtilisateur']."&success=3");

    }else if(password_verify($verifMdp, $vraiMdp["mdp"]) && $newMdp == $confirmNewMdp){

        $mdp = password_hash($newMdp, PASSWORD_BCRYPT);

        $u->modifMdp($mdp, $_SESSION['idUtilisateur']);

        header("location:../membres/profil.php?id=".$_SESSION['idUtilisateur']."&success=1");
    }
}else{
    header("location:../membres/modificationMdp.php?id=".$_SESSION['idUtilisateur']."&success=0");
}