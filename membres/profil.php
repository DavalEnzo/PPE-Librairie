
<?php
    if(isset($_GET['success']) && !empty($_GET['success'])){
        require_once 'entete.php';
        if($_GET['success'] == 1){
            ?>
            <div class="alert alert-success">Les modifications ont bien été enregistrées !
        </div>
            <?php        
        }else if($_GET['success'] == 2 ){
            if($_GET['erreur'] == 1){
                ?>        
                <div class="alert alert-danger">La modification n'a pas pu être effectuée.<br>
                Erreur: l'image n'a pas pu être enregistrée</div>
                <?php
            }else if($_GET['erreur'] == 2){
                ?>        
                <div class="alert alert-danger">La modification n'a pas pu être effectuée.<br>
                Erreur: Le fichier n'a pas le bon type, le site accepte seulement les jpg et les png</div>
                <?php
            }else if($_GET['erreur'] == 3){
                ?>        
                <div class="alert alert-danger">La modification n'a pas pu être effectuée.<br>
                Erreur: Le fichier doit peser moins de 5Mo</div>
                <?php
            }else if($_GET['erreur'] == 4){
                ?>        
                <div class="alert alert-danger">La modification n'a pas pu être effectuée.<br>
                Erreur: Le fichier n'est pas une image</div>
                <?php
            }else if($_GET['erreur'] == 5){
                ?>        
                <div class="alert alert-danger">La modification n'a pas pu être effectuée.<br>
                Erreur: Le type de fichier n'a pas été reconnu.</div>
                <?php
            }else if($_GET['erreur'] == 6){
                ?>        
                <div class="alert alert-danger">L'email entré n'est pas valide, veuillez vérifier qu'il contient un '@' et un domaine (.com, .fr...).</div>
                <?php
            }else if($_GET['e']){
                ?>        
                <div class="alert alert-danger">La modification n'a pas été effectuée, veuillez contacter l'administrateur et lui communiquer cetter erreur:<br>
                <b><?=$_GET['e'];?></b>
                </div>
                <?php
            }else if($_GET['success'] == 3 ){
            ?>
            <div class="alert alert-danger"><?=$_GET['erreur'];?><br>
            </div>
            <?php
            }

        }
        if(isset($_GET['erreurs']) && $_GET['success'] == 4){
            ?>
            <div class="alert alert-danger"><?=$_GET['erreurs'];?><br>
            </div>
            <?php
        }
    }
?>

<?php 
require_once 'entete.php';
if(isset($_SESSION['idUtilisateur']) && !empty($_SESSION['idUtilisateur'])){
?>
<div class="container my-5">
    <div class="rounded" style="background-color: white; padding: 1% 2% 2% 2%;box-shadow: 1px 1px 5px black;">
        <h1 class="text-center my-3">Profil de <?=$_SESSION['nom'];?></h1>
        <div>
            <div style="max-width:220px;display:inline-block;">
                <div style="max-height:240px; width:auto">
                    <img src="<?=$_SESSION['photoProfile'];?>" style="width: 100%; display:inline-block;" alt="">
                </div>
                    <a href="../membres/mesCommentaires.php" type="button" class="btn btn-primary" style="max-height: 50px; display:inline-block; margin-left:2%; margin-bottom:5%; margin-top:15%; width:100%">Mes commentaires</a>

                    <a href="../membres/modificationMdp.php" type="button" class="btn btn-primary" style="max-height: 50px; margin-top:2%; display:inline-block; margin-left:2%; margin-bottom:5%; width:100%">Modifier le mot de passe</a>

                    <a href="../membres/suppressionProfile.php" type="button" class="btn btn-danger" style="max-height: 50px; margin-top:2%; display:inline-block; margin-left:2%; margin-bottom:5%;width:100%">Supprimer le compte</a>
            </div>
            <div style="display: inline-block; height: 400.27px; width:0%; margin-left:5%; border: 1px solid black;"></div>
            
            <form style="display: inline-block; margin-left:10%; width: 50%;" method = "post" enctype="multipart/form-data" action="../traitement/modifUtilisateur.php">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class ="form-control" style="border-radius: 20px;" name="nom" id="nom" value="<?=$_SESSION['nomSimple'];?>"/>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class ="form-control" style="border-radius: 20px;" name="prenom" id="prenom" value="<?=$_SESSION['prenom'];?>"/>
                </div>
                <div class="form-group">
                    <label for="email">Adresse Mail</label>
                    <input type="email" class ="form-control" style="border-radius: 20px;" name="email" id="email" value="<?=$_SESSION['email'];?>"/>
                </div>
                <div class="form-group mb-3 my-3">
                    <label for="photoProfile">Photo de profil</label>
                    <input type="file" class="form-control" id="inputGroupFile01" name="photoProfile">
                </div>
                <div class="form-group text-center my-2">
                    <button type="submit" class="btn-balayage" style="border-radius: 20px;margin-top:2%;" name="envoi" value="1">Modifier le profil</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'pied.php';?>

<?php 

}else{
    ?>
    <div style="margin-top:12%; margin-left:18%; width:60%; padding: 2%;" class="alert alert-danger text-center">Vous ne pouvez pas accéder à votre profile sans être connecté, veuillez <strong><a href="index.php">Retourner à l'accueil.</a></strong></div>;
<?php
}
