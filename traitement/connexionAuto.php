<?php 
require_once '../modeles/modele.php';

$u = New Utilisateur();

if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['token']) && !empty($_GET['token'])){
    
    $utilisateur = $u->fetchToken($_GET['id']);

    $token = $utilisateur['token'];

    if($token == $_GET['token']){

        
        $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];
        $_SESSION["email"] = $utilisateur["email"];
        $_SESSION["idPermission"] = $utilisateur["idPermission"];
        $_SESSION["photoProfile"] = $utilisateur["photoProfile"];
        $_SESSION['nom'] = $utilisateur['prenom'].' '.$utilisateur['nom'];
        $_SESSION['nomSimple'] = $utilisateur['nom'];
        $_SESSION['prenom'] = $utilisateur['prenom'];

        $recupPanier=$u->userPanier($utilisateur['idUtilisateur']);

        if($recupPanier->rowCount() != 0){
        $panier = $recupPanier->fetch(PDO::FETCH_ASSOC);
        $_SESSION["idPanier"] = $panier['idPanier'];
    }

    header('location:../membres/index.php');
    
    }else {
        header('location:../membres/connexion.php');
    }

}else {
    header('location:../membres/index.php');
}
