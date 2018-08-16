<?php
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
                'name'   => 'course-contents',
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
                                'id'             => 'chapter-title',
                                'type'           => 'text',
                                'title'          => __('Selected Chapter','mt_companion'),
                            ),
                            array(
                                'id'             => 'course-chapter',
                                'type'           => 'select',
                                'title'          => 'Selected Chapter',
                                'options'        => 'posts',
                                'query_args'     => array(
                                    'post_type'    => 'chapter',
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
                                'id'             => 'content-title',
                                'type'           => 'text',
                                'title'          => __('Content: ','mt_companion'),
                            ),
                            array(
                                'id'             => 'chapter-content',
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


    /**
     * course-contents MetaBox Information
     */

    $options[]      = array(
        'id'            => 'course-meta',
        'title'         => 'Course Material',
        'post_type'     => 'course-contents', // or post or CPT or array( 'page', 'post' )
        'context'       => 'normal',
        'priority'      => 'default',
        'sections'      => array(

            // begin section
            array(
                'name'      => 'video-information',
                'title'     => 'Course Video Information',
                'icon'      => 'fa fa-heart',
                'fields'    => array(
                    array(
                        'id'              => 'video-check',
                        'type'            => 'switcher',
                        'title'           => 'Has Video',
                        'label'           => 'Do you want to add a video ?',
                        'default'         =>0
                    ),
                    array(
                        'id'              => 'video-type',
                        'type'            => 'select',
                        'title'           => 'Add video from:',
                        'options'          => array(
                            'youtube'=> 'YouTube',
                            'vimeo'=> 'Vimeo'
                        ),
                        'default'=>'youtube',
                        'dependency'=> array( 'video-check', '==', '1' )
                    ),
                    array(
                        'id'              => 'youtube-video',
                        'type'            => 'text',
                        'title'           => 'Enter YouTube Video ID',
                        'dependency'=> array( 'video-check|video-type', '==|==', '1|youtube' )
                    ),
                    array(
                        'id'              => 'vimeo-video',
                        'type'            => 'text',
                        'title'           => 'Enter Vimeo Video ID',
                        'dependency'=> array( 'video-check|video-type', '==|==', '1|vimeo' )
                    ),
                    array(
                        'id'              => 'video-duration',
                        'type'            => 'text',
                        'title'           => 'Enter Video Duration',
                        'attributes'    => array(
                            'placeholder' => 'In minute. Eg- 4:30',
                        ),
                        'dependency'=> array( 'video-check', '==', '1' )
                    ),

                ),
            ),
        )
    );

    return $options;
}

add_filter( 'cs_metabox_options', 'mt_companion_cs_framework_options' );