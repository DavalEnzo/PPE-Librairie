<?php
function insertCom($contenu,$idLivre,$idUtilisateur){
    $sql = getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,date_heure) VALUES (?,?,?,NOW())");
    $sql -> execute([$contenu,$idLivre,$idUtilisateur]);
}
function selectCom($idLivre){
    $requete = getBdd() -> prepare ('SELECT * FROM commentaires Where idLivre = ? ORDER BY date_heure');
    $requete -> execute([$idLivre]);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}