<?php
session_start();
class Modele{
protected function getBdd(){
    return new PDO('mysql:host=localhost;dbname=bibliotheque;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); //LOCAL
    //return new PDO('mysql:host=ipssisqunlivrepr.mysql.db;dbname=ipssisqunlivrepr;charset=utf8', 'ipssisqunlivrepr', 'Ipssi2022unlivrepresdechezvous',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); PROD
}
public function object_to_array($data)
{
        if(is_array($data) || is_object($data))
        {
            $result = array();
            foreach($data as $key => $value) {

                if(is_array($value))
                {
                  if($key == 'TypeGenre')
                  {
                      foreach($value as $v)
                      {
                          print_r($v);
                          exit;
                          $result[$key][] = $this->object_to_array($v);
                      }
                  }
                }else{

                    $result[$key] = $this->object_to_array($value);
                }


            }
            return $result;
        }
        return $data;
    }
}

require_once 'Auteur.php';
require_once 'Bibliotheque.php';
require_once 'Livre.php';
require_once 'Commentaire.php';
require_once 'Genre.php';
require_once 'TypeGenre.php';
require_once 'Editeur.php';
require_once 'Lectures.php';
require_once '../modeles/Panier.php';
require_once 'Stockage.php';
require_once 'DetailCommandes.php';
require_once 'Utilisateur.php';
require_once 'Commande.php';
require_once 'Adresse.php';
