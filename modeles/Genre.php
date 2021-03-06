<?php
class Genre extends Modele{

    protected $idGenre;
    protected $nomGenre;
    protected $imgGenre;

    protected $TypeGenre = [];

    public function __construct($idGenre=null)
    {

        if($idGenre!=null){

            $requete=$this->getBdd()->prepare("SELECT * FROM genres WHERE idGenre = ?");
            $requete->execute([$idGenre]);  
            $genre= $requete->fetch(PDO::FETCH_ASSOC);
            
            $this->idGenre  = $genre['idGenre'];
            $this->nomGenre = $genre['nomGenre'];
            $this->imgGenre = $genre['imgGenre'];

            $this->initTypeGenre($this->idGenre);
        }
    }

    public function initialize($idGenre,$nomGenre,$imgGenre)
    {
        $this->idGenre      =   $idGenre;
        $this->nomGenre     =   $nomGenre;
        $this->imgGenre     =   $imgGenre;
        
        $this->initTypeGenre($this->idGenre);
    }

    public function initTypeGenre($idGenre)
    {
        $requete=$this->getBdd()->prepare("SELECT * FROM typegenre where idGenre = ?");
        $requete->execute([$idGenre]);  
        $tGenre= $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($tGenre as $tg)
        {
            $TypeGenre = new TypeGenre();
            $TypeGenre->initialize($tg['idtypeGenre'],$tg['libelle'],$tg['imgTypeGenre'],$tg['idGenre']);
            $this->TypeGenre[] = $TypeGenre;
        }

    }
    public function insertGenre($libelle){
           $requete = $this->getBdd()->prepare("INSERT INTO genres (nomGenre) VALUES(?)");
           $requete->execute([$libelle]);
           return true;
       }
    public function insertTypegenre($libelle,$idGenre){
        $requete=$this->getBdd()->prepare('INSERT INTO typegenre (libelle, idGenre) VALUES (?, ?)');
        $requete->execute([$libelle, $idGenre]);
        return true;
    }

    // GETTERS
    public function getIdGenre()
    {
        return $this->idGenre;
    }

    public function getNomGenre()
    {
        return $this->nomGenre;
    }
    
    public function getImgGenre()
    {
        return $this->imgGenre;
    }
    public function getTypeGenre()
    {
        return $this->TypeGenre;
    }

    // SETTERS
    public function setIdGenre($idGenre)
    {
        $this->idGenre = $idGenre;
    }

    public function setNomGenre($nomGenre)
    {
        $this->nomGenre = $nomGenre;
    }

    public function setImgGenre($imgGenre)
    {
        $this->nomGenre = $imgGenre;
    }    
}