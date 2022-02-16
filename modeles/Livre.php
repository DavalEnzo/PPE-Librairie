<?php
class Livre extends Modele
{
private $idLivre;
private $Titre;
private $date_sortie;
private $Prix;
private $Photo;
private $idGenre;
private $idTypeGenre;
private $idEditeur;
private $date_heure;
private $droit;

private $commentaires = [];
private $lecture;

private $Auteur;
    public function __construct($idLivre = null)
    {
        if($idLivre != null) 
            {
                $requete = $this->getBdd()-> prepare ("SELECT * FROM livres WHERE idLivre = ? ");
                $requete -> execute([$idLivre]);
                $infoId = $requete->fetch(PDO::FETCH_ASSOC);

                $this->idLivre      = $infoId['idLivre'];
                $this->Titre        = $infoId['Titre'];
                $this->date_sortie  = $infoId['date_sortie'];
                $this->Prix         = $infoId['Prix'];
                $this->Photo        = $infoId['Photo'];
                $this->idGenre      = $infoId['idGenre'];
                $this->idTypeGenre  = $infoId['idtypeGenre'];
                $this->idEditeur    = $infoId['idEditeur'];
                $this->date_heure   = $infoId['date_heure'];
                $this->droit        = $infoId['droit'];


                $this->initializeComLivre($this->idLivre);
                $this->lecture = new Lecture($this->idLivre);
            }
        }

        private function initializeComLivre($idLivre)
        {
            $requete = $this->getBdd()-> prepare ("SELECT * FROM commentaires WHERE idLivre = ?  ORDER BY date_heure ASC ");
            $requete -> execute([$idLivre]);
            $com = $requete->fetchAll(PDO::FETCH_ASSOC);

            foreach($com as $c)
            {
                $commentaire = new Commentaire();
                $commentaire->initializeCom( $c['idCommentaire'],$c['contenu'],$c['idUtilisateur'],$c['idLivre'],$c['grade'],$c['entete'],$c['date_heure']);
                $this->commentaires[]=$commentaire;
            }
        }
        public function initialize($idLivre = null,$Titre ,$date_sortie,$Prix,$Photo,$idGenre,$idTypeGenre,$idEditeur,$date_heure,$droit)
        {

                $this->Titre        = $Titre ;
                $this->date_sortie  = $date_sortie;
                $this->Prix         = $Prix;
                $this->Photo        = $Photo;
                $this->idGenre      = $idGenre;
                $this->idTypeGenre  = $idTypeGenre;
                $this->idEditeur    = $idEditeur;
                $this->date_heure   = $date_heure;
                $this->droit        = $droit;

                $this->initializeComLivre($this->idLivre);
                $this->lecture = new Lecture($this->idLivre);
        }
        public function insertLivre()
        {
            $requete = $this->getBdd()->prepare("INSERT INTO livres( Titre ,date_sortie,Prix,Photo,idGenre,idTypeGenre,idEditeur,date_heure,droit)
            VALUES(?,?,?,?,?,?,?,NOW(),?)");
            $requete->execute([$this->Titre ,$this->date_sortie,$this->Prix ,$this->Photo,$this->idGenre,$this->idTypeGenr,$this->idEditeur,$this->date_heure,$this->droit]);
        }
    

        //GETTERS

        public function getidLivre()
        {
            return $this->idLivre;
        }
        public function getTitre()
        {
            return $this->Titre;
        }
        public function getdate_sortie()
        {
            return $this->date_sortie;
        }
        public function getPrix()
        {
            return $this->Prix;
        }
        public function getPhoto()
        {
            return $this->Photo;
        }
        public function getidGenre()
        {
            return $this->idGenre;
        }
        public function getidTypeGenre()
        {
            return $this->idTypeGenre;
        }
        public function getidEditeur()
        {
            return $this->idEditeur;
        }
        public function getdate_heure()
        {
            return $this->date_heure;
        }
        public function getdroit()
        {
            return $this->droit;
        }
        public function getCommentaires()
        {
            return $this->commentaires;
        }
}