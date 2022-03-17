<?php require_once '../modeles/modele.php'?>

<?php

$u = new Utilisateur($_SESSION['idUtilisateur']);

extract($_POST);

if(isset($verifMdp) && !empty($verifMdp) && isset($newMdp) && !empty($newMdp) && isset($confirmNewMdp) && !empty($confirmNewMdp)){
    $requete = $u->verifUtilisateurMdp($_SESSION['email']);

    if (!password_verify($verifMdp, $u->getMdp())){
        

        header("location:../membres/modificationMdp.php?id=".$_SESSION['idUtilisateur']."&success=2");
        
    }else if($newMdp != $confirmNewMdp){

        header("location:../membres/modificationMdp.php?id=".$_SESSION['idUtilisateur']."&success=3");

    }else if(password_verify($verifMdp, $u->getMdp()) && $newMdp == $confirmNewMdp){

        if(strlen($newMdp) < 8){
                
            $erreurs[] = "Le mot de passe doit faire au moins 8 caractères";

        }elseif(!preg_match("#[0-9]+#", $newMdp)){
            
            $erreurs[] = "Le mot de passe doit contenir au moins un caractère numérique (ex: 5)";

        }elseif(!preg_match("#[A-Z]+#", $newMdp)){
            
            $erreurs[] = "Le mot de passe doit contenir au moins une lettre majuscule (ex: A)";

        }

        if(count($erreurs)===0){
        $mdp = password_hash($newMdp, PASSWORD_BCRYPT);

        $u->modifMdp($mdp, $_SESSION['idUtilisateur']);

        header("location:../membres/profil.php?id=".$_SESSION['idUtilisateur']."&success=1");

        }else{
            header("location:../membres/profil.php?success=4&erreurs=".$erreurs[0]);
        }
    }
}else{
    header("location:../membres/modificationMdp.php?id=".$_SESSION['idUtilisateur']."&success=0");
}