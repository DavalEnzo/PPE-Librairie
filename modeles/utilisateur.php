<?php

class Utilisateur extends Modele{

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
    
}