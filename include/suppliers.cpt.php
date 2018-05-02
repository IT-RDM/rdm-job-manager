<?php


	$labels = array(
		'name'                => _x( 'Supplier', 'Post Type General Name', 'rdm-job-manager' ),
		'singular_name'       => _x( 'Supplier', 'Post Type Singular Name', 'rdm-job-manager' ),
		'menu_name'           => __( 'Suppliers', 'rdm-job-manager' ),
		'parent_item_colon'   => __( 'Parent Supplier :', 'rdm-job-manager' ),
		'all_items'           => __( 'Suppliers', 'rdm-job-manager' ),
		'view_item'           => __( 'View Supplier', 'rdm-job-manager' ),
		'add_new_item'        => __( 'Add Supplier', 'rdm-job-manager' ),
		'add_new'             => __( 'Add Supplier', 'rdm-job-manager' ),
		'edit_item'           => __( 'Edit Supplier', 'rdm-job-manager' ),
		'update_item'         => __( 'Update Supplier', 'rdm-job-manager' ),
		'search_items'        => __( 'Search Supplier', 'rdm-job-manager' ),
		'not_found'           => __( 'No Supplier found', 'rdm-job-manager' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rdm-job-manager' ),
	);

	$args = array(
		'label'               => __( 'rdm_supplier', 'rdm-job-manager' ),
		'description'         => __('Suppliers', 'rdm-job-manager' ),
		'labels'              => $labels,
		"supports" 			  => array( "title", "thumbnail" ),
		'taxonomies'          => array( 'Job_taxonomy', 'product_brand' ),
		'hierarchical'        => false,
		"rewrite" 			  => array( "slug" => "suppliers", "with_front" => true ),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => 'edit.php?post_type=rdm_job',
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 75,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
		"map_meta_cap" => true,
		
	);
	register_post_type( 'rdm_supplier', $args );
