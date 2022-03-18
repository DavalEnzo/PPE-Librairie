<?php

use function PHPSTORM_META\type;

require_once '../modeles/modele.php';

$u = New Utilisateur();


extract($_POST);

if (isset($_POST["envoi"]) && !empty($_POST["envoi"]) && $_POST["envoi"] == 1) {

    $erreurs = [];

    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
    {
        $secret = '6LfcxeseAAAAAHpZVnzSYQuMPWt3T8hwM5sGc9AC';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        { 

        }else{
            $erreurs[] = "Echec lors de la vérification reCaptacha. Veuillez réessayer.";
        }
   }else if(empty($_POST['g-recaptcha-response']) && count($u->verifTentativeConnexion($_SERVER['REMOTE_ADDR'])) == 3){
    $erreurs[] = "Veuillez prouver que vous êtes humain.";
   }

    if (!isset($mdp) || empty($mdp) ||
        !isset($email) || empty($email)
    ) {
        $erreurs[] = "L'un des champs est vide";
    }
  
    // Si on a pas d'erreurs à ce stade, on va commencer les vérification dans la bdd
    if (count($erreurs) == 0) {
        $u->verifUtilisateur([$email]);      
        // Vérification si l'email n'existe pas en regardant le nombre de lignes retournées par la requête
        if (!empty($u)) {
            // l'email existe

            // Vérifier si les mots de passe ne correspondent pas
            if (!password_verify($mdp, $u->getMdp())) {
                // le mot de passe ne correspond pas
                $erreurs[] = "Un ou plusieurs champs sont incorrects";

                if(count($u->verifTentativeConnexion($_SERVER['REMOTE_ADDR'])) < 3){
                    $u->tentativeConnexionEchouee($_SERVER['REMOTE_ADDR']);                    
                }

            }else if($u->getActive() == 0){
                $erreurs[] = "Votre compte a été banni.";
            }
        } else {
            // l'email n'existe pas
            $erreurs[] = "L'adresse mail n'existe pas";
        }
    }
    
    // Si après les vérification dans la bdd je n'ai toujours pas d'erreurs
    if (count($erreurs) == 0) {
        // on connecte l'utilisateur
        $_SESSION["idUtilisateur"] = $u->getIdUtilisateur();
        $_SESSION["email"] = $u->getEmail();
        $_SESSION["idPermission"] = $u->getIdPermission();
        $_SESSION["photoProfile"] = $u->getPhotoProfile();
        $_SESSION['nom'] = $u->getPrenom().' '.$u->getNom();
        $_SESSION['nomSimple'] = $u->getNom();
        $_SESSION['prenom'] = $u->getPrenom();

        
        if($u->getIdPermission() == 1)
        {
            $verifAdmin = $u->checkAdminAllowedIP($_SERVER['REMOTE_ADDR']);

            //var_dump(gettype($verifAdmin));exit;
            
            if(count($verifAdmin) <= 1){
                header('location:../membres/connexion.php?success=0&erreurs=1');
            }
        }

        if(isset($souvenir) && ($souvenir) == 1 )
        {
            $token = bin2hex(random_bytes(20));
            $u->addToken($token,$_SESSION['idUtilisateur']);
            setcookie('souvenir',$_SESSION['idUtilisateur']."-".$token,time() + (10 * 365 * 24 * 60 * 60), "/", "", false, true);
        }

        $panier = $u->getPanier();
        $recupPanier = $panier->getStockages();
        $arrObj = new ArrayObject($recupPanier);

        if($arrObj->Count() != 0){
        $_SESSION["idPanier"] = $panier->getIdPanier();
        }

        $u->addUserLogs($_SESSION['idUtilisateur'], $_SERVER['REMOTE_ADDR']);

        header('location:../membres/connexion.php?success=1');
    } else {
        // on affiche les erreurs
        ?>
            <div class="alert alert-danger">
                Erreur<?=(count($erreurs) > 1 ? "s" : "")?> :
                <?php
foreach ($erreurs as $erreur) {
            ?>
                    <br><?=$erreur;?>
                    <?php                                  
}
        ?>
            </div>
            <?php
            header("location:../membres/connexion.php?success=0&erreurs=".$erreurs[0]);
}

}