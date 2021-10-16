<?php
require_once("entete.php");




if(isset($_GET["idLivre"]) &&!empty($_GET['idLivre'])){
        $idLivre = $_GET["idLivre"];
        $Bibli = new Bibliotheque($idLivre);
        $livres = $Bibli->getInfoId();
    }else{
        header("index.php");
    }

if(isset($_POST["contenu"]) && !empty($_POST["contenu"])){
        $contenu = $_POST["contenu"];
        
        $idUtilisateur =  $_SESSION["idUtilisateur"];
    
    try{
        $com = new Commentaire($idLivre);
        $com->insertCom($contenu,$idLivre,$idUtilisateur);
        ?>
        <div class="alert alert-success mt-3">Le commentaire a bien été enregistré</div>
        <?php

        }catch(Exception $e){
            echo "Il y a une erreur";
            echo $e->getMessage();
        }  
};

if(isset($_GET["success"])&& $_GET['success'] == 1 ){
    ?>
      <div class="alert alert-success mt-3">Le livre <strong>"<?=$livres["Titre"]?>"</strong> a bien été ajouté dans votre panier, vous pouvez le consulter <a href="panier.php"><strong>ici</strong></a></div>
      <?php 
  }else if(isset($_GET["success"])&& $_GET['success'] == 0 ){
      ?>
      <div class="alert alert-danger">Le livre n'a pas pu être ajouté à votre panier</div>
      <?php
  }

?>

        <div class="container  d-flex justify-content-center my-2" >
            <div class="card mb-3" >
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?=$livres["Photo"]?>" >
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
                            <a type="submit" href="../traitement/ajoutPanier.php?id=<?=$idLivre?>" class="btn btn-primary">Ajouter au panier</a>
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
                <textarea class ="form-control" name="contenu" id="contenu" placeholder="Saisisser le contenu de votre post" rows="3"></textarea>
            </div>    
        <div class="form-group text-center my-3">
            <button type="submit" class="btn btn-primary">Ajouter le Commentaire</button>
        </div>
        </form>
    </div>
    <?php
    
    $com = new Commentaire($idLivre);
    $commentaires = $com->getCom();
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