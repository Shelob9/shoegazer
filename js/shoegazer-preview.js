/**Yes, I kow I should be using wp.customize, and this is hacky, but this works and is way easier.**/
( function( $ ){
    //get page_bg color
    var newBG = '#' + sgvar.colors.page_bg;
    var hdrTXT = '#' + sgvar.colors.header_text;
    var primary = '#' + sgvar.colors.primary;
    $( 'body' ).css({
        backgroundColor: newBG,
        borderTopColor: primary,
    });
    $( 'body.custom-header #site-title a').css( 'color', hdrTXT );
    $( '.widget-title > .wrap').css( 'background-color', primary );
} )( jQuery );