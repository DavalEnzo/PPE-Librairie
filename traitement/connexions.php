<?php
require_once '../modeles/modele.php';

$u = New Utilisateur;

extract($_POST);

if (isset($_POST["envoi"]) && !empty($_POST["envoi"]) && $_POST["envoi"] == 1) {

    $erreurs = [];

    if (!isset($mdp) || empty($mdp) ||
        !isset($email) || empty($email)
    ) {
        $erreurs[] = "L'un des champs est vide";
    }


  
  
    // Si on a pas d'erreurs à ce stade, on va commencer les vérification dans la bdd
    if (count($erreurs) == 0) {
        $requete=$connexion = $u->connexion([$email]);
        
        // Vérification si l'email n'existe pas en regardant le nombre de lignes retournées par la requête
        if ($requete->rowCount() > 0) {
            // l'email existe
            $utilisateur =$requete->fetch(PDO::FETCH_ASSOC);
            
            
            // Vérifier si les mots de passe ne correspondent pas
            if (!password_verify($mdp, $utilisateur["mdp"])) {
                // le mot de passe ne correspond pas
                $erreurs[] = "Le mot de passe saisi est incorrect";
            }else if($utilisateur['actif'] == 0){
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
        $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];
        $_SESSION["email"] = $utilisateur["email"];
        $_SESSION["idPermission"] = $utilisateur["idPermission"];
        $_SESSION["photoProfile"] = $utilisateur["photoProfile"];
        $_SESSION['nom'] = $utilisateur['prenom'].' '.$utilisateur['nom'];
        $_SESSION['nomSimple'] = $utilisateur['nom'];
        $_SESSION['prenom'] = $utilisateur['prenom'];

        if(isset($souvenir) && ($souvenir) == 1 )
        {
            $token = bin2hex(random_bytes(20));
            $u->addToken($token,$utilisateur['idUtilisateur']);
            setcookie('souvenir',$utilisateur['idUtilisateur']."-".$token,time() + (10 * 365 * 24 * 60 * 60), "/", "", false, true);
        }

        $recupPanier=$u->userPanier($utilisateur['idUtilisateur']);

        if($recupPanier->rowCount() != 0){
        $panier = $recupPanier->fetch(PDO::FETCH_ASSOC);
        $_SESSION["idPanier"] = $panier['idPanier'];
        }

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