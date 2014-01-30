<?php
    /**
     *
     * Modify customizer to fit our needs.
     *
     * @package    Josh Pollock
     * @version    0.1.0
     * @author     Josh Pollock <Josh@JoshPress.net
     * @copyright  Copyright (c) 2014, Josh Pollock
     * @link       http://JoshPress.net
     * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
     */

class shoegazer_admin {
    function __construct() {
        add_action( 'customize_register', array( $this, 'skin' ) );
        /**Add the customizer script**/
        add_action( 'customize_preview_init', array( $this, 'preview' ) );
    }
    function skin() {
        global $wp_customize;

        //remove colors section
        $wp_customize->remove_section( 'colors');

        //add skin section
        $wp_customize->add_section( 'skin', array(
            'title'          => __( 'Skin', 'shoegazer' ),
            'priority'       => 10,
        ) );

        //add skin setting
        $wp_customize->add_setting( 'shoegazer_skin', array(
            'default'        => 'loveless',
            'type'           => 'theme_mod',
            'capability'     => 'edit_theme_options',
        ) );

        //add skin drop-down
        $wp_customize->add_control(
            'shoegazer_skin', array(
                'label'   => 'Skin',
                'section' => 'skin',
                'type'    => 'select',
                'choices'    => array(
                    'mbv'               => 'MBV',
                    'loveless'          => 'Loveless',
                    'isntAnything'      => "Isn't Anything",
                    'tremolo'           => 'Tremolo',
                    'glider'            => 'Glider',
                    'ectasyWine'        => 'Ectasy and Wine',
                    'geek'              => 'Geek',

                ),
            )
        );
    }

    /**
     * Add the script for updating in customizer
     *
     */
    function preview() {
        wp_enqueue_script( 'shoegazer-customize', trailingslashit( CHILD_THEME_URI ). 'js/shoegazer-preview.js', array( 'jquery' ), false, true );
        $shoegazer = new shoegazer();
        $skin = $shoegazer->skin();
        $colors = $shoegazer->colors();
        $shoegazer = array(
            'skin'      => $skin,
            'colors'    => $colors
        );
        wp_localize_script( 'shoegazer-customize', 'sgvar', $shoegazer );
    }

}
new shoegazer_admin();