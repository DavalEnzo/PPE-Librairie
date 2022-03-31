<?php
class Bibliotheque extends Modele 
{

// protected $infoId;

protected $Auteurs    =   [];//Liste des Auteurs 

protected $Editeurs   =   [];//liste des Editeurs

protected $Genres     =   [];//Liste des Genres 

protected $Livres     =   [];//Liste des livres 


    public function __construct($recherche = true)
    {
            if($recherche){

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

    public function rechercherLivre($recherche){
        $requete= $this->getBdd()->prepare('SELECT * FROM livres WHERE Titre LIKE ? ORDER BY Titre
        ');
        $requete->execute(["%".$recherche."%"]);
        $Bibli = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($Bibli as $L){
            $Livre = new Livre();
            $Livre->initialize($L['idLivre'],$L['Titre'],$L['date_sortie'],$L['Prix'],$L['Photo'],$L['idGenre'],$L['idtypeGenre'],$L['idEditeur'],$L['date_heure'],$L['droit']);
            $this->Livres[] =   $Livre;
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



    public function getInfoId()
    {
        return $this->infoId;
    }
}