<?php

class Auteur extends Modele
{
    private $aut;
    private $auteur;
    private $a;

   public function selectAuteur(){
            $requete = $this->getBdd()->prepare("SELECT * FROM auteurs ORDER BY nom ASC");
            $requete->execute();
            $infoAut = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->aut = $infoAut;
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
       return  $this->aut;
    }
}