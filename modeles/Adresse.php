<?php

class Adresse extends Modele
{

    private $idAdresse;

    private $libelle;

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

            $this -> idUtilisateur = $u['idUtilisateur'];
        }
    }

    /**
     * @param   int  $idAdresse
     * @param   int  $idUtilisateur
     * @param   string  $libelle
     */
    public function initializeAdresse($idUtilisateur = null, $idAdresse = null, $libelle = null)
    {
        $this -> idAdresse = $idAdresse;

        $this -> libelle = $libelle;

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

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

//SETTERS
    public function setIdAdresse($var = null)
    {
        $this->idAdresse = $var;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }




}
