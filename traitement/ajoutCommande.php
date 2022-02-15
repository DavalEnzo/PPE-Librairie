<?php
require_once '../modeles/modele.php';

$commande = new Commande();

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
    isset($_POST['cvc']) && !empty($_POST['cvc']))
{
    if(strlen($_POST['telephone']) == 10){
        if(preg_match('[A-Za-z]', $_POST['nomComplet'])){
            if(preg_match('[0-9]', $_POST['telephone'])){
                if(preg_match('[\.a-zA-Z0-9,])', $_POST['adresse'])){
                    # code...
                }

            }

            header('location:../membres/processusCommande.php');
        }
    }
}