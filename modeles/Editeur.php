<?php
class Editeur extends Modele
{
    private $recupLEditeur;
    private $SelectEditeur;
    public function __construct($idEditeur = null)
    {
        if($idEditeur != null)
        {
            $requete=$this->getBdd()->prepare('SELECT * FROM editeurs INNER JOIN bibliotheque USING (idEditeur) INNER JOIN genres USING (idGenre) WHERE idEditeur = ?');
            $requete->execute([$idEditeur]);
            $recupLEditeur =  $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->recupLEditeur = $recupLEditeur;
        }

        $requete= $this->getBdd()->prepare('SELECT * FROM editeurs');
        $requete->execute();
        $SelectEditeur =  $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->SelectEditeur = $SelectEditeur;
    }

    public function getSEditeur()
    {
        return $this->SelectEditeur;
    }
    public function getLEditeur()
    {
        return $this->recupLEditeur;
    }
}