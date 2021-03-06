<?php include_once 'entete.php'?>

<?php

    $uti = new Utilisateur($_SESSION['idUtilisateur'], false);
    $uti->initComUtilisateur($_SESSION['idUtilisateur']);
    $commentaires = $uti->getCommentaire();

    if(isset($commentaires) && !empty($commentaires)){
    
    foreach($commentaires as $commentaire){
        $date = $commentaire->getDateHeure();
        $dateFormatee = date('d-m-Y H:i:s', strtotime($date));

        $dateSeulement = substr($dateFormatee, 0, -9);
        $heureSeulement = substr($dateFormatee, -8);
        ?>

    <div class="container roundedBorders my-3" style="width: auto;">
    <?php
        if($commentaire->getVerif() == 0){
            ?>
            <span><i class="fas fa-exclamation-triangle" style="color: red;"></i></span>
            <p class="text-muted" style="display: inline-block;"> Ce commentaire est en cours d'approbation</p>
            <?php
        }
    ?>
        <div class="row">
                <div class="col-md-3 text-center">
                        <h4><?=$uti->getNom()." ".$uti->getPrenom()?></h4>
                        <img style="width: 60%;" src="<?=$_SESSION['photoProfile'];?>">
                </div>
                <div class="col-md-1 bSn"></div>
                <div class="col-md-8 row" style="width:70%">
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
                        $grade = explode(",",$commentaire->getGrade());
                    }else{
                        $grade = $commentaire->getGrade();
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
                    <div class="col-md-6" style="text-align: right; width:auto;" >
                        <span>Publi?? le : <?=$dateSeulement;?> ?? <?=$heureSeulement;?> sur le livre <a href="pageProduit.php?idLivre=<?=$commentaire->getLivre()->getIdLivre();?>"><strong><?=$commentaire->getLivre()->getTitre();?></strong></a></span>
                    </div>
                     <?php
                }else{
                    ?>
                    <div class="col-md-12" style="margin-left:auto" >
                        <p>Publi?? le : <?=$dateSeulement;?> ?? <?=$heureSeulement;?> sur le livre <a href="pageProduit.php?idLivre=<?=$commentaire->getLivre()->getIdLivre();?>"><strong><?=$commentaire->getLivre()->getTitre();?></strong></a></p>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="col-md-12 form-control" style="border-radius: 20px solid black; margin-left:5%">
                        <p style="word-wrap: break-word"><?=$commentaire->getContenu()?></p>
                    </div>
                </div>
        </div>
    </div>
    <?php
    }
    }else{
        ?>
        <div class="alert alert-danger container text-center" style="margin-top: 15%; width:30%">Vous n'avez aucun commentaire de publi?? actuellement.</div>
            <?php
        require_once 'pied.php';
    }