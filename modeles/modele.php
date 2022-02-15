<?php
session_start();
class Modele{
protected function getBdd(){
    return new PDO('mysql:host=localhost;dbname=bibliotheque;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); //LOCAL
    //return new PDO('mysql:host=ipssisqunlivrepr.mysql.db;dbname=ipssisqunlivrepr;charset=utf8', 'ipssisqunlivrepr', 'Ipssi2022unlivrepresdechezvous',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); PROD
}
}

require_once 'Auteur.php';
require_once 'Bibliotheque.php';
require_once 'Ecrit.php';
require_once 'Commentaire.php';
require_once 'Genre.php';
require_once 'Editeur.php';
require_once 'Lectures.php';
require_once '../modeles/Panier.php';
require_once 'Stockage.php';
require_once 'Utilisateur.php';
require_once 'Commande.php';