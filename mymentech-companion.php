<?php
/*
Plugin Name:  DIY Course System
Plugin URI:   https://www.mymentech.com
Description:  Basic WordPress Plugin to enhance custom functionality by MymenTech Team.
Version:      1.1
Author:       MymenTech Team
Author URI:   https://www.mymentech.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  mt_companion

*/

include_once(plugin_dir_path(__FILE__).'inc/post-types.php');
include_once(plugin_dir_path(__FILE__).'codestar-framework/cs-framework.php');

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


function mt_companion_cs_framework_options( $options ) {
    /**
     * Course MetaBox Information
     */
    $options[] = array(
        'id'        => 'course-meta-info',
        'title'     => __( 'Course Settings', 'mt_companion' ),
        'post_type' => 'course',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'course-chapters',
                'title'  => __( 'Course Information', 'mt_companion' ),
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'             => 'wc_product',
                        'type'           => 'select',
                        'title'          => 'Select WooCommerce Product',
                        'options'        => 'posts',
                        'query_args'     => array(
                            'post_type'    => 'product',
                        ),
                        'default_option' => 'Select a Product',
                    ),

                    array(
                        'id'              => 'chapters',
                        'type'            => 'group',
                        'title'           => __('Chapters','mt_companion'),
                        'button_title'    => __('New chapter','mt_companion'),
                        'accordion_title' => __('Add New Chapter','mt_companion'),
                        'fields'          => array(
                            array(
                                'id'             => 'course-content',
                                'type'           => 'select',
                                'title'          => 'Selected Chapter',
                                'options'        => 'posts',
                                'query_args'     => array(
                                    'post_type'    => 'course-contents',
                                ),
                                'default_option' => 'Select a Chapter',
                            ),
                        ),
                    ),

                )
            ),
        )
    );




    /**
     * Chapter MetaBox Information
     */

    $options[]      = array(
        'id'            => 'chapter-data',
        'title'         => 'Contents of The Chapter',
        'post_type'     => 'chapter', // or post or CPT or array( 'page', 'post' )
        'context'       => 'normal',
        'priority'      => 'default',
        'sections'      => array(

            // begin section
            array(
                'name'      => 'chapter_contents',
                'title'     => 'Contents Of This Chapter',
                'icon'      => 'fa fa-wifi',
                'fields'    => array(

                    array(
                        'id'              => 'content-group',
                        'type'            => 'group',
                        'title'           => 'Courses',
                        'button_title'    => 'Add Course',
                        'accordion_title' => 'New Course',
                        'fields'          => array(
                            array(
                                'id'             => 'course-content',
                                'type'           => 'select',
                                'title'          => 'Selected course',
                                'options'        => 'posts',
                                'query_args'     => array(
                                    'post_type'    => 'course-contents',
                                ),
                                'default_option' => 'Select a course',
                            ),

                        ),
                    ),

                ),
            ),
        )
    );

    return $options;
}

add_filter( 'cs_metabox_options', 'mt_companion_cs_framework_options' );



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

function is_purchased_course($id) {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        return wc_customer_bought_product( $current_user->user_email, $current_user->ID, $id);

    }else{
        return false;
    }
}
