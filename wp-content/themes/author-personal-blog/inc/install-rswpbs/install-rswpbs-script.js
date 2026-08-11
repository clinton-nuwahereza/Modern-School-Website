( function( $ ){
    $( document ).ready( function(){
      $( '.author-personal-blog-rswpbs-install' ).on( 'click', function( e ) {
          e.preventDefault();
          $( this ).html( 'Processing.. Please wait' ).addClass( 'updating-message' );
          $.post( author_personal_blog_rswpbs_ajax_object.ajaxUrl, { 'action' : 'install_rswpbs_only' }, function( response ){
              location.href = 'edit.php?post_type=book&page=import-books-from-json#rswpbs-nav-wrapper';
          } );
      } );
    } );
}( jQuery ) )