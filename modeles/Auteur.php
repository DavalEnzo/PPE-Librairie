<?php

class Auteur extends Modele
{
    private $toutAuteur;

   public function __construct($idAuteur=null)
   {
       if($idAuteur!=null){
        $requete=$this->getBdd()->prepare('SELECT * FROM auteurs WHERE idAuteur = ?');
        $requete->execute([$idAuteur]);  
        $auteur= $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->idAuteur=$idAuteur;

        $this->auteur=$auteur;
        
       }
   {
            $requete = $this->getBdd()->prepare("SELECT * FROM auteurs ORDER BY nom ASC");
            $requete->execute();
            $infoAut = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->toutAuteur = $infoAut;
    }
}

   public function insertAuteur($auteur){
        $requete= $this->getBdd()->prepare("INSERT INTO auteurs (nom) VALUES (?)");
        $requete->execute([$auteur]);

        $this->auteur = $auteur;
    }
   public function insertAuteur2($a){
        $requete= $this->getBdd()->prepare("INSERT INTO ecrit (idAuteur, idLivre) VALUES (?, (SELECT max(idLivre) FROM bibliotheque))");
        $requete->execute([$a]);

        $this->a = $a;
    }
    
    public function getAuteur()
    {
       return  $this->toutAuteur;
    }
}