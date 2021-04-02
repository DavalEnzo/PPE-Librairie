<?php
require_once 'entete.php';

$livres = selectBibli();
?>
<div class="body">
  <div class="toutnoir">
      <div style="background-image:url('Books-banner.jpg');">
          <div style="background-color:rgba(0,0,0,0.5)">
              <div class="container text-center"
              data-aos="fade-down"
              data-aos-duration="3000"
              >
                <h1 class="display-4" style="font-size:50px; margin-left:5%; font-family:Brush Script MT; color:yellow;text-shadow: black 0.4em 0.1em 0.4em;">Des livres a n'importe quel moment où que vous soyez</h1>
              </div>
          </div>
      </div>
      <div class="container" style="max-width: 1280px"
                
      >
        <div class="p-1 mb-2 bg-info text-center"
                data-aos="fade-right"
                data-aos-duration="3000">
          <h2 class='fw-bold' style="text-decoration:underline; text-shadow: black 0.2em 0.1em 0.3em;">Les livres à la une</h2>
        </div>
        
          <section id="slick"
                data-aos="fade-down"
                data-aos-duration="3000"
                >
                <div class="container">
                            <div class="row">
                              
                                   <div class="col arrow_next"> 
                                      <span>
                                        <i class="fas fa-3x fa-angle-double-right"></i>
                                      </span>
                                      
                                    </div>
                                <div class="slick-content col">
                                    <?php
                                    foreach($livres as $livre){
                                      ?>
                                      <div class="slider_items">
                                          <img class="imgslide mx-1" src="<?=$livre["Photo"]?>" >
                                      </div>
                                      <?php
                                    }
                                    ?>
                                </div>
                                  <div class="arrow_prev col"> 
                                    <span >
                                    <i class="fas fa-3x fa-angle-double-left"></i>
                                    </span>
                                    
                                  </div>
                              </div>
                            
                </div>
          </section>

      <div
                data-aos="fade-left"
                data-aos-duration="3000">
        <h1 class="text-center my-3 stext"
        
              style="color:white;" 
        >Les Nouveautés :</h1>
      </div>
        <div class="card-group" style='margin:1rem;'
                data-aos="fade-down"
                data-aos-duration="3000" >
          <?php
          $newLivres = selectBiblinew();
          foreach($newLivres as $newLivre){  
            ?>
          <div  class="card mx-3 my-5 cardlivre"
               
                style="max-height:450px;max-width:17rem;min-width:17rem;min-height:450px;border:none;" >

                <img  class="card-img-top" style="max-height:340px;" src="<?=$newLivre["Photo"]?>">

                <div class="card-body" style="min-height:105px;" id="card" >
                    <h8 class="card-title"><?=$newLivre["Titre"]?></h8>
                    <?php
                    if($newLivre['Prix']== 0.00){
                        ?>
                        <p>Libre de droit</p>
                    <?php
                    }else{
                        ?>
                        
                        <p class="card-text"><?=$newLivre["Prix"]?> €</p>
                <?php 
                  }
                ?>
                </div>

              <div class="card-footer hide"  >
                <a href="pageProduit.php?idLivre=<?=$newLivre["idLivre"]?>"> <button  class="btn btn-success">Voir le produit</button></a> 
              </div>

          </div>
          <?php
          }
          ?>
        </div>  
    </div> 
</div>    
<?php
require_once 'pied.php';