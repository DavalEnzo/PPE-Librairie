var cards = document.querySelectorAll('.cardlivre');
console.log(cards);
cards.forEach(function(card){
    card.addEventListener('mouseover',function(){
        card.querySelector('.hide').style.opacity = '1'
    });
    card.addEventListener("mouseout",function(){
        card.querySelector('.hide').style.opacity = '0'
    });
});
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

  $('#mdp, #confirmMdp').on('keyup', function () {
      if ($('#mdp').val() != $('#confirmMdp').val() && $('#confirmMdp').val().length > 0) {
          $('#message').html('Les mots de passe ne sont pas identiques').css('color', 'red');
          $('#envoi').attr("disabled", true);
        }else{
            $('#envoi').attr("disabled", false);
            $('#message').html("").css('color', 'red');

    }
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

    $('#numeroCb').on('keyup', function () {
        if (isNaN($('#numeroCb').val())) {
                $('#msg').html('Le code de carte de crédit ne doit contenir que des chiffres').css('color', 'red');
        }else{
            $('#msg').html('')
        }
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

