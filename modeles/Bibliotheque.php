<?php

function selectBibli(){
    $requete = getBdd()->prepare("SELECT * FROM bibliotheque");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function insertBibli($titre, $date, $prix, $photo, $genres, $check, $droit){
    $requete = getBdd()->prepare("INSERT INTO bibliotheque( Titre, date_sortie, Prix, Photo, idGenre, date_heure, audio, droit)
        VALUES(?, ?, ?, ?, ?, NOW(), ?, ?)");
    $requete->execute([$titre, $date, $prix, $photo, $genres, $check, $droit]);
}
function livreBibli($idLivre){
    $requete = getBdd()-> prepare ("SELECT * FROM bibliotheque WHERE idLivre = ?  limit 1");
    $requete -> execute([$idLivre]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function selectBiblinew(){

    $requete = getBdd()->prepare("SELECT * FROM bibliotheque ORDER BY date_heure DESC LIMIT 4");

    $requete->execute();

    return $requete->fetchAll(PDO::FETCH_ASSOC);

}

function selectBibliaudio(){
    $requete = getBdd()->prepare("SELECT * FROM bibliotheque WHERE audio = 1");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}
function rechercherLivre($recherche){
    $requete= getBdd()->prepare('SELECT * FROM bibliotheque WHERE Titre LIKE ? ORDER BY Titre
    ');
    $requete->execute(["%".$recherche."%"]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}