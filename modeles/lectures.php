<?php
class Lecture extends Modele{

    protected $idLivre;

    protected $contenu;

    protected $idLecture;

public function __construct($idLivre=null){
    if($idLivre!=null){
        $sql = $this->getBdd()->prepare("SELECT * FROM lectures WHERE idLivre = ?");
        $sql -> execute([$idLivre]);
        $livre = $sql-> fetch(PDO::FETCH_ASSOC);
        
        $this->idLivre          = $idLivre;
        $this->contenu          = $livre['contenu'];
        $this->idLecture        = $livre['idLecture'];
        
    }
}

public function initLecture($idLecture = null, $idLivre = null, $contenu = null)
{
    $this->idLecture    =   $idLecture;
    $this->idLivre      =   $idLivre;
    $this->contenu      =   $contenu;
}

public function insertLecture()
{
    $result = $this->getBdd()->prepare("INSERT INTO lectures (contenu,idLivre) values (?,?)");
    $result->execute([$this->contenu,$this->idLivre]);
}

////GETTERS

public function getIdLivre()
{
    return $this->idLivre;
}
public function getIdLecture()
{
    return $this->idLecture;
}
public function getContenu()
{
    return $this->contenu;
}

////SETTERS

    public function setIdLivre($livre)
    {
        $this->idLivre=$livre;
    }

    public function setContenu($livre)
    {
        $this->contenu=$livre;
    }
    
    public function setidLecture($idlivre)
    {
        $this->idLecture=$idlivre;
    }
}
