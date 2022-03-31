<?php

class Adresse extends Modele
{

    private $idAdresse;

    private $libelle;

    private $ville;

    private $codePostal;

    private $complementAdresse;

    private $idUtilisateur;

    public function __construct($idAdresse = null)
    {
        if ($idAdresse != null)
        {
            $requete = $this->getBdd()->prepare('SELECT * FROM adresses WHERE idAdresse = ?');
            $requete -> execute([$idAdresse]);
            $u = $requete -> fetch(PDO::FETCH_ASSOC);

            $this -> idAdresse = $idAdresse;

            $this -> libelle = $u['libelle'];

            $this -> ville = $u['ville'];

            $this -> codePostal = $u['codePostal'];

            $this -> complementAdresse = $u['complementAdresse'];

            $this -> idUtilisateur = $u['idUtilisateur'];
        }
    }

    /**
     * @param   int  $idAdresse
     * @param   int  $idUtilisateur
     * @param   string  $libelle
     * @param   string  $ville
     * @param   int  $codePostal
     * @param   string  $complementAdresse
     */
    public function initializeAdresse($idUtilisateur = null, $idAdresse = null, $libelle = null, $ville = null, $codePostal = null, $complementAdresse = null)
    {
        $this -> idAdresse = $idAdresse;

        $this -> libelle = $libelle;

        $this -> ville = $ville;

        $this -> codePostal = $codePostal;

        $this -> complementAdresse = $complementAdresse;

        $this -> idUtilisateur = $idUtilisateur;
    }

//GETTERS
    public function getIdAdresse()
    {
        return $this->idAdresse;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function getComplementAdresse()
    {
        return $this->complementAdresse;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

//SETTERS
    public function setIdAdresse($var = null)
    {
        $this->idAdresse = $var;
    }

    public function setLibelle($var = null)
    {
        $this->libelle = $var;
    }

    public function setCodePostal($var = null)
    {
        $this->codePostal = $var;
    }

    public function setComplementAdresse($var = null)
    {
        $this->complementAdresse = $var;
    }

    public function setVille($var = null)
    {
        $this->ville = $var;
    }

    public function setIdUtilisateur($var = null)
    {
        $this->idUtilisateur = $var;
    }

}
