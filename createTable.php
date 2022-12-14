<?php

/* Plugin Name: wpplugin-newTable
Plugin URI: http://wpplugin.es
Description: Este plugin sustituye 5 palabras malsonantes que aparezcan en nuestro wordpress por otras que resulten más civilizadas
Version: 5.0.1
Requires at least: 5.0
Tested up to: 4.3
Author: Niko Bellic
Author URI: http://niko-bellic.com
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Update URI: https://example.com/my-plugin/
Text Domain: newTable-plugin
Domain path: /languages/
*/


function myplugin_update_database(){

    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $palabras_biensonantes = $wpdb->prefix . 'change_words';

    $sqlCreate = "CREATE TABLE $palabras_biensonantes (
              id INT(9) NOT NULL,
              palabra VARCHAR(20) NOT NULL,
              PRIMARY KEY  (id)
            ) $charset_collate;";

    $sqlInsert = "INSERT INTO $palabras_biensonantes (id, palabra) VALUES
            (1, 'fruta'),
            (2, 'gilipuertas'),
            (3, 'caca'),
            (4, 'cabrito'),
            (5, 'jorobate')";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sqlCreate);
    dbDelta($sqlInsert);

    /*$palabrasMalsonantes = array("puta", "gilipollas", "mierda", "cabron", "jodete");
    $palabrasNuevas = array();


    for($i=1; $i<6; $i++){
        $resultado = $wpdb->get_var("SELECT palabra FROM $palabras_biensonantes WHERE id = "+$i);
        $palabrasNuevas[] = $resultado;
    }

    return str_replace($palabrasMalsonantes, $palabrasNuevas, $content);*/

}

register_activation_hook( __FILE__, 'myplugin_update_database' );



?>