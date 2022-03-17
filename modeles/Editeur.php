<?php
class Editeur extends Modele
{
    private $idEditeur;

    private $nom;

    private $Livre = [];
    
    public function __construct($idEditeur = null)
    {
        if($idEditeur != null)
        {
            $requete=$this->getBdd()->prepare('SELECT * FROM editeurs WHERE idEditeur = ?');
            $requete->execute([$idEditeur]);
            $recupLEditeur =  $requete->fetch(PDO::FETCH_ASSOC);

            $this->idEditeur = $recupLEditeur['idEditeur'];
            $this->nom = $recupLEditeur['nom'];

            $this->initLivreEditeur($this->idEditeur);
        }
    }

    public function initLivreEditeur($idEditeur)
    {
        $requete=$this->getBdd()->prepare('SELECT * FROM livres WHERE idEditeur = ?');
        $requete->execute([$idEditeur]);
        $editeur =  $requete->fetchAll(PDO::FETCH_ASSOC); 

        foreach($editeur as $L){
            $Livre = new Livre();
            $Livre->initialize($L['idLivre'],$L['Titre'],$L['date_sortie'],$L['Prix'],$L['Photo'],$L['idGenre'],$L['idtypeGenre'],$L['idEditeur'],$L['date_heure'],$L['droit']);
            $this->Livre[] =   $Livre;
        }
    }

    public function initialize($idEditeur,$nom)
    {
        $this->idEditeur = $idEditeur;
        $this->nom=$nom;
    }

    public function insertEditeur($editeur)
    {
        $requete=$this->getBdd()->prepare('INSERT INTO editeurs (nom) VALUES (?)');
        $requete->execute([$editeur]);

        $requete=$this->getBdd()->prepare("SELECT max(idEditeur) as idEditeur FROM editeurs");
        $requete->execute();
        $E = $requete->fetch(PDO::FETCH_ASSOC);

        $this->idEditeur = $E['idEditeur'];
        
        return true;
    }
  


    // GETTERS  
    public function getIdEditeur()
    {
        return $this->idEditeur;
    }
    public function getNomEditeur()
    {
        return $this->nom;
    }
    public function getLivre()
    {
        return $this->Livre;
    }

    // SETTERS
    public function setIdEditeur($idEditeur)
    {
        $this->idEditeur = $idEditeur;
    }
    public function setNomEditeur($nom)
    {
        $this->nom = $nom;
    }
}