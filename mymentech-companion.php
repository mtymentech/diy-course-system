<?php
/*
Plugin Name:  DIY Course System
Plugin URI:   https://www.mymentech.com
Description:  Basic WordPress Plugin to enhance custom functionality by MymenTech Team.
Version:      1.2
Author:       MymenTech Team
Author URI:   https://www.mymentech.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  mt_companion
*/


function mt_flush_rewrite_rules(){
    flush_rewrite_rules();
}
register_activation_hook( __FILE__,'mt_flush_rewrite_rules');

include_once(plugin_dir_path(__FILE__).'inc/post-types.php');
include_once(plugin_dir_path(__FILE__).'codestar-framework/cs-framework.php');
include_once(plugin_dir_path(__FILE__).'inc/cs-metaboxes.php');

define( 'CS_ACTIVE_FRAMEWORK',   false  ); // default true
define( 'CS_ACTIVE_METABOX',     true ); // default true
define( 'CS_ACTIVE_TAXONOMY',    false ); // default true
define( 'CS_ACTIVE_SHORTCODE',   false ); // default true
define( 'CS_ACTIVE_CUSTOMIZE',   false ); // default true

define( 'CS_ACTIVE_LIGHT_THEME',  true  ); // default false


/**
 * Initializing CodeStar FrameWork
 */

function mt_course_metabox(){
    CSFramework_Metabox::instance(array());
}

add_action('init','mt_course_metabox');


/**
 * @return array of all CooCommerce Products
 * @key = Product ID
 * @value = Product Title
 */

function mt_wc_products(){
    $products = wc_get_products(
            array('orderby' => 'ID',
                'order' => 'DESC',
                'return' => 'ids',
                )
    );
    $all_products = array();
    foreach ($products as $id){
        $product_name = wc_get_product($id)->get_name();
        $all_products[$id] = $product_name;
    }

    return $all_products;
}



/**
 * This function is to verify if logged in user has purchased
 * the course or not.
 * @param $id= WooCommerce Product ID
 * @return bool
 */

function is_purchased_course($purchased, $id) {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        if(wc_customer_bought_product( $current_user->user_email, $current_user->ID, $id) || current_user_can('edit_others_pages')){
            $purchased = 'purchased';
        }

    }
    return $purchased;
}

add_filter('current_user_purchased','is_purchased_course',10,2);




function mt_woocommerce_account_menu_items($menu_links){
    //Setting position of the menu item. Default is 2nd position.
    $position = apply_filters('mt_my_courses_menu_position',2);
    $position--;

    return array_slice( $menu_links, 0, $position, true )
        + array( 'my-courses' => __('My Courses','woocommerce') )
        + array_slice( $menu_links, 2, NULL, true );
}

add_filter('woocommerce_account_menu_items','mt_woocommerce_account_menu_items');




//Adding My courses Endpoint for WooCommerce My-Account page
add_action( 'init', 'mt_my_course_add_endpoint' );
function mt_my_course_add_endpoint(){
    add_rewrite_endpoint( 'my-courses', EP_ROOT | EP_PAGES );
}

add_action( 'woocommerce_account_my-courses_endpoint', 'mt_my_courses_content' );

function mt_my_courses_content() {
    $course_args = array(
        'post_type'=>'course',
        'post_status'=>'published'
    );
    $course = new WP_Query($course_args);


    printf('<div class="woocommerce-Message woocommerce-Message--success woocommerce-info">%s</div>',
        __("The Courses you've enrolled in:","mt_companion"));
    printf('<ul class="products columns-3 courses" data-product-style="classic">');
    while($course->have_posts()):$course->the_post();
        $wc_product = get_post_meta(get_the_ID(),'course-meta-info',true);
        $wc_product = $wc_product['wc_product'];
        $verify_purchase = apply_filters('current_user_purchased','not_purchased',$wc_product);


        if($verify_purchase = "purchased"){
            include (plugin_dir_path(__FILE__).'inc/my-courses.php');
        }

    endwhile;
        printf('</ul>');
}





function _ap($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}