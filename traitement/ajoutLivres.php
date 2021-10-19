<?php
require_once '../modeles/modele.php';

$bibli =new Bibliotheque();
$aut = new Auteur();
$Ecrit = new Ecrit();

if (isset($_POST["photo"]) && !empty($_POST["photo"]) &&
isset($_POST["titre"]) && !empty($_POST["titre"]) &&
isset($_POST["prix"]) && !empty($_POST["prix"]) &&
isset($_POST["editeur"]) && !empty($_POST["editeur"]) &&
isset($_POST["date"]) && !empty($_POST["date"]) &&
isset($_POST['genre']) && !empty($_POST['genre']))
{
// initialisation de la connexion à la base de données
// $bdd = new PDO('mysql:host=localhost;dbname=maboutique', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// récupération des données du formulaire dans des variables plus simples

        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];

        if(isset($_POST['editeur']) && !empty($_POST['editeur'])){
            $editeur = $_POST['editeur'];
        }else{
            $editeur = $_POST['editeurs'];
        }

        $editeur = $_POST['editeur'];
        $date = $_POST['date'];
        $prix = $_POST['prix'];
        $photo = $_POST['photo'];
        $genres = $_POST['genre'];
        $a = $_POST['auteurs'];
        $check = $_POST['audio'];
        $droit = 1;

        if($check === null){
            $check = 0;
        }

        if($prix == 0){
            $droit = 0;
        }


// insertion des données
// on essaye ce qui est dans le try
        if(isset($_POST['auteur']) && !empty($_POST['auteur']) && $a ==0){

            try {
                $bibli->insertBibli($titre, $date, $prix, $photo, $genres, $check, $droit);
                $aut->insertAuteur($auteur);
                $Ecrit->insertEcrit();   
                ?>

      
        <?php
        header("location:../membres/ajoutLivre.php?success=1");

        // si une erreur php est généré, alors on rentre dans notre catch
        } catch(Exception $e){
            echo $e->getMessage();exit;
            header("location:../membres/ajoutLivre.php?success=0");
             }
        }
        if(isset($_POST['auteurs']) && !empty($_POST['auteurs']) && $a>0 && empty($_POST["auteur"])){
            try {
                $bibli->insertBibli($titre, $date, $prix, $photo, $genres, $check, $droit);
                $aut->insertAuteur2($a);
                header("location:../membres/ajoutLivre.php?success=1");
        
            // si une erreur php est généré, alors on rentre dans notre catch
            } catch(Exception $e){
                echo $e->getMessage();exit;
                header("location:../membres/ajoutLivre.php?success=0");
        
            }
        }
        
            
    }
    