<?php

function selectEditeur(){
    $requete= getBdd()->prepare('SELECT * FROM editeurs');
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function recupLivresEditeur($idEditeur){
    $requete=getBdd()->prepare('SELECT * FROM editeurs INNER JOIN bibliotheque USING (idEditeur) INNER JOIN genres USING (idGenre) WHERE idEditeur = ?');
    $requete->execute([$idEditeur]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}