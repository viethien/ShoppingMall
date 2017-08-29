$( document ).ready( function() {

     $( window ).scroll( function() {
       if ( $( document ).scrollTop() >= 800 ) {
         $( '#title' ).addClass( 'fixed' );
       }
       else {
         $( '#title' ).removeClass( 'fixed' );
       }
     });
   } );
