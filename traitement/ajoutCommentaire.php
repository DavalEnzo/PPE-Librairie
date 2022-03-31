<?php
require_once("../modeles/modele.php");
if(isset($_GET["idLivre"]) &&!empty($_GET['idLivre'])){
    $idLivre = $_GET["idLivre"];
}
if(isset($_POST["contenu"]) && !empty($_POST["contenu"])){
    $contenu = $_POST["contenu"];
    $idUtilisateur =  $_SESSION["idUtilisateur"];
if(isset($_POST['selectGrade'])&& !empty($_POST['Entete'])){
    $selectGrade  = $_POST['selectGrade'];
}else{
    $selectGrade  = NULL;
}
if(isset($_POST['Entete'])&&!empty($_POST['Entete']))
{
    $Entete  = $_POST['Entete'];
}    else{
    $Entete  = NULL;
}

try{
    $com = new Commentaire();
    $com->initializeCom(NULL,$contenu,$idUtilisateur,$idLivre,$selectGrade,$Entete,NULL,true);
    $com->insertCom();
    header("location:../membres/pageProduit.php?idLivre=".$idLivre);
    ?>
    <div class="alert alert-success mt-3">Le commentaire a bien été enregistré</div>
    <?php
    }catch(Exception $e){
        echo "Il y a une erreur";
        echo $e->getMessage();
    }  
};
?>