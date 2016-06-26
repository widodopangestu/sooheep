
$(window)
  .on("scrollstart", function() {
    //when scroll page start
  })
  .on("scrollstop", function() {
      //when scroll stop change navbar and show hide icons
      oVal = ($(window).scrollTop() / 170);
      $(".blur").css("opacity", oVal);
      if( $(this).scrollTop() > 260 ) {
          $('.navbar-opts .fa').addClass('hidden');
          $('#navbar nav').addClass('navbar-white');
      } else {
          $('.navbar-opts .fa').removeClass('hidden');
          $('#navbar nav').removeClass('navbar-white');
      }  
  })


$(function(){

    var refreshScroll = function () { 
        // do stuff
   
    };
    /*compose post form*/
    var postActions   = $( '#list_PostActions' );
    var currentAction = $( '#list_PostActions li.active' );
    if ( currentAction.length === 0 ) {
        postActions.find( 'li:first' ).addClass( 'active' );
    }

    postActions.find( 'li' ).on( 'click', function( e ) {
        e.preventDefault();
        var self = $( this );
        if ( self === currentAction ) {return;}
        // else
        currentAction.removeClass( 'active' );
        self.addClass( 'active' );
        currentAction = self;
    });

  /*show image in modal when click*/
  $('.show-in-modal').click(function(e){
    $('#modal-show .img-content').html('<img class="img-responsive img-rounded" src="'+$(this).attr('src')+'" />');
    $('#modal-show').modal('show');
    e.preventDefault();
  });
});


