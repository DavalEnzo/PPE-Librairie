<?php 
require_once '../modeles/modele.php';


if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['token']) && !empty($_GET['token'])){
    $u = New Utilisateur($_GET['id']);

    $token = $u->getToken();

    if($token == $_GET['token']){

        
        $_SESSION["idUtilisateur"] = $u->getIdUtilisateur();
        $_SESSION["email"] = $u->getEmail();
        $_SESSION["idPermission"] = $u->getIdPermission();
        $_SESSION["photoProfile"] = $u->getPhotoProfile();
        $_SESSION['nom'] = $u->getPrenom().' '.$u->getNom();
        $_SESSION['nomSimple'] = $u->getNom();
        $_SESSION['prenom'] = $u->getPrenom();

        $recupPanier=$u->getPanier();

        if(!empty($recupPanier)){
        $_SESSION["idPanier"] = $panier->getIdPanier;
    }

    $u->addUserLogs($_SESSION['idUtilisateur'], $_SERVER['REMOTE_ADDR']);

    header('location:../membres/index.php');
    
    }else {
        header('location:../membres/connexion.php');
    }

}else {
    header('location:../membres/index.php');
}
