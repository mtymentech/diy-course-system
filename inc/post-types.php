<?php
function mt_companion_register_course() {

    /**
     * Post Type: Courses.
     */

    $labels = array(
        "name" => __( "Courses", "" ),
        "singular_name" => __( "Course", "" ),
        "featured_image" => __( "Course Image", "" ),
        "set_featured_image" => __( "Set Course Image", "" ),
        "remove_featured_image" => __( "Remove Course Image", "" ),
        "use_featured_image" => __( "Use Course Image", "" ),
    );

    $args = array(
        "label" => __( "Courses", "" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "course", "with_front" => true ),
        "query_var" => true,
        "menu_position" => 6,
        "menu_icon" => "dashicons-welcome-learn-more",
        "supports" => array( "title", "editor", "thumbnail", "excerpt", "custom-fields", "comments" ),
    );

    register_post_type( "course", $args );
    /**
     * Post Type: Chapters.
     */

    $labels = array(
        "name" => __( "Chapters", "mt_companion" ),
        "singular_name" => __( "Chapter", "" ),
    );

    $args_chapter = array(
        "label" => __( "Chapters", "" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "chapter", "with_front" => true ),
        "query_var" => true,
        "menu_position" => 6,
        "menu_icon" => "dashicons-format-aside",
        "supports" => array( "title"),
    );

    register_post_type( "chapter", $args_chapter );
}

add_action( 'init', 'mt_companion_register_course');

function mt_companion_register_course_contents() {

    /**
     * Post Type: Course Contents.
     */

    $labels = array(
        "name" => __( "Course Contents", "" ),
        "singular_name" => __( "Course Contents", "" ),
        "featured_image" => __( "Content Image", "" ),
        "set_featured_image" => __( "Set Content Image", "" ),
        "remove_featured_image" => __( "Remove Content Image", "" ),
        "use_featured_image" => __( "Use Content Image", "" ),
    );

    $args = array(
        "label" => __( "Course Contents", "" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "course-content", "with_front" => true ),
        "query_var" => true,
        "menu_position" => 7,
        "menu_icon" => "dashicons-album",
        "supports" => array( "title", "editor", "thumbnail", "excerpt", "custom-fields", "comments" ),
    );

    register_post_type( "course-contents", $args );
}

add_action( 'init', 'mt_companion_register_course_contents');