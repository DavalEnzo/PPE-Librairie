<?php include_once 'entete.php'?>

<?php

    $com = new Commentaire();
    $commentaires = $com->getAllUserComs($_SESSION['idUtilisateur']);

    if(isset($commentaires) && !empty($commentaires)){
    
    foreach($commentaires as $commentaire){
        $date = $commentaire['date_heure'];
        $dateFormatee = date('d-m-Y H:i:s', strtotime($date));

        $dateSeulement = substr($dateFormatee, 0, -9);
        $heureSeulement = substr($dateFormatee, -8);
        ?>

    <div class="container roundedBorders my-3" style="width: 60%;">
        <div class="row">
                <div class="col-md-3 text-center">
                        <h4><?=$commentaire["nom"]." ".$commentaire["prenom"]?></h4>
                </div>
                <div class="col-md-1 bSn"></div>
                <div class="col-md-8 row" style="width:70%">
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
                        $grade = explode(",",$commentaire['grade']);
                    }else{
                        $grade = $commentaire['grade'];
                    }
                ?>
                    <div class="col-md-6" >
                        <span>Note : </span>
                        <?php
                        if(is_array($grade)){
                            for($i=0,$n=sizeof($grade);$i<$n;$i++)
                            {
                            }
                        }else{
                            $n = 5;
                            $emptyStar = $n-$grade ;
                            for($i=0;$i<$n;$i++)
                            { 
                                if($i >= ($n-$emptyStar))
                                { 
                                    ?>
                                    <span class="far fa-star"></span>
                                <?php
                                }else{
                                ?>
                                <span class="fas fa-star"></span>
                                <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-6" style="text-align: right;" >
                        <span>Publié le : <?=$dateSeulement;?> à <?=$heureSeulement;?> sur le livre <a href="pageProduit.php?idLivre=<?=$commentaire['idLivre'];?>"><strong><?=$commentaire['Titre'];?></strong></a></span>
                    </div>
                     <?php
                }else{
                    ?>
                    <div class="col-md-12" style="margin-left:auto" >
                        <p>Publié le : <?=$dateSeulement;?> à <?=$heureSeulement;?> sur le livre <a href="pageProduit.php?idLivre=<?=$commentaire['idLivre'];?>"><strong><?=$commentaire['Titre'];?></strong></a></p>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="col-md-12 form-control" style="border-radius: 20px solid black; margin-left:20%;">
                        <p style="word-wrap: break-word"><?=$commentaire["contenu"]?></p>
                    </div>
                </div>
        </div>
    </div>
    <?php
    }
    }else{
        ?>
        <div class="alert alert-danger container text-center" style="margin-top: 15%; width:30%">Vous n'avez aucun commentaire de publié actuellement.</div>
        <div style="margin-top: 16.5%;">
            <?php
        require_once 'pied.php';
        ?>
        </div>
        <?php
    }