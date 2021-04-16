<?php
require_once '../modeles/modele.php';
if(isset($_POST['nomGenre']) && !empty($_POST['nomGenre'])){
    $libelle = $_POST['nomGenre'];
    $Genre=new Genre();
    try {
        $Genre->insertGenre($libelle);
       header('location:../membres/ajoutGenres.php?success=1&typeGenre='.$_POST["nomGenre"]);
            
    } catch (Exception $e) {
        header('location:../membres/ajoutGenres.php?success=0');
    }
}