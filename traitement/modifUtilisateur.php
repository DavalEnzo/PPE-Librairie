<?php require_once '../modeles/modele.php'?>

<?php

$utilisateur = new Utilisateur;


if(isset($_POST["nom"]) && !empty($_POST['nom']) && isset($_POST["prenom"]) 
&& !empty($_POST['prenom']) && isset($_POST["email"]) && !empty($_POST['email'])){
    if(isset($_FILES['photoProfile']['error']) && empty($_FILES['photoProfile']["error"])){

        $nom = "profilePicture";
        $dossier = "../membres/photoProfile/";
        $fichier = null;
        $extension = strtolower(pathinfo($_FILES['photoProfile']['name'], PATHINFO_EXTENSION));

        $fichier = $dossier . $nom . "-" ."idUser=" . $_SESSION['idUtilisateur'] . "." . $extension;


                        // Vérifier si on peut récupérer les dimensions de l'image
                        if(getimagesize($_FILES['photoProfile']['tmp_name'])){

                            // Vérifier si la taille de l'image ne dépasse pas 5 mégas
                            if($_FILES['photoProfile']['size']<= 5000000){

                                // Vérifier le vrai type du ficher
                                if($_FILES['photoProfile']['type'] == "image/png" || $_FILES['photoProfile']['type'] == "image/jpeg"){
                                    // On enregistre le fichier et on test si ça a fonctionné
                                    if(move_uploaded_file($_FILES['photoProfile']['tmp_name'], $fichier)){

                                        try{                                        
                                        $requete = $utilisateur->modifPhotoProfile($_SESSION['idUtilisateur'], $fichier);
                                        $_SESSION['photoProfile'] = $fichier;
                                        }catch(Exception $e){
                                            echo $erreur = $e->getMessage();
                                            header("location:../membres/profil?success=2&e=".$erreur);
                                        }
                                    }else{
                                        $erreur = 1;
                                        header("location:../membres/profil?success=2&erreur=".$erreur);
                                    }
                                }else{
                                    $erreur = 2;
                                    header("location:../membres/profil?success=2&erreur=".$erreur);
                                }
                            }else{
                                $erreur = 3;
                                header("location:../membres/profil?success=2&erreur=".$erreur);
                            }               
                    }else{
                       $erreur = 4;
                       header("location:../membres/profil?success=2&erreur=".$erreur);exit;
                    }
                }

                extract($_POST);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erreur = 6;
                    header("location:../membres/profil?success=2&erreur=".$erreur);exit;
                  }

                $utilisateur->modifProfile($nom, $prenom, $email, $_SESSION['idUtilisateur']);

                $_SESSION['nomSimple'] = $nom; 
                $_SESSION['prenom'] = $prenom; 
                $_SESSION['email'] = $email; 

                header("location:../membres/profil?id=".$_SESSION['idUtilisateur']."&success=1");

}else{
    $erreur = "Un champ n'a pas été rempli, veuillez vérifier votre saisie.";
    header("location:../membres/profil?success=3&erreur=".$erreur);
}