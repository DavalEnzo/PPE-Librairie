<?php require_once '../modeles/modele.php';


if(isset($_GET['id']) && !empty($_GET['id']) && isset($_SESSION['idUtilisateur']) && !empty($_SESSION['idUtilisateur'])){
    if(isset($_SESSION['idPanier']) && !empty($_SESSION['idPanier'])){
        $stocker = new Stockage();

        try{
            $idLivre = $_GET['id'];

            $panier = $_SESSION['idPanier'];

            $recupQuantite = $stocker->verifQuantite($panier, $idLivre);

            $quantite = $recupQuantite['quantite'];

            if($quantite >= 1){

                $quantite++;

                $stocker->modifQuantite($quantite, $panier, $idLivre);
                header('location:../membres/pageProduit.php?idLivre='.$_GET['id'].'&success=1');
            }else if($quantite == null){
                $quantite = 1;
                $stocker->insertStockage($panier, $idLivre, $quantite);
                header('location:../membres/pageProduit.php?idLivre='.$_GET['id'].'&success=1');
            }     

        }catch(Exception $e){
            header('location:../membres/pageProduit.php?idLivre='.$_GET['id'].'&success=0');
        }
    }else if(!isset($_SESSION['idPanier']) && empty($_SESSION['idPanier'])){

        $stocker = new Stockage();

        $quantite = 1;

        $ajoutPanier = new Panier();

        $u = new Utilisateur($_SESSION['idUtilisateur']);

        $idUtilisateur = $_SESSION['idUtilisateur'];
    }
        
        try{

            $ajoutPanier = new Panier();

            $ajoutPanier->ajouterPanierVide($idUtilisateur);

            $lastPanierId = $ajoutPanier->SelectMaxidPanier();
            
            $_SESSION["idPanier"] = $lastPanierId['max(idPanier)'];

            $idLivre = $_GET['id'];

            $stocker->insertStockage($lastPanierId['max(idPanier)'], $idLivre, $quantite);

            header('location:../membres/pageProduit.php?idLivre='.$_GET['id'].'&success=1');

        }catch (Exception $e){
            var_dump($e->getMessage());exit;
            header('location:../membres/pageProduit.php?idLivre='.$_GET['id'].'&success=0');
        }
    }else{
    header('location:../membres/connexion.php?nonconnecte=1');
}

