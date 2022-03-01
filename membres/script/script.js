  var arrowNext = document.querySelectorAll(".arrow_next");
  console.log(arrowNext);
$(function (){
    $('.slick-content').slick({
        dots: true,
        centerMode: true,
        centerPadding: '14%',
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow:".arrow_prev",
        nextArrow:".arrow_next",
        adaptiveHeight: true,
        variableWidth: true,
        pauseOnFocus: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    infinite:true,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    nextArrow: '<i class="fas fa-3x fa-angle-double-right"></i>',
                    prevArrow: '<i class="fas fa-3x fa-angle-double-left"></i>',
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1920,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    prevArrow:".arrow_prev",
                    nextArrow:".arrow_next",
                }
            },
    
      ]
    });
});
$(window).on('load', function () {
    AOS.refresh();
  });
  $(function () {
    AOS.init();
  });

  $(document).ready(function(){
        $("#staticBackdrop").modal('show'); 
});


  //Mettre un si afin qu'il ne recharge que la page index et non toutes les pages


  $(window).resize(function(){
      $window.refresh();
  });
  
    $('#souvenir, #avertissement, #exclamation').on('click', function () {
        if($('#souvenir').is(':checked')) {
            $('#exclamation').show();
            $('#avertissement').show();
            $('#avertissement').html('Si vous cochez cette case, vous devrez vous déconnecter manuellement avec le bouton de déconnexion').css('color', '#FF6600').css('font-size', '12px');
        }else{
            $('#avertissement').hide();
            $('#exclamation').hide();
        }
    });


  $('#prixAjout ,#numerique').on('keyup', function () {
      if ($('#prixAjout').val() == 0) {
          $('#numerique').attr("disabled", false);
        }else{
            $('#numerique').attr("disabled", true);
    }
    });

    

    $('#enregistrerCoordonnees').on('click', function() {
        $('#coordonees').show();
        $('#noAdresse').text('');
        $('#nomPrenom').val( 'Nom et prénom: ' + $('#nomComplet').val() );
        $('#coordonneeValues').val('Adresse: ' + $('#adresse').val() + ', ' + $('#codePostal').val() + ', ' + $('#ville').val() + ', ' + $('#pays').val());
      });

    $('#enregistrerCb').on('click', function() {
        $('#insertionMoyenPaiement').text('Moyen de paiement enregistré')
      });

    $('#numeroCb').on('keyup', function () {

        if($('#numeroCb').val().indexOf('4',0) == 0){
            $('#numeroCb').css("background-image", "url(https://cdn4.iconfinder.com/data/icons/flat-brand-logo-2/512/visa-512.png)");

            $('#numeroCb').css("padding-left", "40px");

        }else if($('#numeroCb').val().indexOf('5',0) == 0){
            $('#numeroCb').css("background-image", "url(https://img2.freepng.fr/20180824/jbf/kisspng-mastercard-logo-credit-card-visa-brand-mastercard-logo-icon-paypal-icon-logo-png-and-v-5b8036c0e7dcf3.7313769415351292809497.jpg)");

            $('#numeroCb').css("padding-left", "40px");

        }else if($('#numeroCb').val().charAt(0) !== 4 && $('#numeroCb').val().charAt(0) !== 5 && $('#numeroCb').val().length > 0){

            $('#numeroCb').css("background-image", "url(https://static.thenounproject.com/png/1878932-200.png)");

            $('#numeroCb').css("padding-left", "40px");

        }else{
            $('#numeroCb').css("background-image", "");
            
            $('#numeroCb').css("padding", "6px 12px");
        }

        if (isNaN($('#numeroCb').val())) {
                $('#msg').html('Le code de carte de crédit ne doit contenir que des chiffres').css('color', 'red');
        }else{
            $('#msg').html('')
        }
    });

    $('#auteurEnregistré').click(function() {
        $("#nouvAuteur").toggle(this.checked);
        if($('#inputAuteur').is(':visible'))
        {
            $('#inputAuteur').attr("disabled", false);
        }else{
            $('#inputAuteur').attr("disabled", true);
        }
        $("#auteur").toggle(this.unchecked);
    });

    $('#editeurEnregistré').click(function() {
        $("#nouvEditeur").toggle(this.checked);
        if($('#inputEditeur').is(':visible'))
        {
            $('#inputEditeur').attr("disabled", false);
        }else{
            $('#inputEditeur').attr("disabled", true);
        }
        $("#editeur").toggle(this.unchecked);
    });

    $('#cvc').on('keyup', function () {
        if (isNaN($('#cvc').val())) {
                $('#msgCvc').html('Le CVC ne doit contenir que des chiffres').css('color', 'red');
        }else{
            $('#msgCvc').html('')
        }
    });

    $(window).scroll(function(e){ 
        var $el = $('#scroll'); 
        var isPositionFixed = ($el.css('position') == 'fixed');
        if ($(this).scrollTop() > 200 && !isPositionFixed){ 
          $el.css({'position': 'fixed', 'top': '0'}); 
        }
        if ($(this).scrollTop() < 200 && isPositionFixed){
          $el.css({'position': 'absolute', 'top': '18%'}); 
        } 
      });

//   function isNumerique(){
//   if(document.getElementById("prixAjout").value == 0){
//       console.log(document.getElementById("prixAjout").value);
//       document.getElementById("numerique").style.display = "visible";
      
//     }else if(document.getElementById("prixAjout").value > 0.00){
//         console.log(document.getElementById("prixAjout").value);
//         document.getElementById("numerique").style.display = "none"
//     }

// }
// console.log(isNumerique());

