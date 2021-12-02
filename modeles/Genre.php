<?php
class Genre extends Modele{

    private $idGenre;

    private $Genre;

    private $toutGenres;

    private $selecttypeGenre;


    
    public function __construct($idGenre=null)
    {
        if($idGenre!=null){
        $requete=$this->getBdd()->prepare('CALL select_genre_with_livre_and_auteur(?)');
        $requete->execute([$idGenre]);  
        $genre= $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->idGenre=$idGenre;

        $this->Genre=$genre;
        
    }
    
    $requete = $this->getBdd()->prepare("SELECT * FROM genres");
    $requete->execute();
    $toutGenres= $requete->fetchAll(PDO::FETCH_ASSOC);

    $this->toutGenres=$toutGenres;
    
    $requete = $this->getBdd()->prepare("SELECT * FROM genres LEFT JOIN typegenre USING (idGenre)");
        $requete->execute();
        $selecttypeGenre= $requete->fetchAll(PDO::FETCH_ASSOC);
        
        $this->selecttypeGenre=$selecttypeGenre;
    }
        
    public function insertGenre($libelle){
           $requete = $this->getBdd()->prepare("INSERT INTO genres (nomGenre) VALUES(?)");
           $requete->execute([$libelle]);
       }
    public function insertTypegenre($libelle,$idGenre){
        $requete=$this->getBdd()->prepare('INSERT INTO typegenre (libelle, idGenre) VALUES (?, ?)');
        $requete->execute([$libelle, $idGenre]);
    }

    public function getlivreGenre()
    {
        return $this->Genre;
        return $this->idGenre;
    }
    public function getGenre()
    {
        return $this->toutGenres;
    }
    public function gettypeGenre()
    {
        return $this->selecttypeGenre;
    }
}