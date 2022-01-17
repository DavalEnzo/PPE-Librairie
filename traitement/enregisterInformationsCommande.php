<?php require_once '../modeles/modele.php'?>

<?php

if(isset($_POST['pays']) && !empty($_POST['pays']) 
&& isset($_POST['nomComplet']) && !empty($_POST['nomComplet']) 
&& isset($_POST['telephone']) && !empty($_POST['telephone']) 
&& isset($_POST['adresse']) && !empty($_POST['adresse']) 
&& isset($_POST['codePostal']) && !empty($_POST['codePostal']) 
&& isset($_POST['ville']) && !empty($_POST['ville'])){
    header('location:../membres/processusCommande.php?adresse='.$_POST);
}