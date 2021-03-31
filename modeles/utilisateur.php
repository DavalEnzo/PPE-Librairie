<?php

function verifUtilisateur(){
    $requete = getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
    $requete->execute([$_POST["email"]]);
    return $requete;
}

function inscriptionUtilisateur($nom,$prenom,$email,$mdp){
    $requete =getBdd()->prepare("INSERT INTO utilisateurs(nom,prenom,email,mdp) VALUES(?,?,?,?)");
    $requete->execute([$nom,$prenom,$email,$mdp]);
}

function connexion($email){
    $requete = getBdd()->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $requete->execute($email);
    return $requete;
}