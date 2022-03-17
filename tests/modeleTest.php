<?php
session_start();
class Modele{
public function getBdd(){
    return new PDO('mysql:host=localhost;dbname=bibliotheque;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
}