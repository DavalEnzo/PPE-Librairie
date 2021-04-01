<?php
require_once("entete.php");

if(isset($_GET["idLivre"]) &&!empty($_GET['idLivre'])){
        $idLivre = $_GET["idLivre"];
        $livres=livreBibli($idLivre);
    }else{
        header("index.php");
    }

if(isset($_POST["contenu"]) && !empty($_POST["contenu"])){
        $contenu = $_POST["contenu"];
        
        $idUtilisateur =  $_SESSION["idUtilisateur"];
    
    try{
        insertCom($contenu,$idLivre,$idUtilisateur);
        ?>
        <div class="alert alert-success mt-3">Le formulaire a bien été enregistrer</div>
        <?php

        }catch(Exception $e){
            echo "Il y a une erreur";
            echo $e->getMessage();
        }  
};

?>

        <div class="container  d-flex justify-content-center" >
            <div class="card mb-3" >
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?=$livres["Photo"]?>" style="width: 100%;" >
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=$livres["Titre"]?></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
<?php       
    if($livres["droit"] == 2 ){
        ?>
                            <a href="lecture.php?id=<?=$idLivre?>" class="btn btn-primary">Lecture libre de droit</a>
                            <?php
                        }else{
                            ?>
                            <a href="#" class="btn btn-primary">Ajouter au panier</a>
                            <?php
                        }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </br>
    <div class="container">
        <form method="post">
            
            <div class="form-group">
                <label for="contenu">Commenter le produit</label>
                <textarea class ="form-control" name="contenu" id="contenu" placeholder="Saisisser le contenu de votre post" rows="3">
                </textarea>
            </div>    
        <div class="form-group text-center my-3">
            <button type="submit" class="btn btn-primary">Ajouter le Commentaire</button>
        </div>
        </form>
    </div>
    <?php
    
    $commentaires=selectCom($idLivre);
    foreach($commentaires as $commentaire){
    ?>
    <div class="container">
        <table>
            <tr>
                <td><p><?=$commentaire["contenu"]?></p></td>
            </tr>
        </table>
    </div>
    <?php
}; 
require_once("pied.php");
?>