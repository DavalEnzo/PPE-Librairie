<?php

class Commentaire extends Modele
{   
    private $com;
    
    function __construct($idLivre = null)
    {
        if($idLivre != null)
        {
            $requete = $this->getBdd() -> prepare ('SELECT * FROM commentaires Where idLivre = ? ORDER BY date_heure');
            $requete -> execute([$idLivre]);
            $com = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->com = $com;
        }
    }
    function insertCom($contenu,$idLivre,$idUtilisateur){
        $sql = $this->getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,date_heure) VALUES (?,?,?,NOW())");
        $sql -> execute([$contenu,$idLivre,$idUtilisateur]);
    }

    public function getCom()
    {
        return $this->com;
    }

}