<?php
function register_taxonomies() {
    $labels = array(
        'name'              => _x( 'Styles', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Style', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Styles', 'textdomain' ),
        'all_items'         => __( 'All Styles', 'textdomain' ),
        'parent_item'       => __( 'Parent Style', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Style:', 'textdomain' ),
        'edit_item'         => __( 'Edit Style', 'textdomain' ),
        'update_item'       => __( 'Update Style', 'textdomain' ),
        'add_new_item'      => __( 'Add New Style', 'textdomain' ),
        'new_item_name'     => __( 'New Style Name', 'textdomain' ),
        'menu_name'         => __( 'Styles', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-style' ),
    );
    register_taxonomy( 'product-style', array('product'), $args );

    $labels = array(
        'name'              => _x( 'Collection', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Collection', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Collections', 'textdomain' ),
        'all_items'         => __( 'All Collections', 'textdomain' ),
        'parent_item'       => __( 'Parent Collection', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Collection:', 'textdomain' ),
        'edit_item'         => __( 'Edit Collection', 'textdomain' ),
        'update_item'       => __( 'Update Collection', 'textdomain' ),
        'add_new_item'      => __( 'Add New Collection', 'textdomain' ),
        'new_item_name'     => __( 'New Collection Name', 'textdomain' ),
        'menu_name'         => __( 'Collections', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-collection' ),
    );
    register_taxonomy( 'product-collection', array('product'), $args );

    $labels = array(
        'name'              => _x( 'Subject', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Subject', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Subjects', 'textdomain' ),
        'all_items'         => __( 'All Subjects', 'textdomain' ),
        'parent_item'       => __( 'Parent Subject', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Subject:', 'textdomain' ),
        'edit_item'         => __( 'Edit Subject', 'textdomain' ),
        'update_item'       => __( 'Update Subject', 'textdomain' ),
        'add_new_item'      => __( 'Add New Subject', 'textdomain' ),
        'new_item_name'     => __( 'New Subject Name', 'textdomain' ),
        'menu_name'         => __( 'Subjects', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-subject' ),
    );
    register_taxonomy( 'product-subject', array('product'), $args );

    $labels = array(
        'name'              => _x( 'Medium', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Medium', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Mediums', 'textdomain' ),
        'all_items'         => __( 'All Mediums', 'textdomain' ),
        'parent_item'       => __( 'Parent Medium', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Medium:', 'textdomain' ),
        'edit_item'         => __( 'Edit Medium', 'textdomain' ),
        'update_item'       => __( 'Update Medium', 'textdomain' ),
        'add_new_item'      => __( 'Add New Medium', 'textdomain' ),
        'new_item_name'     => __( 'New Medium Name', 'textdomain' ),
        'menu_name'         => __( 'Mediums', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-medium' ),
    );
    register_taxonomy( 'product-medium', array('product'), $args );


    $labels = array(
        'name'              => _x( 'Orientation', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Orientation', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Orientations', 'textdomain' ),
        'all_items'         => __( 'All Orientations', 'textdomain' ),
        'parent_item'       => __( 'Parent Orientation', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Orientation:', 'textdomain' ),
        'edit_item'         => __( 'Edit Orientation', 'textdomain' ),
        'update_item'       => __( 'Update Orientation', 'textdomain' ),
        'add_new_item'      => __( 'Add New Orientation', 'textdomain' ),
        'new_item_name'     => __( 'New Orientation Name', 'textdomain' ),
        'menu_name'         => __( 'Orientations', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-orientation' ),
    );
    register_taxonomy( 'product-orientation', array('product'), $args );


    $labels = array(
        'name'              => _x( 'Region', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Region', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Regions', 'textdomain' ),
        'all_items'         => __( 'All Regions', 'textdomain' ),
        'parent_item'       => __( 'Parent Region', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Region:', 'textdomain' ),
        'edit_item'         => __( 'Edit Region', 'textdomain' ),
        'update_item'       => __( 'Update Region', 'textdomain' ),
        'add_new_item'      => __( 'Add New Region', 'textdomain' ),
        'new_item_name'     => __( 'New Region Name', 'textdomain' ),
        'menu_name'         => __( 'Regions', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-region' ),
    );
    register_taxonomy( 'product-region', array('product'), $args );

    $labels = array(
        'name'              => _x( 'Size', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Size', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Sizes', 'textdomain' ),
        'all_items'         => __( 'All Sizes', 'textdomain' ),
        'parent_item'       => __( 'Parent Size', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Size:', 'textdomain' ),
        'edit_item'         => __( 'Edit Size', 'textdomain' ),
        'update_item'       => __( 'Update Size', 'textdomain' ),
        'add_new_item'      => __( 'Add New Size', 'textdomain' ),
        'new_item_name'     => __( 'New Size Name', 'textdomain' ),
        'menu_name'         => __( 'Sizes', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-size' ),
    );
    register_taxonomy( 'product-size', array('product'), $args );

    $labels = array(
        'name'              => _x( 'Staged Size', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Staged Size', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Staged Sizes', 'textdomain' ),
        'all_items'         => __( 'All Staged Sizes', 'textdomain' ),
        'parent_item'       => __( 'Parent Staged Size', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Staged Size:', 'textdomain' ),
        'edit_item'         => __( 'Edit Staged Size', 'textdomain' ),
        'update_item'       => __( 'Update Staged Size', 'textdomain' ),
        'add_new_item'      => __( 'Add New Staged Size', 'textdomain' ),
        'new_item_name'     => __( 'New Staged Size Name', 'textdomain' ),
        'menu_name'         => __( 'Staged Sizes', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-staged-size' ),
    );
    register_taxonomy( 'product-staged-size', array('product'), $args );
}
add_action( 'init', 'register_taxonomies', 0 );