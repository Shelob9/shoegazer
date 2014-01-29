<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 1/28/14
 * Time: 12:47 AM
 */

class shoegazer {
    function __construct() {
        /* Add the child theme setup function to the 'after_setup_theme' hook. */
        add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
        /* Add a custom default color for the "primary" color option. */
        add_filter( 'theme_mod_color_primary', array( $this, 'color_primary' ) );
        /** Add additional skin specific CSS as inline styles */
        add_action( 'wp_enqueue_scripts', array( $this, 'inline' ) );
        /**Update Colors Fix **/
        add_action( 'update_option_theme_mods_' . get_stylesheet(), array( $this, 'update_mods' ) );
        /**Output settings in head for testing purposes**/
        if ( defined( 'SHOEGAZER_DEBUG' ) ) {
            if ( SHOEGAZER_DEBUG == true ) {
                add_action( 'wp_head', array( $this, 'test_mods'  ) );
            }
        }
    }

    /**
     * Get the current skin
     *
     * @since 0.1.0
     * @return string $skin;
     */

    function skin() {
        $skin = get_theme_mod( 'shoegazer_skin' );
        /**
         * Override which skin is set
         *
         * @since 0.1.0
         *
         * @param string $skin Which skin to use. Valid values: mbv|loveless|isntAnything|tremolo|glider
         *
         */
        $skin = apply_filters( 'shoegazer_skin', $skin );
        return $skin;
    }

    /**
     * The colors to be used, based on skin
     *
     * @return array $colors
     */
    function colors() {
        if ( $this->skin() == 'mbv' ) {
            $colors = array(
                'primary'       => '2B2F6E',
                'page_bg'       => '314294',
                'main_bg'       => 'fff',
                'alt_bg'        => '18163A',
                'text'          => '314294',
                'accent'        => '644D99',
                'header_text'   => '314294',
            );
        }
        elseif ( $this->skin() == 'loveless' ) {
            $colors = array(
                'primary'       => 'F14BA6',
                'page_bg'       => 'A53852',
                'main_bg'       => 'fff',
                'alt_bg'        => '59302E',
                'text'          => '2F2426',
                'accent'        => 'F059AD',
                'header_text'   => '59302E',

            );
        }
        elseif ( $this->skin() == 'isntAnything' ) {
            $colors = array(
                'primary'       => '9F605A',
                'page_bg'       => 'EFD0B6',
                'main_bg'       => 'FCF6E7',
                'alt_bg'        => 'B09692',
                'text'          => '5F3F3D',
                'accent'        => '9F605A',
                'header_text'   => '9F605A',
            );
        }
        elseif ( $this->skin() == 'tremolo' ) {
            $colors = array(
                'primary'       => 'A13051',
                'page_bg'       => 'C6304C',
                'main_bg'       => 'CF515B',
                'alt_bg'        => '664431',
                'text'          => '6F1521',
                'accent'        => 'A13051',
                'header_text'   => '664431',
            );
        }
        elseif ( $this->skin() == 'glider' ) {
            $colors = array(
                'primary'       => '604577',
                'page_bg'       => 'B26D8D',
                'main_bg'       => 'EEF1E4',
                'alt_bg'        => 'BBB0A8',
                'text'          => '511E71',
                'accent'        => 'C73B71',
                'header_text'   => '806F83',
            );
        }
        else {
            $colors = array(
                'primary'       => '',
                'page_bg'       => '',
                'main_bg'       => '',
                'alt_bg'        => '',
                'text'          => '',
                'accent'        => '',
                'header_text'   => '',
            );

        }
        return $colors;
    }

    /**
     * Output inline styles for skin color scheme
     *
     * @since 0.1.0
     *
     * @uses wp_add_inline_style()
     * @uses shoegazer::colors()
     */
    function inline() {
        $colors = $this->colors();
        //widget-title
        $style = ".widget-title { background-color: #{$colors[ 'primary' ]} }";
        //main text color
        $style .= "p, li {color: #{$colors[ 'text' ]};}";
        //main bg color
        $style .= "#sidebar-subsidiary, #main, #header { background-color: #{$colors[ 'main_bg' ]} }"; ;
        //site title color
        $style .= "h1.site-title a { color: #{$colors[ 'header_text' ]} }";
        //footer, header bg
        $style .= "#menu-primary, #footer { background-color: #{$colors[ 'alt_bg' ]}; border-bottom: 1px solid #{$colors[ 'accent']} }";
        //sub menu
        $style .= "#menu-primary li li a, #menu-secondary li li a { background-color: #{$colors[ 'alt_bg' ]}; border-color: #{$colors[ 'accent']} }";
        //header and footer menu link colors
        $style .= "
            #menu-primary li.current-menu-item>a, #menu-primary li a:hover, #menu-social li.current-menu-item>a,  #menu-social li a:hover, #footer a:hover {
                color: #{$colors[ 'accent' ]};
            }
            #menu-primary li a, #menu-social li a, #footer a {
                color: #{$colors[ 'main_bg' ]};
            }
        ";
        //do the background color with this, for now. @todo this right.
        $style .= "body { background-color: #{$colors[ 'page_bg' ]} }";
        //add these styles inline
        wp_add_inline_style( 'style', $style );
    }

    /**
     * Function update theme mods for primary color, page bg color and header text color
     *
     * @TODO Figure out how much of this is really needed. Hopefully none of it.
     * @since 0.1.0
     */
    function update_mods() {
        $colors = $this->colors();
        set_theme_mod( 'background_color', $colors[ 'page_bg' ] );
        set_theme_mod( 'header_textcolor', $colors[ 'header_text' ] );
        set_theme_mod( 'color_primary', $color['primary'] );
    }

    /**
     * Utility function to output some theme mods and $this->colors() to head if SHOEGAZER_DEBUG == true
     *
     * @since 0.1.0
     */
    function test_mods() {
        echo 'bg: '.get_theme_mod( 'background_color' );
        echo 'hdr_text: '.get_theme_mod( 'header_textcolor' );
        echo 'primary: '.get_theme_mod( 'color_primary' );
        echo '<br />';
        print_r( $this->colors() );
    }

    /**
     * Setup function.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    function theme_setup() {
        /**
         * Put skin colors into var $colors
         */
        $colors = $this->colors();
        /*
         * Add a custom background to overwrite the defaults.  Remove this section if you want to use
         * the parent theme defaults instead.
         *
         * @link http://codex.wordpress.org/Custom_Backgrounds
         */
        add_theme_support(
            'custom-background',
            array(
                'default-color' => $colors[ 'page_bg' ],
                'default-image' => '',
            )
        );

        /*
         * Add a custom header to overwrite the defaults.  Remove this section if you want to use the
         * the parent theme defaults instead.
         *
         * @link http://codex.wordpress.org/Custom_Headers
         */
        add_theme_support(
            'custom-header',
            array(
                'default-text-color' => $colors[ 'header_text' ],
                'default-image'      => '',
                'random-default'     => false,
            )
        );
    }


    /**
     * Add a default custom color for the theme's "primary" color option.  Users can overwrite this from the
     * theme customizer, so we want to make sure to check that there's no value before returning our custom
     * color.  If you want to use the parent theme's default, remove this section of the code and the
     * `add_filter()` call from earlier.  Otherwise, just plug in the 6-digit hex code for the color you'd like
     * to use (the below is the parent theme default).
     *
     * @since  0.1.0
     * @access public
     * @param  string  $hex
     * @return string
     */
    function color_primary( $hex ) {
        $colors = $this->colors();
        return $hex ? $hex : $colors[ 'primary' ];
    }

}

new shoegazer();