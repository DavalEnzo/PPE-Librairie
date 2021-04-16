<?php
session_start();
class Modele{
protected function getBdd(){
    return new PDO('mysql:host=localhost;dbname=livres;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
}

require_once 'utilisateur.php';
require_once 'Auteur.php';
require_once 'Bibliotheque.php';
require_once 'Ecrit.php';
require_once 'commentaire.php';
require_once 'Genre.php';
require_once 'Editeur.php';
require_once 'lectures.php';