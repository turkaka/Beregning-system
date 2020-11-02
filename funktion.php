
<?php

function beregning_register_post_type() {

    // systems
    $labels = array(
        'name' => __( 'systems' , 'beregning' ),
        'singular_name' => __( 'system' , 'beregning' ),
        'add_new' => __( 'New system' , 'beregning' ),
        'add_new_item' => __( 'Add New system' , 'beregning' ),
        'edit_item' => __( 'Edit system' , 'beregning' ),
        'new_item' => __( 'New system' , 'beregning' ),
        'view_item' => __( 'View system' , 'beregning' ),
        'search_items' => __( 'Search systems' , 'beregning' ),
        'not_found' =>  __( 'No systems Found' , 'beregning' ),
        'not_found_in_trash' => __( 'No systems found in Trash' , 'beregning' ),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'custom-fields',
            'thumbnail',
            'page-attributes'
        ),
        'rewrite'   => array( 'slug' => 'systems' ),
        'show_in_rest' => true

    );
    register_post_type( 'beregning_system', $args );

}

add_action( 'init', 'beregning_register_post_type' );

function beregning_register_taxonomy() {

    // books
    $labels = array(
        'name' => __( 'Genres' , 'beregning' ),
        'singular_name' => __( 'Genre', 'beregning' ),
        'search_items' => __( 'Search Genres' , 'beregning' ),
        'all_items' => __( 'All Genres' , 'beregning' ),
        'edit_item' => __( 'Edit Genre' , 'beregning' ),
        'update_item' => __( 'Update Genres' , 'beregning' ),
        'add_new_item' => __( 'Add New Genre' , 'beregning' ),
        'new_item_name' => __( 'New Genre Name' , 'beregning' ),
        'menu_name' => __( 'Genres' , 'beregning' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ),
        'rewrite' => array( 'slug' => 'genres' ),
        'show_admin_column' => true,
        'show_in_rest' => true

    );

    register_taxonomy( 'beregning_genre', array( 'beregning_system' ), $args);

}
add_action( 'init', 'beregning_register_taxonomy' );


function beregning_system_styles() {
    wp_enqueue_style( 'systems',  plugin_dir_url( __FILE__ ) . ‘/css/systems.css’ );
}
add_action( 'wp_enqueue_scripts', ‘beregning_system_styles' );
