<?php
require_once '../modeles/modele.php';

$Livre = new Livre();
$aut = new Auteur();
$Editeur = new Editeur();

if (
    isset($_FILES["photo"]) && !empty($_FILES["photo"]) &&
    isset($_POST["titre"]) && !empty($_POST["titre"]) &&
    isset($_POST["prix"]) &&
    isset($_POST["date"]) && !empty($_POST["date"]) &&
    isset($_POST['genre']) && !empty($_POST['genre']) &&
    isset($_POST['typeGenre']) && !empty($_POST['typeGenre']) &&
    isset($_POST['description']) && !empty($_POST['description'])
) {
    if (isset($_POST['auteur']) && !empty($_POST['auteur'])) {
        $auteur = $_POST['auteur'];
        $a = $_POST['auteurs'];
    } else if (isset($_POST['auteurs']) && !empty($_POST['auteurs'])) {
        $a = $_POST['auteurs'];
    }
    if (isset($_POST['editeur']) && !empty($_POST['editeur'])) {
        $editeur = $_POST['editeur'];
        $Editeur->insertEditeur($editeur);
        $editeur = $Editeur->getIdEditeur();
    } else if (isset($_POST['editeurs']) && !empty($_POST['editeurs'])) {
        $editeur = $_POST['editeurs'];
    }
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $prix = $_POST['prix'];
    $photo = $_FILES['photo'];

    if (is_numeric($_POST['genre'])) {
        $genres = $_POST['genre'];
    } else {
        $genres = 0;
    }

    if (is_numeric($_POST['typeGenre'])) {
        $typeGenre = $_POST['typeGenre'];
    } else {
        $typeGenre = 0;
    }

    $droit = 0;

    if ($prix == 0) {
        $droit = 1;
    }
    if (isset($_FILES['photo']['error']) && empty($_FILES['photo']["error"])) {

        $nom = "photoLivre";
        $dossier = "../membres/img/photoLivre/";
        $fichier = null;
        $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $search = array(' ', "'", '"', ":");
        $replace = array('-');
        $name = $titre;
        $name = str_replace($search, $replace, $name);
        $fichier = $dossier . $nom . "-" . $name . "." . $extension;

        // Vérifier si on peut récupérer les dimensions de l'image
        if (getimagesize($_FILES['photo']['tmp_name'])) {

            // Vérifier si la taille de l'image ne dépasse pas 5 mégas
            if ($_FILES['photo']['size'] <= 5000000) {

                // Vérifier le vrai type du ficher
                if ($_FILES['photo']['type'] == "image/png" || $_FILES['photo']['type'] == "image/jpeg") {
                    // On enregistre le fichier et on test si ça a fonctionné
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $fichier)) {
                    } else {
                        header("location:../membres/ajoutLivre.php?success=21");
                    }
                } else {

                    header("location:../membres/ajoutLivre.php?success=21");
                }
            } else {

                header("location:../membres/ajoutLivre.php?success=22");
            }
        } else {

            header("location:../membres/ajoutLivre.php?success=23");
        }
    }

    // récupération des données du formulaire dans des variables plus simples
    $continue = false;
    if (
        isset($_FILES['numerique']) && !empty($_FILES["numerique"])
        && isset($_FILES['numerique']['error']) && empty($_FILES['numerique']["error"])
    ) {
        if ($_FILES['numerique']['type'] == "application/pdf") {
            $dossier =    "../membres/livres/";
            $extension = strtolower(pathinfo($_FILES['numerique']['name'], PATHINFO_EXTENSION));
            $search = array(' ', "'", '"', ":");
            $replace = array('-');
            $name = $titre;
            $name = str_replace($search, $replace, $name);
            $movePdf = $dossier . $nom . "-" . $name . "." . $extension;
            $pdf ="livres/". $nom . "-" . $name . "." . $extension;
            $continue = true;
            if (move_uploaded_file($_FILES['numerique']['tmp_name'], $pdf)) {
            } else {
                header("location:../membres/ajoutLivre.php?success=21");
            }
        }else{
            header("location:../membres/ajoutLivre.php?success=25");
        }
    } else {
        header("location:../membres/ajoutLivre.php?success=24");
    }

    // insertion des données
    // on essaye ce qui est dans le try
    if (isset($_POST['auteur']) && !empty($_POST['auteur']) && $a == 0) {

        try {
            $Livre->initialize(null, $titre, $date, $prix, $fichier, $genres, $typeGenre, $editeur, null, $droit, $description, null);
            $Livre->insertLivre();
            $aut->initialize(null, $auteur);
            $aut->insertAuteur();
            $aut->insertEcrit();

            if ($continue) {
                $idLivre =  $Livre->getMaxIdLivre();
                $lecture = new Lecture();
                $lecture->initLecture(NULL,$idLivre,$pdf);
                $lecture->insertLecture();
            }

            header("location:../membres/ajoutLivre.php?success=1");
            // si une erreur php est généré, alors on rentre dans notre catch
        } catch (Exception $e) {
            echo $e->getMessage();
            header("location:../membres/ajoutLivre.php?success=0");
        }
    }
    if (isset($_POST['auteurs']) && !empty($_POST['auteurs']) && $a > 0 && empty($_POST["auteur"])) {
        try {
            $Livre->initialize(null, $titre, $date, $prix, $fichier, $genres,  $typeGenre, $editeur, null, $droit, $description, null);
            $Livre->insertLivre();
            $aut->insertEcrit($a);

            if ($continue) {
                $idLivre =  $Livre->getMaxIdLivre();
                $lecture = new Lecture();
                $lecture->initLecture(NULL,$idLivre,$pdf);
                $lecture->insertLecture();
            }

            header("location:../membres/ajoutLivre.php?success=1");

            // si une erreur php est généré, alors on rentre dans notre catch
        } catch (Exception $e) {
            echo $e->getMessage();
            header("location:../membres/ajoutLivre.php?success=0");
        }
    }
} else {
    header("location:../membres/ajoutLivre.php?success=0");
}
