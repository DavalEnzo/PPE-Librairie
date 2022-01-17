<?php
class Bibliotheque extends Modele 
{

private $Bibli;

private $infoId;

private $bibliNew;

private $RLivre;

    public function __construct($idLivre = null)
    {
        
        $requete = $this->getBdd()->prepare("SELECT * FROM bibliotheque");
        $requete->execute();
        $infoBibli =  $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->Bibli = $infoBibli;

        $requete = $this->getBdd()->prepare("SELECT * FROM bibliotheque ORDER BY date_heure DESC LIMIT 4");
        $requete->execute();
        $bibliNew= $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->bibliNew = $bibliNew;

        $requete = $this->getBdd()->prepare("SELECT * FROM bibliotheque WHERE Prix = 0");
        $requete->execute();
        $BibliNum = $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->BibliNum = $BibliNum;

        if($idLivre != null) 
            {
                $requete = $this->getBdd()-> prepare ("SELECT * FROM bibliotheque WHERE idLivre = ? ");
                $requete -> execute([$idLivre]);
                $infoId = $requete->fetch(PDO::FETCH_ASSOC);

                $this->infoId = $infoId ;
            }
        }
        
        public function insertBibli($titre, $date, $prix, $photo, $genres, $check, $droit){
            $requete = $this->getBdd()->prepare("INSERT INTO bibliotheque( Titre, date_sortie, Prix, Photo, idGenre, date_heure, audio, droit)
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
        $requete= $this->getBdd()->prepare('SELECT * FROM bibliotheque WHERE Titre LIKE ? ORDER BY Titre
        ');
        $requete->execute(["%".$recherche."%"]);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBibli()
    {
        return $this->Bibli;
    }

    public function getBibliNew()
    {
        return $this->bibliNew;
    }
    public function getInfoId()
    {
        return $this->infoId;
    }
    public function getBibliNum()
    {
        return $this->BibliNum;
    }
    public function getRLivre()
    {
        return $this->RLivre;
    }
}