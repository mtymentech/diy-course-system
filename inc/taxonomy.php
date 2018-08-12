<?php

function mt_companion_course_level() {

    $labels = array(
        'name'                       => _x( 'Content Levels', 'Taxonomy General Name', 'mt_companion' ),
        'singular_name'              => _x( 'Content Level', 'Taxonomy Singular Name', 'mt_companion' ),
        'menu_name'                  => __( 'Content Levels', 'mt_companion' ),
        'all_items'                  => __( 'All Levels', 'mt_companion' ),
        'parent_item'                => __( 'Parent Level', 'mt_companion' ),
        'parent_item_colon'          => __( 'Parent Level:', 'mt_companion' ),
        'new_item_name'              => __( 'New Levels', 'mt_companion' ),
        'add_new_item'               => __( 'Add New Levels', 'mt_companion' ),
        'edit_item'                  => __( 'Edit Levels', 'mt_companion' ),
        'update_item'                => __( 'Update Levels', 'mt_companion' ),
        'view_item'                  => __( 'View Levels', 'mt_companion' ),
        'separate_items_with_commas' => __( 'Separate Levels with commas', 'mt_companion' ),
        'add_or_remove_items'        => __( 'Add or Levels items', 'mt_companion' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'mt_companion' ),
        'popular_items'              => __( 'Popular Levels', 'mt_companion' ),
        'search_items'               => __( 'Search Levels', 'mt_companion' ),
        'not_found'                  => __( 'No Level Found', 'mt_companion' ),
        'no_terms'                   => __( 'No Levels', 'mt_companion' ),
        'items_list'                 => __( 'Level list', 'mt_companion' ),
        'items_list_navigation'      => __( 'Level list navigation', 'mt_companion' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => false,
    );
    register_taxonomy( 'content_level', array( 'course-contents' ), $args );

}
//add_action( 'init', 'mt_companion_course_level', 0 );
?>