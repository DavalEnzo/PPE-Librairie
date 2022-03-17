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

private $editeur;

private $lecture;

private $Auteurs = [];

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
                $this->initializeAuteurLivre($this->idLivre);
                $this->lecture = new Lecture($this->idLivre);
                $this->initializeEditeurLivre($this->idLivre);
                
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
                $commentaire->initializeCom( $c['idCommentaire'],$c['contenu'],$c['idUtilisateur'],$c['idLivre'],$c['grade'],$c['entete'],$c['date_heure'],true);
                $this->commentaires[]=$commentaire;
            }
        }

        private function initializeAuteurLivre($idLivre)
        {
            $requete = $this->getBdd()-> prepare ("SELECT a.idAuteur,a.nom FROM auteurs as a LEFT JOIN ecrit as e using(idAuteur) WHERE idLivre = ?  ");
            $requete -> execute([$idLivre]);
            $auteur = $requete->fetchAll(PDO::FETCH_ASSOC);

            foreach($auteur as $a)
            {
                $Auteur = new Auteur();
                $Auteur->initialize( $a['idAuteur'],$a['nom']);
                $this->Auteurs[]=$Auteur;

            }
        }

        private function initializeEditeurLivre($idLivre)
        {
            $requete = $this->getBdd()-> prepare("SELECT e.idEditeur, e.nom FROM editeurs as e LEFT JOIN livres USING(idEditeur) WHERE idLivre = ?");
            $requete -> execute([$idLivre]);
            $editeur = $requete->fetch(PDO::FETCH_ASSOC);

            $Editeur = new Editeur();
            $Editeur->initialize($editeur["idEditeur"], $editeur['nom']);
            $this->editeur = $Editeur;
        }


        public function initialize($idLivre = null,$Titre=null ,$date_sortie=null,$Prix=null,$Photo=null,$idGenre=null,$idTypeGenre=null,$idEditeur=null,$date_heure=null,$droit=null,$option=null)
        {
                $this->idLivre      = $idLivre;
                $this->Titre        = $Titre ;
                $this->date_sortie  = $date_sortie;
                $this->Prix         = $Prix;
                $this->Photo        = $Photo;
                $this->idGenre      = $idGenre;
                $this->idTypeGenre  = $idTypeGenre;
                $this->idEditeur    = $idEditeur;
                $this->date_heure   = $date_heure;
                $this->droit        = $droit;

                $this->initializeAuteurLivre($this->idLivre);
                
                if($option != null){
                    $this->initializeComLivre($this->idLivre);
                    $this->lecture = new Lecture($this->idLivre);
                    $this->initializeEditeurLivre($this->idLivre);
                }
            }
        public function insertLivre()
        {
            $requete = $this->getBdd()->prepare("INSERT INTO livres( Titre ,date_sortie,Prix,Photo,idGenre,idEditeur,date_heure,droit)
            VALUES(?,?,?,?,?,?,NOW(),?)");
            $requete->execute([$this->Titre ,$this->date_sortie,$this->Prix ,$this->Photo,$this->idGenre,$this->idEditeur,$this->droit]);
            return true;
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
        public function getAuteur()
        {
            return $this->Auteurs;
        }
        public function getEditeur()
        {
            return $this->editeur;
        }
}