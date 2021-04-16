<?php
class Lecture extends Modele{

    private $idLivre;
    private $livre;

public function __construct($idLivre=null){
    if($idLivre!=null){
    $sql = $this->getBdd()->prepare("SELECT * FROM lectures WHERE idLivre = ?");
    $sql -> execute([$idLivre]);
    $livre = $sql-> fetch(PDO::FETCH_ASSOC);

    $this->idLivre=$idLivre;

    $this->livre=$livre['contenu'];
}
}
    public function setLivre($livre)
    {
        $this->livre=$livre;
    }
    public function getLivre()
    {
        return $this->livre;
    }
    public function setidLivre($idlivre)
    {
        $this->idLivre=$idlivre;
    }
    public function getidLivre()
    {
        return $this->idLivre;
    }

}
