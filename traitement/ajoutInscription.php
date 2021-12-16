<?php
require_once '../modeles/modele.php';

$u = New Utilisateur;

$utilisateur = $u->verifUtilisateur();

    if(isset($_POST["envoi"]) && !empty($_POST["envoi"])
    && $_POST["envoi"] == 1){
        $erreurs = [];
        if(isset($_POST["email"]) && !empty($_POST["email"])
            && isset($_POST["mdp"]) && !empty($_POST["mdp"]) 
            ){
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $erreurs[]= "L'adresse mail est invalide, veuillez vérifier qu'il contient un '@' et un domaine (.com, .fr...).";
                  }
                
                if($utilisateur->rowcount() > 0){
                    $erreurs[]= "L'adresse mail saisie existe déjà";
                }

            }else{
                
                  $erreurs[] = "au moins un champ n'a pas été saisi";

                
                }
                if(count($erreurs)===0){
                        //on envoie le formulaire
                        extract($_POST);
                       
                        try{
                             echo "Enregistrement du formulaire";
                            //on hash le mdp
                            $mdp = password_hash($mdp, PASSWORD_BCRYPT);
                            //insertion dans la base de donnée
                            $u->inscriptionUtilisateur($nom,$prenom,$email,$mdp);
                            header("location:../membres/inscription.php?success=1&nom=".$nom);
                        }catch(Exception $e){
                            //un problème s'est produit lors de l'insertion en bdd

                        }
                }else{
                    // on affiche les erreurs
                    header("location:../membres/inscription.php?success=0&erreurs=".$erreurs[0]);
                }
    } 