<?php


require_once("entete.php");

if(isset($_GET["idLivre"]) &&!empty($_GET['idLivre'])){
        $idLivre = $_GET["idLivre"];
        $Livre = new Livre($idLivre);
    }else{
        header("index.php");
    }

if(isset($_GET["success"])&& $_GET['success'] == 1 ){
    ?>
      <div class="alert alert-success mt-3">Le livre <strong>"<?=$Livre->getTitre()?>"</strong> a bien été ajouté dans votre panier, vous pouvez le consulter <a href="panier.php"><strong>ici</strong></a></div>
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
                        <img style="max-width: 300px;" src="<?=$Livre->getPhoto()?>" >
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><?=$Livre->getTitre()?></h3>
                            <?php
                            foreach($Livre->getAuteur() as $auteur){
                                ?>
                                <h5 >de <?=$auteur->getNomAuteur();?></h5>
                                <?php
                            }
                        
                            foreach($Livre->getEditeur() as $editeur)
                            {
                                ?>
                                <p class="card-subtitle mb-2 text-muted"><?=$editeur->getNomEditeur();?></p>
                                <?php
                            }
                            ?>
                            <h5 class="card-title">Résumé :</h5>
                            <p class="card-text"><?=$Livre->getDescription()?></p>
                            <?php
                        if($Livre->getdroit() == 1 ){
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
            <div class="container BackGround roundBorder py-1 mb-2">
                <form method="post" action = '../traitement/addComentaire.php?idLivre=<?=$idLivre?>'>
                    <div class="form-group">
                        <label class="mr-sm-2 textColor" for="selectGrade">Note du produit :</label>
                        <select class="custom-select mr-sm-2" name="selectGrade" id="selectGrade">
                            <option selected>Note...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>    
                    <div class="form-group my-1">
                        <!-- <label for="contenu" class=" textColor ">Titre du commentaire:</label> -->
                        <input type="text" class ="form-control" name="Entete" id="Entete" placeholder="Saisisser votre titre ici !"></input>
                    </div>    
                    <div class="form-group">
                        <!-- <label for="contenu" class=" textColor ">Contenu du Commentaire :</label> -->
                        <textarea class ="form-control" name="contenu" id="contenu" placeholder="Saisisser votre commentaire ici !" rows="3"></textarea>
                    </div>    
                    <div class="form-group text-center py-3">
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

    foreach($Livre->getCommentaires() as $commentaire){

        $user = $commentaire->getUtilisateur();
        $date = $commentaire->getDateHeure();
        $dateFormatee = date('d-m-Y H:i:s', strtotime($date));

        $dateSeulement = substr($dateFormatee, 0, -9);
        $heureSeulement = substr($dateFormatee, -8);
        ?>
        <div class="container roundedBorders my-3">
            <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="col-md-12"style="max-width:150px;margin:auto">
                            <img style="width:100%;" src="<?=$user->getPhotoProfile()?>" alt="Photo de Profil">
                        </div>
                            <h4><?=$user->getNom()." ".$user->getPrenom()?></h4>
                    </div>
                    <div class="col-md-1 bSn"></div>
                    <div class="col-md-8 row" style="width:75%"> 
                    
                    <?php
                    if(!empty($commentaire->getEntete()))
                    {
                      ?>
                         <div class="col-md-12"  >
                            <h3><?=$commentaire->getEntete()?></h3>
                        </div>
                      <?php  
                    }
    
                    if(!empty($commentaire->getGrade()))
                    {
                       
                        
                        if(strlen($commentaire->getGrade()) > 1)
                        {
                            $grade = explode(".",$commentaire->getGrade());
                        }else{
    
                            $grade = $commentaire->getGrade();
                            
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
                            <p><?=$commentaire->getContenu()?></p>
                        </div>
                    </div>
            </div>
        </div>
        <?php
        }; 
require_once("pied.php");
?>