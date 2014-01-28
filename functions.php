<?php
/**
 * @package    Josh Pollock
 * @version    0.1.0
 * @author     Josh Pollock <Josh@JoshPress.net
 * @copyright  Copyright (c) 2014, Josh Pollock
 * @link       http://JoshPress.net
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Include the shoegazer classes
 *
 * @since  0.1.0
 */
/**
 * Array of files with the classes we need,
 */
$files = array(
    'shoegazer_admin.php',
    'shoegazer.php'
);
/**
 * Filter which  classes to include
 *
 * @since 0.0.1
 */
$files = apply_filters( '_sf2_classes', $files );
foreach ($files as $file) {
    require_once( trailingslashit( 'inc' ) . $file );
}







