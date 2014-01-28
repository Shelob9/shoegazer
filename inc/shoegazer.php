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
                'primary'       => '',
                'page_bg'       => '',
                'main_bg'       => '',
                'alt_bg'        => '',
                'text'          => '',
                'accent'        => '',
                'header_text'   => '',
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
                'accent'        => 'D8AD9F',
                'header_text'   => '9F605A',
            );
        }
        elseif ( $this->skin() == 'tremolo' ) {
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
        elseif ( $this->skin() == 'glider' ) {
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
     * @todo menu pop-out bg colors
     *
     * @uses wp_add_inline_style()
     * @uses shoegazer::colors()
     */
    function inline() {
        $colors = $this->colors();
        //widget-title
        $style = ".widget-title { background-color: #{$colors[ 'primary' ]} }";
        //main bg color
        $style .= "#sidebar-subsidiary, #main, #header { background-color: #{$colors[ 'main_bg' ]} }"; ;
        //site title color
        $style .= "h1.site-title a { color: #{$colors[ 'header_text' ]} }";
        //footer, header bg
        $style .= "#menu-primary, #footer { background-color: #{$colors[ 'alt_bg' ]}; border-bottom: 1px solid #{$colors[ 'accent']} }";
        //do the background color with this, for now. @todo this right.
        $style .= "body { background-color: #{$colors[ 'page_bg' ]} }";
        wp_add_inline_style( 'style', $style );

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