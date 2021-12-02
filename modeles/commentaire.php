<?php
class Commentaire extends Modele
{   
    private $com;
    function __construct($idLivre = null)
    {
        if($idLivre != null)
        {
            $requete = $this->getBdd() -> prepare ('CALL select_commentaires_by_user_and_livre(?)');
            $requete -> execute([$idLivre]);
            $com = $requete->fetchAll(PDO::FETCH_ASSOC);
            $this->com = $com;
        }
    }
    function insertCom($contenu,$idLivre,$idUtilisateur,$entete = null,$grade = null){
        if($entete == null && $grade == null )
        {
            $sql = $this->getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,date_heure) VALUES (?,?,?,NOW())");
            $sql -> execute([$contenu,$idLivre,$idUtilisateur]);
        }
        if ($entete != null && $grade == null)
        {
            $sql = $this->getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,entete,date_heure) VALUES (?,?,?,NOW())");
            $sql -> execute([$contenu,$idLivre,$idUtilisateur,$entete]);
        }
         if($entete == null && $grade != null )
        {
            $sql = $this->getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,grade,date_heure) VALUES (?,?,?,NOW())");
            $sql -> execute([$contenu,$idLivre,$idUtilisateur,$grade]);
        }
        if($entete != null && $grade != null)
        {
            $sql = $this->getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,entete,grade,date_heure) VALUES (?,?,?,NOW())");
            $sql -> execute([$contenu,$idLivre,$idUtilisateur,$entete,$grade]);
        }
    }

    public function getAllUserComs($idUtilisateur){
        $requete = $this->getBdd() -> prepare ('CALL select_allComs_user(?)');
        $requete ->execute([$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCom()
    {
        return $this->com;
    }
}