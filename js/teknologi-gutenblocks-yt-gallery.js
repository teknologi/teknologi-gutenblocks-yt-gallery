(function($){

    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    04/05/21
     * @since   0.0.1
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */
    var initializeBlock = function( $block ) {
        $('.dbt-yt-gallery .yt-videos').lightGallery({
          youtubePlayerParams: {
            modestbranding: 1,
            showinfo: 0,
            rel: 0,
            controls: 0
          },
          thumbnail: true,
          loadYoutubeThumbnail: true,
          youtubeThumbSize: 'default',
        });
    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
      $('.dbt-yt-gallery').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
      window.acf.addAction( 'render_block_preview/type=dbt-yt-gallery', initializeBlock );
    }

})(jQuery);