<?php
function selectLectureid($idLivre){
    $sql = getBdd()->prepare("SELECT * FROM lectures WHERE idLivre = ?");
    $sql -> execute([$idLivre]);
    return $sql-> fetch(PDO::FETCH_ASSOC);
}