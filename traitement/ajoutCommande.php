<?php
require_once '../modeles/modele.php';

$commande = new Commande();

$idPanier = $_SESSION['idPanier'];
$Panier = new Panier($idPanier, $_SESSION['idUtilisateur']);
$recupPanier = $Panier->getPanier();

if( isset($_POST['pays']) && !empty($_POST['pays']) &&
    isset($_POST['nomComplet']) && !empty($_POST['nomComplet']) &&
    isset($_POST['telephone']) && !empty($_POST['telephone']) &&
    isset($_POST['adresse']) && !empty($_POST['adresse']) &&
    isset($_POST['codePostal']) && !empty($_POST['codePostal']) &&
    isset($_POST['ville']) && !empty($_POST['ville']) &&
    isset($_POST['nomCb']) && !empty($_POST['nomCb']) &&
    isset($_POST['cb']) && !empty($_POST['cb']) &&
    isset($_POST['mois']) && !empty($_POST['mois']) &&
    isset($_POST['annee']) && !empty($_POST['annee']) &&
    isset($_POST['cvc']) && !empty($_POST['cvc']) &&
    isset($_POST['prixTotal']) && !empty($_POST['prixTotal']))
{
    if(strlen($_POST['telephone']) == 10 && is_numeric($_POST['telephone'])){
                    if(strlen($_POST['codePostal']) == 5 && is_numeric($_POST['codePostal'])){
                        if(preg_match('/^[a-zA-Z]+$/', $_POST['ville'])){
                            if(is_numeric($_POST['cb']) && strlen($_POST['cb']) == 16){
                                if(is_numeric($_POST['cvc']) && strlen($_POST['cvc']) == 3){
                                    try{
                                        $commande->ajouterCommande($_SESSION['idPanier'], $_SESSION['idUtilisateur'], $_POST['prixTotal'], $_POST['adresse']);

                                        foreach($recupPanier as $panier){
                                            $commande->ajouterDetailsCommande($panier['idLivre'], $panier['quantite']);            
                                        }

                                        $Panier->supprimerPanier($_SESSION['idPanier']);

                                        $_SESSION['idPanier'] = null;

                                        header('location:../membres/index.php?success=1');
                                    }catch (Exception $e){
                                        header('location:../membres/processusCommande.php?success=0');
                                    }
                                }else{
                                    header('location:../membres/processusCommande.php?success=2');
                                }
                            }else{
                                header('location:../membres/processusCommande.php?success=3');
                            }
                        }else{
                            header('location:../membres/processusCommande.php?success=4');
                        }

                    }else{
                        header('location:../membres/processusCommande.php?success=5');
                    }
            }else{
                header('location:../membres/processusCommande.php?success=6');
            }
        }else{
            header('location:../membres/processusCommande.php?success=7');
}