<?php
require_once '../modeles/modele.php';
if(isset($_POST['typeGenre']) && !empty($_POST['typeGenre'])){
    $libelle = $_POST['typeGenre'];
    $idGenre = $_POST['genre'];
    try {
       insertTypegenre($libelle,$idGenre);
       header('location:../membres/ajoutGenres.php?success=2&typeGenre='.$_POST["typeGenre"]);
            
    } catch (Exception $e) {
        header('location:../membres/ajoutGenres.php?success=0');
    }
}