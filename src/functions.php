<?php

require_once( get_stylesheet_directory() . '/includes/studio-222-child-nav-menus-class.php');
require_once( get_stylesheet_directory() . '/includes/widgets/studio-222-child-widgets-class.php');
require_once( get_stylesheet_directory() . '/includes/acf/studio-222-child-acf-class.php');

/**
 * Child Theme Nav Menus
 */

 if ( class_exists( 'S222_Nav_Menus' ) ) {
   new S222_Nav_Menus();
 }

/**
 * Child Theme Widgets
 */

if ( class_exists( 'S222_Widgets' ) ) {
  new S222_Widgets();
}

/**
 * Child Theme ACF
 */

 if ( class_exists( 'S222_ACF' ) ) {
   new S222_ACF();
 }

 add_filter('excerpt_more', function() {
   return '...';
 });


/**
 * Staff plugin config
 */
 add_filter('torque_staff_exclude_metaboxes', function( $array ) {
   return array('tel', 'email');
 });


/**
* Torque map config
*/

add_filter( 'torque_map_api_key', function($k) {
  return 'AIzaSyARHV9NvPpNOXUAmjWJPhXcgWatWX32SNs';
});


/**
 * Admin settings
 */

 // remove menu items
 function torque_remove_menus(){

   //remove_menu_page( 'index.php' );                  //Dashboard
   //remove_menu_page( 'edit.php' );                   //Posts
   //remove_menu_page( 'upload.php' );                 //Media
   //remove_menu_page( 'edit.php?post_type=page' );    //Pages
   remove_menu_page( 'edit-comments.php' );          //Comments
   //remove_menu_page( 'themes.php' );                 //Appearance
   //remove_menu_page( 'plugins.php' );                //Plugins
   //remove_menu_page( 'users.php' );                  //Users
   //remove_menu_page( 'tools.php' );                  //Tools
   //remove_menu_page( 'options-general.php' );        //Settings

 }
 add_action( 'admin_menu', 'torque_remove_menus' );




/**
 * Enqueues
 */

// enqueue child styles after parent styles, both style.css and main.css
// so child styles always get priority
add_action( 'wp_enqueue_scripts', 'torque_enqueue_child_styles' );
function torque_enqueue_child_styles() {

    $parent_style = 'parent-styles';
    $parent_main_style = 'torque-theme-styles';

    // make sure parent styles enqueued first
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( $parent_main_style, get_template_directory_uri() . '/bundles/main.css' );

    // enqueue child style
    wp_enqueue_style( 'studio-222-child-styles',
        get_stylesheet_directory_uri() . '/bundles/main.css',
        array( $parent_style, $parent_main_style ),
        wp_get_theme()->get('Version')
    );
}

// enqueue child scripts after parent script
add_action( 'wp_enqueue_scripts', 'torque_enqueue_child_scripts');
function torque_enqueue_child_scripts() {

    wp_enqueue_script( 'studio-222-child-script',
        get_stylesheet_directory_uri() . '/bundles/bundle.js',
        array( 'torque-theme-scripts' ), // depends on parent script
        wp_get_theme()->get('Version'),
        true       // put it in the footer
    );
}

add_action('wp_head', 'tq_hook_gtm', 0);
function tq_hook_gtm() {
?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-32810338-2"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-32810338-2');
  </script>
<?php
}

?>
