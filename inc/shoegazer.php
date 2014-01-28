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

    function colors() {
        if ( $this->skin() == 'loveless' ) {
            $colors = array(
                'primary'       => 'F14BA6',
                'header_text'   => '59302E',
                'background'    => 'A53852',
                'text'          => '2F2426',
                'accent'        => 'F059AD',
            );
        }
        return $colors;
    }

    function inline() {
        $colors = $this->colors();
        $style = ".widget-title { background-color: #{$colors[ 'primary' ]} }";
        //do the background color with this, for now. @todo this right.
        $style .= "body { background-color: #{$colors[ 'background' ]} }";
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
                'default-color' => $colors[ 'background' ],
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
        return $hex ? $hex : $primary = $colors['primary'];
    }

}

new shoegazer();