<?php
require_once '../modeles/modele.php';

extract($_POST);

$quantite = new Stockage();

$Panier = new Panier($_SESSION['idPanier'], $_SESSION['idUtilisateur']);

$verifQuantite = $quantite->verifQuantite($_SESSION['idPanier'], $_GET['idLivre']);

$verifpas0 = $verifQuantite['quantite'];

if(isset($_GET['idLivre']) && isset($plus) && $plus == 1 ){
            try{

                $quantite->quantitePlus($_SESSION['idPanier'], $_GET['idLivre']);
                header('location:../membres/panier.php?success=3&idLivre='.$_GET['idLivre']);
            }catch(Exception $e){
                header('location:../membres/panier.php?error='.$e);
            }
}else if(isset($_GET['idLivre']) && isset($moins) && $moins == 0){

    if($verifpas0 > 1){
        try{
            $quantite->quantiteMoins($_SESSION['idPanier'], $_GET['idLivre']);
            header('location:../membres/panier.php?success=3&idLivre='.$_GET['idLivre']);
        }catch(Exception $e){
            header('location:../membres/panier.php?error='.$e);
        }
    }else if($verifpas0 == 1){
        try{

            $nbLivrePanier = $quantite->comptageLivrePanier($_SESSION['idPanier']);
        
            if($nbLivrePanier['nbLivres'] == 1){
                $Panier->supprimerPanier($_SESSION['idPanier']);
                $_SESSION['idPanier'] = null;
            }

            $quantite->suppressionProduit($_GET['idStockage']);

            $quantite->suppressionProduit($_GET['idStockage']);
            header('location:../membres/panier.php?success=4');
        }catch(Exception $e){
            header('location:../membres/panier.php?error='.$e);
        }
    }
}