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
                    <div class="col-md-3">
                        <img style="max-width: 300px;" src="<?=$livres["Photo"]?>" >
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=$livres["Titre"]?></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
<?php       
    if($livres["droit"] == 1 ){
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
        <?php 
        
        if(isset($_SESSION) && !empty($_SESSION)){
            ?>
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
        }else{
            ?>
            <div style="margin-left: 15.5%; width:69%" class="alert alert-danger text-center">Vous devez être connecté pour pouvoir commenter un livre</div>
            <?php
        }
    
    $com = new Commentaire();
    $commentaires = $com->getAllComs($idLivre);

    foreach($commentaires as $commentaire){

        $date = $commentaire['date_heure'];
        $dateFormatee = date('d-m-Y H:i:s', strtotime($date));

        $dateSeulement = substr($dateFormatee, 0, -9);
        $heureSeulement = substr($dateFormatee, -8);
        ?>

        <div class="container roundedBorders my-3">
            <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="col-md-12"style="max-width:150px;margin:auto">
                            <img style="width:100%;" src="<?=$commentaire["photoProfile"]?>" alt="Photo de Profil">
                        </div>
                            <h4><?=$commentaire["nom"]." ".$commentaire["prenom"]?></h4>
                    </div>
                    <div class="col-md-1 bSn"></div>
                    <div class="col-md-8 row" style="width:75%"> 
                    
                    <?php
                    if(!empty($commentaire['entete']))
                    {
                      ?>
                         <div class="col-md-12"  >
                            <h3><?=$commentaire['entete']?></h3>
                        </div>
                      <?php  
                    }
    
                    if(!empty($commentaire['grade']))
                    {
                       
                        
                        if(strlen($commentaire['grade']) > 1)
                        {
                            $grade = explode(".",$commentaire['grade']);
                        }else{
    
                            $grade = $commentaire['grade'];
                            
                        }
                    ?>
                   
                        <div class="col-md-6" >
                            <span>Note : </span>
                            <?php
                            if(is_array($grade)){
                                $n = 5;
                                if($grade[0] == 0)
                                {
                                    if($grade[1] == 5){
                                       ?>
                                        <span class="far fa-star starYell"></span>
                                        <?php
                                        $n =0;
                                    }else{
                                        $n = 0;
                                    }
                                }
                                if($n==0){
    
                                }else{
    
                                     $emptyStar = $n-$grade[0] ;
                                    for($i=0,$n=sizeof($grade);$i<$n;$i++)
                                    {
                                        if($i >= ($n-$emptyStar))
                                        { 
                                            
                                            ?>
                                            <span class="far fa-star starYell"></span>
                                        <?php
                                        }
                                    }
                                }
                               
                            }else{
                                $n = 5;
                                $emptyStar = $n-$grade ;
                               
                                for($i=0;$i<$n;$i++)
                                { 
                                    if($i >= ($n-$emptyStar))
                                    { 
                                        ?>
                                        <span class="far fa-star starYell"></span>
                                    <?php
                                    }else{
                                    ?>
                                    <span class="fas fa-star starYell"></span>
                                    <?php
                                    }
    
                                }
                            }
                            ?>
                        </div>
                        <div class="col-md-6" style="text-align: right;" >
                            <span>Publié le : <?=$dateSeulement;?> à <?=$heureSeulement;?></span>
                        </div>
                         <?php    
                    }else{
                        ?>
                        <div class="col-md-12" style="text-align: right;" >
                            <p>Publié le : <?=$dateSeulement;?> à <?=$heureSeulement;?></p>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="col-md-12">
                            <p><?=$commentaire["contenu"]?></p>
                        </div>
                    </div>
            </div>
        </div>
        <?php
        }; 
require_once("pied.php");
?>