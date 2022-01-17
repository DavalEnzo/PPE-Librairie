<?php
class Lecture extends Modele{

    private $idLivre;

    private $contenu;

    private $idLecture;

    public function __construct($idLivre=null){
        if($idLivre!=null){
        $sql = $this->getBdd()->prepare("SELECT * FROM lectures WHERE idLivre = ?");
        $sql -> execute([$idLivre]);
        $livre = $sql-> fetch(PDO::FETCH_ASSOC);

        $this->idLivre=$idLivre;

        $this->contenu=$livre['contenu'];

        $this->contenu=$livre['idLecture'];
    }
}
    public function setidLivre($idlivre)
    {
        $this->idLivre=$idlivre;
    }
    public function setLecture($idLecture)
    {
        $this->idLecture=$idLecture;
    }
    public function getLecture()
    {
        return $this->idLecture;
    }
    public function setLivre($contenu)
    {
        $this->contenu=$contenu;
    }
    public function getLivre()
    {
        return $this->contenu;
    }
    public function getidLivre()
    {
        return $this->idLivre;
    }

}
