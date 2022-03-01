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

        $u = new Utilisateur();

        $idUtilisateur = $_SESSION['idUtilisateur'];

            
        
        try{
            $ajoutPanier->ajouterPanierVide($idUtilisateur);
            
            $recupPanier=$u->userPanier($idUtilisateur);
            
            $panier = $recupPanier->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION["idPanier"] = $panier['idPanier'];
            
            foreach($ajoutPanier as $idPanier){
                $idPanier = $idPanier['idPanier'];
            }

            $idLivre = $_GET['id'];

            $stocker->insertStockage($_SESSION['idPanier'], $idLivre, $quantite);

            header('location:../membres/pageProduit.php?idLivre='.$_GET['id'].'&success=1');

        }catch (Exception $e){
            header('location:../membres/pageProduit.php?idLivre='.$_GET['id'].'&success=0');
        }
    }
}else{
    header('location:../membres/connexion.php?nonconnecte=1');
}
?>