<?php
require_once '../modeles/modele.php';

$u = New Utilisateur();


if(isset($_POST["envoi"]) && !empty($_POST["envoi"])
&& $_POST["envoi"] == 1){
    $erreurs = [];
    if(isset($_POST["email"]) && !empty($_POST["email"])
    && isset($_POST["mdp"]) && !empty($_POST["mdp"]) 
    ){
                $utilisateur = $u->verifUtilisateur();
                $arrObjet = new ArrayObject($u);
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $erreurs[]= "L'adresse mail est invalide, veuillez vérifier qu'il contient un '@' et un domaine (.com, .fr...).";

                }elseif($arrObjet->count() > 0){

                    $erreurs[]= "L'adresse mail saisie existe déjà";

                }elseif(strlen($_POST['mdp']) < 8){
                
                    $erreurs[] = "Le mot de passe doit faire au moins 8 caractères";
    
                }elseif(!preg_match("#[0-9]+#", $_POST["mdp"])){
                    
                    $erreurs[] = "Le mot de passe doit contenir au moins un caractère numérique (ex: 5)";
    
                }elseif(!preg_match("#[A-Z]+#", $_POST["mdp"])){
                    
                    $erreurs[] = "Le mot de passe doit contenir au moins une lettre majuscule (ex: A)";

                }elseif(empty($_POST['mdp']) || empty($_POST['email'])){

                    $erreurs[] = "au moins un champ n'a pas été saisi";

                }elseif(!preg_match('/^[A-Za-z]+$/', $_POST['prenom']) || !preg_match('/^[A-Za-z]+$/',$_POST['nom'])){

                    $erreurs[] = "Caractère incorrect entré pour le nom ou le prénom";
                }
            }

                if(count($erreurs)===0){
                        //on envoie le formulaire
                        extract($_POST);
                       
                        try{
                             echo "Enregistrement du formulaire";
                            //on hash le mdp
                            $mdp = password_hash($mdp, PASSWORD_BCRYPT);
                            //insertion dans la base de donnée
                            $u->initialize(null,$nom,$prenom,$email,$mdp);
                            $u->inscriptionUtilisateur();
                            header("location:../membres/inscription.php?success=1&nom=".$nom);
                        }catch(Exception $e){
                            //un problème s'est produit lors de l'insertion en bdd

                        }
                }else{
                    // on affiche les erreurs
                    header("location:../membres/inscription.php?success=0&erreurs=".$erreurs[0]);
                }
    } 