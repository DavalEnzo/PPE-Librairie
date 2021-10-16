<?php

class Utilisateur extends Modele{

    public function verifUtilisateur(){
        $requete = $this->getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
        $requete->execute([$_POST["email"]]);
        return $requete;
    }

    public function inscriptionUtilisateur($nom,$prenom,$email,$mdp){
        $requete = $this->getBdd()->prepare("INSERT INTO utilisateurs(nom,prenom,email,mdp) VALUES(?,?,?,?)");
        $requete->execute([$nom,$prenom,$email,$mdp]);
    }

    public function connexion($email){
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
}