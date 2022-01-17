<?php
class Genre extends Modele{

    private $idGenre;

    private $nomGenre;

    private $imgGenre;

    public function __construct($idGenre=null)
    {

        if($idGenre!=null){

            $requete=$this->getBdd()->prepare("CALL select_genre_with_livre_and_auteur(?)");
            $requete->execute([$idGenre]);  
            $genre= $requete->fetch(PDO::FETCH_ASSOC);
            
            $this->idGenre  = $genre['idGenre'];
            $this->nomGenre = $genre['nomGenre'];
            $this->imgGenre = $genre['imgGenre'];
        }
    }

    public function selectToutGenres($idTypeGenre){
         $requete = $this->getBdd()->prepare("SELECT * FROM bibliotheque WHERE idtypeGenre = ?");
         $requete->execute([$idTypeGenre]);
         return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function gettypeGenre()
    {  
        $requete = $this->getBdd()->prepare("SELECT * FROM genres LEFT JOIN typegenre USING (idGenre)");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insertGenre($libelle){
           $requete = $this->getBdd()->prepare("INSERT INTO genres (nomGenre) VALUES(?)");
           $requete->execute([$libelle]);
       }
    public function insertTypegenre($libelle,$idGenre){
        $requete=$this->getBdd()->prepare('INSERT INTO typegenre (libelle, idGenre) VALUES (?, ?)');
        $requete->execute([$libelle, $idGenre]);
    }

    // GETTERS
    public function getIdGenre()
    {
        return $this->idGenre;
    }

    public function getNomGenre()
    {
        return $this->nomGenre;
    }
    
    public function getImgGenre()
    {
        return $this->imgGenre;
    }

    // SETTERS
    public function setIdGenre($idGenre)
    {
        $this->idGenre = $idGenre;
    }

    public function setNomGenre($nomGenre)
    {
        $this->nomGenre = $nomGenre;
    }

    public function setImgGenre($imgGenre)
    {
        $this->nomGenre = $imgGenre;
    }    
}