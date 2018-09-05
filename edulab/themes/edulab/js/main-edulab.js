//Popup Login
$(function(){
    $('#modalButton').click(function(){
        $('#modal').modal('show')
        .find('#modalContent')
        .load($(this).attr('value'));
    });
});

//Popup Info Tryout
$(function(){
    $('#modalButtonTO').click(function(){
        $('#modalTO').modal('show')
        .css('margin', '100px auto 100px auto')
        .find('#modalContent2')
        .load($(this).attr('value'));
    });
});

//Popup Start Tryout
$(function(){
    $('#modalButtonStart').click(function(){
        $('#modalStart').modal('show')
        .css('margin', '100px auto 100px auto')
        .find('#modalContent2')
        .load($(this).attr('value'));
    });
});

//paralax jumbotron

var jumboHeight = $('.jumbotron').outerHeight();
function parallax(){
    var scrolled = $(window).scrollTop();
    $('.bg').css('height', (jumboHeight-scrolled) + 'px');
}

$(window).scroll(function(e){
    parallax();
});