<?php
class Commentaire extends Modele
{   
    private $idCom;

    private $entete;

    private $contenu;

    private $idUtilisateur;

    private $idLivre;

    private $grade;

    private $dateHeure;

    function __construct($idCom = null)
    {
        if($idCom != null)
        {
            $requete = $this->getBdd() -> prepare ('SELECT * FROM commentaires WHERE idCommentaire = ?');
            $requete -> execute([$idCom]);
            $com = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idCom = $idCom;

            $this->entete = $com['entete'];

            $this->contenu = $com['contenu'];

            $this->idUtilisateur = $com['idUtilisateur'];

            $this->idLivre = $com['idLivre'];

            $this->grade = $com['grade'];

            $this->dateHeure = $com['date_heure'];

        }
    }

    public function getAllComs($idLivre){
        $requete = $this->getBdd() -> prepare ('CALL select_commentaires_by_user_and_livre(?)');
        $requete ->execute([$idLivre]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);

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

    public function getIdCom()
    {
        return $this->idCom;
    }

    public function getEntete()
    {
        return $this->entete;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function getIdLivre()
    {
        return $this->idLivre;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function getDateHeure()
    {
        return $this->dateHeure;
    }

    public function getCom()
    {
        return $this->com;
    }

}