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
$(function (){
$('.coucou').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
  });
});