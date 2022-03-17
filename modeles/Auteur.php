<?php

class Auteur extends Modele
{
    private $idAuteur;

    private $nom;

   public function __construct($idAuteur=null)
   {
       if($idAuteur!=null){
        $requete=$this->getBdd()->prepare('SELECT * FROM auteurs WHERE idAuteur = ?');
        $requete->execute([$idAuteur]);  
        $auteur= $requete->fetch(PDO::FETCH_ASSOC);

        $this->idAuteur=$idAuteur;
        $this->nom=$auteur['nom'];
        
       }
    }

    public function initialize($idAuteur = null,$nom=null)
    {
        $this->idAuteur = $idAuteur;
        $this->nom = $nom;
    }

    public function insertEcrit($idAuteur = null){
            if($idAuteur == null)
            {
                $requete=$this->getBdd()->prepare("INSERT INTO ecrit (idAuteur, idLivre) VALUES ((SELECT max(idAuteur) FROM auteurs),(SELECT max(idLivre) FROM livres))"); 
                $requete->execute();
            }else{
                $requete= $this->getBdd()->prepare("INSERT INTO ecrit (idAuteur, idLivre) VALUES (?, (SELECT max(idLivre) FROM livres))");
                $requete->execute([$idAuteur]);
            }
            return true;
    }

   public function insertAuteur(){
        $requete= $this->getBdd()->prepare("INSERT INTO auteurs (nom) VALUES (?)");
        $requete->execute([$this->nom]);
        return true;
    }

   public function insertAuteur2($a){
        $requete= $this->getBdd()->prepare("INSERT INTO ecrit (idAuteur, idLivre) VALUES (?, (SELECT max(idLivre) FROM livres))");
        $requete->execute([$a]);
        return true;
    }
    
    public function getIdAuteur()
    {
       return  $this->idAuteur;
    }
    
    public function getNomAuteur()
    {
       return  $this->nom;
    }
}