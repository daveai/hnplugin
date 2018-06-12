<?php
/*
Plugin Name: Hello World
Description: Create hello world message
Version: 1.0
Author: Author's name
Author URI: http://authorsite.com/
Plugin URI: http://authorsite.com/msp-helloworld
*/
define('MSP_HELLOWORLD_DIR', plugin_dir_path(__FILE__));
define('MSP_HELLOWORLD_URL', plugin_dir_url(__FILE__));
register_activation_hook(__FILE__, 'wpa3537_flush_rules');
function wpa3537_flush_rules()
{
    add_rewrite_rule('sample-page/([^/]+)', 'index.php?pagename=sample-page', 'top');
    flush_rewrite_rules(false);
}

add_filter('query_vars', 'wpa3537_query_vars');
function wpa3537_query_vars($query_vars)
{
    $query_vars[] = 'routeinfo';
    return $query_vars;
}
function myplugin_rewrite_tag_rule() {	
	add_rewrite_rule( '^sample-page/([^/]*)/?', 'sample-page?city=$matches[1]','top' );
}
add_action('init', 'myplugin_rewrite_tag_rule', 10, 0);
function msp_helloworld_load(){
    ob_start();
    wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'app/runtime.js' );
    wp_enqueue_script( 'my_custom_script1', plugin_dir_url( __FILE__ ) . 'app/polyfills.js' );
    wp_enqueue_script( 'my_custom_script2', plugin_dir_url( __FILE__ ) . 'app/styles.js' );
    wp_enqueue_script( 'my_custom_script3', plugin_dir_url( __FILE__ ) . 'app/vendor.js' );
    wp_enqueue_script( 'my_custom_script4', plugin_dir_url( __FILE__ ) . 'app/main.js' );    
    //echo '<base href="' . $_SERVER[ 'REQUEST_URL' ] . '">';    
    echo '<base href="http://localhost/hn/sample-page/">';    
    echo '<app-root></app-root>';
    echo ob_get_clean();
     
}
add_shortcode( 'helloworld', 'msp_helloworld_load' );
