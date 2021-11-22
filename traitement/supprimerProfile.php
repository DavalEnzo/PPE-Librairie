<?php include_once '../modeles/modele.php'?>

<?php 

$supprimerUser = new Utilisateur;

if(isset($_SESSION['idUtilisateur']) && !empty($_SESSION['idUtilisateur'])){
    $supprimerUser->supprimerProfile($_SESSION['idUtilisateur']);
    session_destroy();

    header("location:../membres/index.php");
}else{
    header("location:../membres/index.php");
}