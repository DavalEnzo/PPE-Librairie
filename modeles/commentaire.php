<?php
class Commentaire extends Modele
{   
    private $com;
    function __construct($idLivre = null)
    {
        if($idLivre != null)
        {
            $requete = $this->getBdd() -> prepare ('SELECT c.*, u.nom, u.prenom, u.photoProfile, u.idUtilisateur  FROM commentaires AS c LEFT JOIN utilisateurs as u on u.idUtilisateur = c.idUtilisateur Where c.idLivre = ? ORDER BY c.date_heure');
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
        $requete = $this->getBdd() -> prepare ('SELECT c.*, u.nom, u.prenom, u.photoProfile, u.idUtilisateur, b.Titre  FROM commentaires AS c LEFT JOIN utilisateurs as u on u.idUtilisateur = c.idUtilisateur LEFT JOIN bibliotheque as b on c.idLivre = b.idLivre Where c.idUtilisateur = ? ORDER BY c.date_heure');
        $requete ->execute([$idUtilisateur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCom()
    {
        return $this->com;
    }
}