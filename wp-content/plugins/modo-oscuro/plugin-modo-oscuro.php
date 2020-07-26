<?php
/**
 * Plugin Name: Modo Oscuro
 * Description:    Activa el modo oscuro en tu theme.
 * Version:          1.0
 * Author:           Rafael Garcia Garcia
 * Author URI:    https://github.com/ralph2g
 */

function estilos_plugin(){

    $estilos_url = plugin_dir_url(__FILE__);

    wp_enqueue_style( 'modo_oscuro', $estilos_url.'/assets/css/estilo.css', '', '1.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'estilos_plugin' );

?>