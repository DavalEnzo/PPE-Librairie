<?php

class Utilisateur extends Modele{
  
    private $idUtilisateur;

    private $nom;

    private $prenom;

    private $email;

    private $mdp;

    private $photoProfile;

    private $idPermission;

    private $token;

    private $dateMentionAccepte;

    public function __construct($idUtilisateur = null)
    {

        if($idUtilisateur != null)
        {
            
            $requete=$this->getBdd()->prepare('SELECT * FROM utilisateur WHERE idUtilisateur = ?');
            $requete->execute([$idUtilisateur]);    
            $User= $requete->fetch(PDO::FETCH_ASSOC);

            $this->idUtilisateur = $User['idUtilisateur'];

            $this->nom = $User['nom'];

            $this->prenom = $User['prenom'];
        
            $this->email = $User['email'];
        
            $this->mdp = $User['mdp'];

            $this->photoProfile = $User['photoProfile'];

            $this->idPermission = $User['idPermission'];
            
            $this->token = $User['token'];

            $this->dateMentionAccepte = $User['sateMentionAcceptée'];
        
        }

    }
    public function verifUtilisateur()
    {
        $requete = $this->getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
        $requete->execute([$_POST["email"]]);
        return $requete;
    }

    public function inscriptionUtilisateur($nom,$prenom,$email,$mdp){
        $requete = $this->getBdd()->prepare("INSERT INTO utilisateurs(nom,prenom,email,mdp,dateMentionAcceptée) VALUES(?,?,?,?, NOW())");
        $requete->execute([$nom,$prenom,$email,$mdp]);
    }

    public function connexion($email)
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $requete->execute($email);
        return $requete;
    }

    public  function userPanier($idUser)
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM paniers WHERE idUtilisateur = ?");
        $requete->execute([$idUser]);
        return $requete;
    }

    public function modifProfile($nom, $prenom, $email, $idUser)
    {
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET nom = ?, prenom = ?, email = ? WHERE idUtilisateur = ?");
        $requete->execute([$nom, $prenom, $email, $idUser]);
    }

    public function modifPhotoProfile($idUser, $fichier)
    {
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET photoProfile = ? WHERE idUtilisateur = ?");
        $requete->execute([$fichier, $idUser]);
    }

    public function modifMdp($mdp, $idUser)
    {
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET mdp = ? WHERE idUtilisateur = ?");
        $requete->execute([$mdp, $idUser]);
    }

    public function supprimerProfile($idUser)
    {
        $requete = $this->getBdd()->prepare("DELETE FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$idUser]);
    }
    
    public function fetchToken($idUser)
    {
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
        $requete->execute([$idUser]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function addToken($token, $idUser)
    {
        $requete = $this->getBdd()->prepare("UPDATE utilisateurs SET token = ? WHERE idUtilisateur = ?");
        $requete->execute([$token, $idUser]);
    }
//////SETTERS
    private function setName($var = null)
    {
       $this->nom = $var;
    }
    private function setPrenom($var = null)
    {
        $this->prenom = $var;
    }
    private function setEmail($var = null)
    {
        $this->email = $var;
    }
    private function setMdp($var = null)
    {
        $this->mdp = $var;
    }
    private function setPhotoProfile($var = null)
    {
        $this->photoProfile = $var;
    }
    private function setIdPermission($var = null)
    {
        $this->idPermission = $var;
    }
    private function setDateMentionAccepte($var = null)
    {
        $this->dateMentionAccepte = $var;
    }
    private function setToken($var = null)
    {
        $this->token = $var;
    }
//// GETTERS
    public function getIdUtilisateur()
    {
        return  $this->idUtilisateur;
    }
    public function getNom()
    {
        return  $this->nom;
    }
    public function getPrenom()
    {
        return  $this->prenom;
    }
    public function getEmail()
    {
        return  $this->email;
    }
    public function getMdp()
    {
        return  $this->mdp;
    }
    public function getToken()
    {
        return  $this->token;
    }
    public function getPhotoProfile()
    {
        return  $this->photoProfile;
    }
    public function getdateMentionAccepte()
    {
        return  $this->dateMentionAccepte;
    }

}