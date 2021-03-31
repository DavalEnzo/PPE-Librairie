<?php
function selectAuteur(){
        $requete = getBdd()->prepare("SELECT * FROM auteurs ORDER BY nom ASC");
        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function insertAuteur($auteur){
    $requete=getBdd()->prepare("INSERT INTO auteurs (nom) VALUES (?)");
    $requete->execute([$auteur]);
}
function insertAuteur2($a){
    $requete=getBdd()->prepare("INSERT INTO ecrit (idAuteur, idLivre) VALUES (?, (SELECT max(idLivre) FROM bibliotheque))");
    $requete->execute([$a]);
}