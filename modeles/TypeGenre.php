<?php
class TypeGenre extends Modele
{
    private $idTypeGenre;
    private $libelle;
    private $imgTypeGenre;
    private $idGenre;
    private $Livre=[];

    public function __construct($idTypeGenre = null) {

        $requete = $this->getBdd()->prepare('SELECT * FROM typegenre where idtypeGenre =?');
        $requete->execute([$idTypeGenre]);
        $TypeGenre = $requete->fetch(PDO::FETCH_ASSOC);

        $this->idTypeGenre = $idTypeGenre;
        $this->libelle = $TypeGenre['libelle'];
        $this->imgTypeGenre = $TypeGenre['imgTypeGenre'];
        $this->idGenre = $TypeGenre['idGenre'];


    }

    public function initialize($idTypeGenre = null,$libelle = null,$imgTypeGenre = null,$idGenre = null, $option = false)
    {
        $this->idTypeGenre = $idTypeGenre;
        $this->libelle      = $libelle;
        $this->imgTypeGenre = $imgTypeGenre;
        $this->idGenre      = $idGenre;
        if($option == true)
        {
            $this->initLivreTypeGenre( $this->idTypeGenre );
        }
    }
    public function initLivreTypeGenre($idTypeGenre)
    {
        $requete = $this->getBdd()-> prepare ("SELECT * FROM livres WHERE idtypeGenre = ? ");
        $requete -> execute([$idTypeGenre]);
        $livres = $requete->fetchAll(PDO::FETCH_ASSOC);
        foreach($livres as $livre)
        {
            $Livre = new Livre();
            $Livre->initialize($livre['idLivre'],$livre['Titre'] ,$livre['date_sortie'],$livre['Prix'],$livre['Photo'],$livre['idGenre'],$livre['idtypeGenre'],$livre['idEditeur'],$livre['date_heure'],$livre['droit']);
            $this->Livre[]=$Livre;
        }
    }
    //GETTERS 
    public function getIdTypeGenre()
    {
       return $this->idTypeGenre ;
    }
    public function getLibelle()
    {
        return $this->libelle ;
    }
    public function getImgTypeGenre()
    {
        return $this->imgTypeGenre ;
    }
    public function getIdGenre()
    {
        return $this->idGenre ;
    }
    public function getLivre()
    {
        return $this->Livre ;
    }
}