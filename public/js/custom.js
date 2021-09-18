/*_Open Sub Nav_*/
$( function(){
    $('.subnav > .click-subnav').click( function(event) {
        event.stopPropagation()
        
        $('.subnav > .click-subnav').removeClass('active-nav-element');
        
        $( this ).addClass('active-nav-element');
        
        $('.subnav').find('.block').hide();
        
        $(this).parent().find('.block').fadeIn();
        
    })
} );

$(function () {
    $( window ).on('load', function() {
        if ( $(this).width() < 1000 ) {
            $('#mainNav').hide();
            $('.fake').hide();
            $('.mainpage').css('width', '100%');
            $( '#showNav' ).show();
            $( '.hideMain' ).hide();
            $( '.showNav' ).hide();
            $( '#hideNav' ).hide();
        } else {
            $('#mainNav').show();
            $('.fake').show();
            $('.mainpage').css('width', '80%');
            $( '#showNav' ).hide();
            $( '.hideMain' ).hide();
            $( '#hideNav' ).hide();
        }
    } );

    $( window ).on('resize', function () {
        if ( $(this).width() < 1000 ) {
            $('#mainNav').hide();
            $('.fake').hide();
            $('.mainpage').css('width', '100%');
            $( '#showNav' ).show();
            $( '.hideMain' ).hide();
            $( '.showNav' ).hide();
            $( '#hideNav' ).hide();
        } else {
            $('#mainNav').show();
            $('.fake').show();
            $('.mainpage').css('width', '80%');
            $( '#showNav' ).hide();
            $( '.hideMain' ).hide();
            $( '#hideNav' ).hide();
        }
    } );
    
    $( '#showNav' ).click( function() {
        $('#mainNav').show();
        $( '.hideMain' ).show();
        $( '#hideNav' ).show();
    } );
    
    $( '#hideNav' ).click( function() {
        $( this ).hide();
        $('#mainNav').hide();
        $( '.hideMain' ).hide();
    } );
    
    $('.hideMain').click( function(){
        $(this).hide();
        $('#mainNav').hide();
        $( '#hideNav' ).hide();
    } );
    
}); 

/*_Filter Pharmacy_*/
$(function () {
    $( "#phone" ).keyup(function () {
        if($( this ).val().length > 0) {
            $('#city').prop('disabled', true);
            $('#gmaps').prop('disabled', true);
            $('#true').prop('disabled', true);
            $('#false').prop('disabled', true);
  
            var regex = new RegExp('^[0-9]+$');
            var phone = $( this ).val();
            if(phone.length == 10 && regex.test(phone)){
                $('#submit').prop('disabled', false);
                $('#submit').removeClass('bg-blue-200').addClass('bg-blue-400');
            } else {
                $('#submit').prop('disabled', true);
                $('#submit').removeClass('bg-blue-400').addClass('bg-blue-200');
            }
        } else {
            $('#city').prop('disabled', false);
            $('#gmaps').prop('disabled', false);
            $('#true').prop('disabled', false);
            $('#false').prop('disabled', false);
        }
    });
  
    $( "#city" ).change(function () {
        $('#city option:selected').each(function() {
            if( $(this).val() !== '') {
                $('#phone').prop( "disabled", true );
                $('#true').prop('disabled', true);
                $('#false').prop('disabled', true);
  
                $( '#gmaps' ).prop('disabled', false);
                $( '#submit' ).prop('disabled', false);
            } else{
                $('#phone').prop( "disabled", false );
                $('#true').prop('disabled', false);
                $('#false').prop('disabled', false);
  
                $( '#gmaps' ).prop('disabled', true);
                $( '#submit' ).prop('disabled', true);
            }
        });               
    })
  
    $( "#true" ).change(function () {
        if(this.checked) {
            $('#city').prop('disabled', true);
            $('#phone').prop('disabled', true);
            $('#false').prop('disabled', true);
            $( '#submit' ).prop('disabled', false);
        } else {
            $('#city').prop('disabled', false);
            $('#phone').prop('disabled', false);
            $('#false').prop('disabled', false);
            $( '#submit' ).prop('disabled', true);
        }
    });
  
    $( "#false" ).change(function () {
        if(this.checked) {
            $('#city').prop('disabled', true);
            $('#phone').prop('disabled', true);
            $('#true').prop('disabled', true);
            $( '#submit' ).prop('disabled', false);
        } else {
            $('#city').prop('disabled', false);
            $('#phone').prop('disabled', false);
            $('#true').prop('disabled', false);
            $( '#submit' ).prop('disabled', true);
        }
    });
  });

/*_Show Pharmacy Datas (Ajoute & Supprimer)_*/ 
$( function() {
    $('#show-listed').click( function(){
        $(this).hide();
        $('.inside-listed').css('height', '100%');
    } );
} );

/********************* */
$( function(){
    var pathname = $(location).attr('pathname'),
        regex = new RegExp('^/pharmacie-de-garde-[a-z]*[a-z]*$');

    if (!regex.test(pathname)) {
      $('#cities-menu-button').click( function() {
        
        $('#cities').stop().fadeToggle();
        
        if(!$(this).hasClass('active')) { 
            
            $(this).addClass('active'); 

            $('#index').removeClass('active'); 
        }
        else { 
            $(this).removeClass('active'); $('#index').addClass('active'); 
        }
      });

      $('body').click( function(event) {
        var target = $(event.target);
        if(!target.parents().is("#cities-menu-button") && !target.is("#cities-menu-button") && !target.is('#cities') && !target.parents().is('#cities')){
            $('#cities').stop().fadeOut();
            $("#cities-menu-button").removeClass('active');
            $('#index').addClass('active');
        }
      });

    } else {
      $("#cities-menu-button").addClass('active');
      
      $('#cities-menu-button').click(function(){ $('#cities').stop().fadeToggle(); });
      $('body').click(function(event){
        var target = $(event.target);
        if(!target.parents().is("#cities-menu-button") && !target.is("#cities-menu-button") && !target.is('#cities') && !target.parents().is('#cities')){
            $('#cities').stop().fadeOut();
        }
      });
    }

    $('#admin-button').click(function(){ $('#admin-popup').stop().fadeToggle(); });

    $('body').click(function(event){
      var target = $(event.target);
      if(!target.parents().is("#admin-button") && !target.parents().is("#admin-popup") ){
          $('#admin-popup').stop().fadeOut();
      }
    });

    $('#register').click(function(){ $('#loginPopup').hide(); $('#registerPopup').show(); });
    $('#login').click(function(){ $('#loginPopup').show(); $('#registerPopup').hide(); });

    $('.show').click(function(){  $(this).hide(); $(this).siblings().show();  });

});