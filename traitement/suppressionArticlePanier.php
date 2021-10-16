<?php
require_once '../modeles/modele.php';

if(isset($_GET['idStockage']) && !empty($_GET['idStockage']) && isset($_SESSION['idPanier']) && !empty($_SESSION['idPanier'])){
    
    $supprLivrePanier = new Stockage();

    $Panier = new Panier($_SESSION['idPanier'], $_SESSION['idUtilisateur']);

    $idStockage = $_GET['idStockage'];

    $idPanier = $_SESSION['idPanier'];

    try{
        $supprPanier = $Panier->getPanier();

        $nbLivrePanier = $supprLivrePanier->comptageLivrePanier($idPanier);

        if($nbLivrePanier['nbLivres'] == 1){
            $Panier->supprimerPanier($idPanier);
            $_SESSION['idPanier'] = null;
        }


        $supprLivrePanier->suppressionProduit($idStockage);

        header('location:../membres/panier.php?success=1');
    }catch(Exception $e){

        header('location:../membres/panier.php?success=0');

    }
}else{
    header('location:../membres/index.php');
}