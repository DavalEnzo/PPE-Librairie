<?php
class Editeur extends Modele
{
    private $idEditeur;

    private $nom;
    
    public function __construct($idEditeur = null)
    {
        if($idEditeur != null)
        {
            $requete=$this->getBdd()->prepare('SELECT * FROM editeurs WHERE idEditeur = ?');
            $requete->execute([$idEditeur]);
            $recupLEditeur =  $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->idEditeur = $recupLEditeur['idEditeur'];
            $this->nom = $recupLEditeur['nom'];
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
    }
  


    // GETTERS  
    public function getEditeurLivre($idEditeur)
    {
        $requete=$this->getBdd()->prepare('SELECT * FROM editeurs INNER JOIN livres USING (idEditeur) WHERE idEditeur = ?');
        $requete->execute([$idEditeur]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getIdEditeur()
    {
        return $this->idEditeur;
    }
    public function getNomEditeur()
    {
        return $this->nom;
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