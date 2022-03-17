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

    private $utilisateur;
    private $Livre;

    public function __construct($idCom = null)
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

            $this->utilisateur = new Utilisateur($this->idUtilisateur);
        }
    }

    public function initializeCom($idCom=null,$contenu,$idUtilisateur,$idLivre,$grade = null,$entete = null,$dateHeure = null,$option = false)
    {
        $this->idCom = $idCom;

        $this->entete = $entete;

        $this->contenu = $contenu;

        $this->idUtilisateur = $idUtilisateur;

        $this->idLivre = $idLivre;

        $this->grade = $grade;

        $this->dateHeure = $dateHeure;

        $this->initLivreCom($this->idLivre);
        
        if($option == true){
            $this->utilisateur  = new Utilisateur($this->idUtilisateur);
        }
        
    }


    public function insertCom(){
        if($this->entete == null && $this->grade == null )
        {
            $sql = $this->getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,date_heure) VALUES (?,?,?,NOW())");
            $sql -> execute([$this->contenu,$this->idLivre,$this->idUtilisateur]);
        }
        if ($this->entete != null && $this->grade == null)
        {
            $sql = $this->getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,entete,date_heure) VALUES (?,?,?,?,NOW())");
            $sql -> execute([$this->contenu,$this->idLivre,$this->idUtilisateur,$this->entete]);
        }
         if($this->entete == null && $this->grade != null )
        {
            $sql = $this->getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,grade,date_heure) VALUES (?,?,?,?,NOW())");
            $sql -> execute([$this->contenu,$this->idLivre,$this->idUtilisateur,$this->grade]);
        }
        if($this->entete != null && $this->grade != null)
        {
            $sql = $this->getBdd() -> prepare ("INSERT INTO commentaires (contenu, idLivre, idUtilisateur,entete,grade,date_heure) VALUES (?,?,?,?,?,NOW())");
            $sql -> execute([$this->contenu,$this->idLivre,$this->idUtilisateur,$this->entete,$this->grade]);
        }
        return true;
    }

    public function initLivreCom($idLivre)
    {
        $requete = $this->getBdd()-> prepare ("SELECT * FROM livres WHERE idLivre = ? ");
        $requete -> execute([$idLivre]);
        $livres = $requete->fetch(PDO::FETCH_ASSOC);
            $Livre = new Livre();
            $Livre->initialize($livres['idLivre'],$livres['Titre'] ,$livres['date_sortie'],$livres['Prix'],$livres['Photo'],$livres['idGenre'],$livres['idtypeGenre'],$livres['idEditeur'],$livres['date_heure'],$livres['droit']);
            $this->Livre=$Livre;
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
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
    public function getLivre()
    {
        return $this->Livre;
    }



    public function setIdCom($idCom)
    {
        $this->idCom = $idCom;
    }

    public function setEntete($entete)
    {
        $this->entete = $entete;
    }

    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function setIdLivre($idLivre)
    {
        $this->idLivre = $idLivre;
    }

    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    public function setDateHeure($dateHeure)
    {
        $this->dateHeure = $dateHeure;
    }
}