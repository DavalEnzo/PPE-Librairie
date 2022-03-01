<?php
class TypeGenre extends Modele
{
    private $idTypeGenre;
    private $libelle;
    private $imgTypeGenre;
    private $idGenre;

    public function __construct($idTypeGenre = null) {

        $requete = $this->getBdd()->prepare('SELECT * FROM typegenre where idtypeGenre =?');
        $requete->execute([$idTypeGenre]);
        $TypeGenre = $requete->fetch(PDO::FETCH_ASSOC);

        $this->idTypeGenre = $idTypeGenre;
        $this->libelle = $TypeGenre['libelle'];
        $this->imgTypeGenre = $TypeGenre['imgTypeGenre'];
        $this->idGenre = $TypeGenre['idGenre'];


    }

    public function initialize($idTypeGenre = null,$libelle = null,$imgTypeGenre = null,$idGenre = null)
    {
        $this->idTypeGenre = $idTypeGenre;
        $this->libelle      = $libelle;
        $this->imgTypeGenre = $imgTypeGenre;
        $this->idGenre      = $idGenre;
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
}