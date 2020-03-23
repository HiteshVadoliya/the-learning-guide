$(document).ready(function(){

  var container = $(".uic-wrapper");
  var nextBtn = $("nav .btn-next");
  var backBtn = $("nav .btn-back");
  var finishBtn = $("nav .btn-finish");

  updateNav();

  function updateNav(){
    var hasAnyRemovedCard = $(".toRight").length ? true : false,
        // isCardLast = $(".card-middle").length ? false : true;
        isCardLast = ( $(".myLastCard").length == 0 ) ? false : true;
        
    if(hasAnyRemovedCard) {
      backBtn.removeClass('back-btn-hide');

    } else {
      backBtn.addClass('back-btn-hide');
      $(".card-front").addClass('noBack');
    }

    if(isCardLast){
      nextBtn.hide();
      finishBtn.removeClass("hide");
    } else {
      nextBtn.show();
      finishBtn.addClass("hide");
    }
  }

  function showNextCard( i ){
    //Check if there is only one card left
    if($(".card-middle").length > 0){
      var currentCard = $(".card-front"),
        middleCard = $(".card-middle"),
        backCard = $(".card-back"),
        backCard1 = $(".card-back1"),
        backCard2 = $(".card-back2"),
        backCard3 = $(".card-back3"),
        outCard = $(".card-out").eq(0);

      //Remove the front card
      currentCard.removeClass('card-front').addClass('toRight');

      //change the card places
      if(i == 5) {
        middleCard.removeClass('card-middle').addClass('card-front myLastCard');
      }
      else {
        middleCard.removeClass('card-middle').addClass('card-front');
      }
      if(i >= 2 && i < 5 ){
        if(i == 2) {
          backCard1.removeClass('card-back1').addClass('card-middle');
        }
        if(i == 3) {
          backCard2.removeClass('card-back2').addClass('card-middle');
        }
        if(i == 4) {
          backCard3.removeClass('card-back3').addClass('card-middle');
        }
      }
      else {
        backCard.removeClass('card-back').addClass('card-middle');
      }

      outCard.removeClass('card-out').addClass('card-back');
      

      updateNav();
    }
  }

  function showPreviousCard(){
    var currentCard = $(".card-front"),
        middleCard = $(".card-middle"),
        backCard = $(".card-back"),
        backCard1 = $(".card-back1"),
        backCard2 = $(".card-back2"),
        backCard3 = $(".card-back3"),
        lastRemovedCard = $(".toRight").slice(-1);

    lastRemovedCard.removeClass('toRight').addClass('card-front');
    currentCard.removeClass('card-front').addClass('card-middle');

    if(i >=1 && i < 5) {
      if(i == 1) {
        middleCard.removeClass('card-middle').addClass('card-back1');
      }
      if(i == 2) {
        middleCard.removeClass('card-middle').addClass('card-back2');
      }
      if(i == 3) {
        middleCard.removeClass('card-middle').addClass('card-back3');
      }
      if(i == 4) {
        middleCard.removeClass('card-middle').addClass('card-out');
      }
    }
    else {
      middleCard.removeClass('card-middle').addClass('card-back');
    }
    backCard.removeClass('card-back').addClass('card-out');

    updateNav();
  }

  var i = 0;
  nextBtn.on('click', function(){
    var flag = false;
    let ele = $('.cards-wrapper .card:eq('+i+')').find('.cls');
    if(ele.length > 0) {
      let type = $(ele).attr('type');
      if(type == 'range') {
        if($(ele).val() != '' && $(ele).val() != 0) {
          flag = true;
          $(ele).next('span').text('');
        }
        else {
          $(ele).next('span').text('This Field is Required.');
        }
      }
      if(type == 'radio') {
        let name = $(ele).attr('name');
        let check = $('input[name="'+name+'"]:checked');
        if(check.length > 0) {
          flag = true;
          $(ele).parents('.yse-no-section').find('span.error').text('');
        }
        else {
          $(ele).parents('.yse-no-section').find('span.error').text('This Field is Required.');
        }
      }
    }
    
    if(flag) {
      i++;
      showNextCard(i);
    }
    else {
      return false;
    }

  });

  backBtn.on('click', function(){
    i--;
    showPreviousCard(i);
  })

});