<?php
class Editeur extends Modele
{
    private $recupLEditeur;
    
    public function __construct($idEditeur = null)
    {
        if($idEditeur != null)
        {
            $requete=$this->getBdd()->prepare('SELECT * FROM editeurs INNER JOIN bibliotheque USING (idEditeur) WHERE idEditeur = ?');
            $requete->execute([$idEditeur]);
            $recupLEditeur =  $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->recupLEditeur = $recupLEditeur;
        }

    }
    
    public function getTousEditeurs()
    {
        $requete= $this->getBdd()->prepare('SELECT * FROM editeurs');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLEditeur()
    {
        return $this->recupLEditeur;
    }
}