<?php
class Bibliotheque extends Modele 
{
private $titre;
private $droit;
private $check;
private $genres;
private $photo;
private $prix;
private $date;

private $Bibli;

private $infoId;

private $bibliNew;

private $BibliAudio;

private $RLivre;

    public function __construct($idLivre = null,$recherche = null)
    {
        
        $requete = $this->getBdd()->prepare("SELECT * FROM bibliotheque");
        $requete->execute();
        $infoBibli =  $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->Bibli = $infoBibli;

        $requete = $this->getBdd()->prepare("SELECT * FROM bibliotheque ORDER BY date_heure DESC LIMIT 4");
        $requete->execute();
        $bibliNew= $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->bibliNew = $bibliNew;

        $requete = $this->getBdd()->prepare("SELECT * FROM bibliotheque WHERE audio = 1");
        $requete->execute();
        $BibliAudio = $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->BibliAudio = $BibliAudio;

        if($idLivre != null) 
            {
                $requete = $this->getBdd()-> prepare ("SELECT * FROM bibliotheque WHERE idLivre = ? ");
                $requete -> execute([$idLivre]);
                $infoId = $requete->fetch(PDO::FETCH_ASSOC);

                $this->infoId = $infoId ;
            }
            if($recherche != null) 
            {
                    $requete= $this->getBdd()->prepare('SELECT * FROM bibliotheque WHERE Titre LIKE ? ORDER BY Titre
                    ');
                    $requete->execute(["%".$recherche."%"]);
                    $RLivre =  $requete->fetchAll(PDO::FETCH_ASSOC);

                    $this->RLivre = $RLivre;
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
        $RLivre =  $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->RLivre = $RLivre;
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
    public function getBibliAudio()
    {
        return $this->BibliAudio;
    }
    public function getRLivre()
    {
        return $this->RLivre;
    }
}