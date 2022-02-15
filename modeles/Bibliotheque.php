<?php
class Bibliotheque extends Modele 
{

// private $infoId;


private $Livres = []; //Contient les livres 

private $Auteurs = [];

    public function __construct()
    {
                $requete = $this->getBdd()-> prepare ("SELECT * FROM livres ORDER BY date_heure DESC ");
                $requete -> execute();
                $Livres = $requete->fetchAll(PDO::FETCH_ASSOC);
                $this->InitializeLivreBibli($Livres);
               
    }
        
    public function InitializeLivreBibli($Bibli)
    {
        foreach($Bibli as $L){
            $Livre = new Livre($L['idLivre']);
            $this->Livres[]=$Livre;
        }
    }

    //GETTERS
    public function getLivres()
    {
        return $this->Livres;
    }































        public function insertBibli($titre, $date, $prix, $photo, $genres, $check, $droit){
            $requete = $this->getBdd()->prepare("INSERT INTO livres( Titre, date_sortie, Prix, Photo, idGenre, date_heure, audio, droit)
            VALUES(?, ?, ?, ?, ?, NOW(), ?, ?)");
        $requete->execute([$titre, $date, $prix, $photo, $genres, $check, $droit]);
        
        $this->titre = $titre;

        $this->droit = $droit;

        $this->check = $check;

        $this->genres = $genres;

        $this->photo = $photo;

        $this->prix = $prix;

        $this->date = $date;



    }
    
    public function rechercherLivre($recherche){
        $requete= $this->getBdd()->prepare('SELECT * FROM livres WHERE Titre LIKE ? ORDER BY Titre
        ');
        $requete->execute(["%".$recherche."%"]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewLivres(){
        $requete = $this->getBdd()->prepare("SELECT * FROM livres ORDER BY date_heure DESC LIMIT 4");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getLivresGratuits(){
        $requete = $this->getBdd()->prepare("SELECT * FROM livres WHERE Prix = 0");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getToutLivres(){
        $requete = $this->getBdd()->prepare("SELECT * FROM livres");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInfoId()
    {
        return $this->infoId;
    }
}