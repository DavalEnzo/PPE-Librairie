<?php
class Bibliotheque extends Modele 
{

// private $infoId;

private $Auteurs    =   [];//LIste des Auteurs 

private $Editeurs   =   [];// liste des Editeurs

private $Genres     =   [];//LIste des Genres 

private $Livres     =   [];//LIste des livres 


    public function __construct()
    {
                $requete = $this->getBdd()-> prepare ("SELECT * FROM livres ORDER BY date_heure DESC ");
                $requete -> execute();
                $Livres = $requete->fetchAll(PDO::FETCH_ASSOC);

                $requete = $this->getBdd()-> prepare ("SELECT * FROM genres ");
                $requete -> execute();
                $Genres = $requete->fetchAll(PDO::FETCH_ASSOC);

                $requete = $this->getBdd()-> prepare ("SELECT * FROM auteurs ");
                $requete -> execute();
                $Auteurs = $requete->fetchAll(PDO::FETCH_ASSOC);

                $requete = $this->getBdd()-> prepare ("SELECT * FROM editeurs ");
                $requete -> execute();
                $Editeurs = $requete->fetchAll(PDO::FETCH_ASSOC);

                $this->InitializeLivresBibli($Livres);

                $this->InitializeGenresBibli($Genres);     

                $this->InitializeAuteursBibli($Auteurs);

                $this->InitializeEditeursBibli($Editeurs);               
    }
        
    public function InitializeLivresBibli($Bibli)
    {
        foreach($Bibli as $L){
            $Livre = new Livre();
            $Livre->initialize($L['idLivre'],$L['Titre'],$L['date_sortie'],$L['Prix'],$L['Photo'],$L['idGenre'],$L['idtypeGenre'],$L['idEditeur'],$L['date_heure'],$L['droit']);
            $this->Livres[] =   $Livre;
        }
    }

    public function InitializeGenresBibli($Bibli)
    {
        foreach($Bibli as $L){
            $Genres = new Genre();
            $Genres->initialize($L["idGenre"],$L['nomGenre'],$L['imgGenre']);
            $this->Genres[] =   $Genres;
        }
    }
    public function InitializeAuteursBibli($Bibli)
    {
        foreach($Bibli as $L){
            $Auteurs = new Auteur();
            $Auteurs->initialize($L['idAuteur'],$L['nom']);
            $this->Auteurs[]    =   $Auteurs;
        }
    }

    public function InitializeEditeursBibli($Bibli)
    {
        foreach($Bibli as $L){
            $Editeurs = new Editeur();
            $Editeurs->initialize($L['idEditeur'],$L['nom']);
            $this->Editeurs[]   =   $Editeurs;
        }
    }


    //GETTERS
    public function getLivres()
    {
        return $this->Livres;
    }

    public function getGenres()
    {
        return $this->Genres;
    }
    
    public function getAuteurs()
    {
        return $this->Auteurs;
    }

    public function getEditeurs()
    {
        return $this->Editeurs;
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