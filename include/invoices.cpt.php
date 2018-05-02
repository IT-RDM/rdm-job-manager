<?php


	$labels = array(
		'name'                => _x( 'Invoice', 'Post Type General Name', 'rdm-job-manager' ),
		'singular_name'       => _x( 'Invoice', 'Post Type Singular Name', 'rdm-job-manager' ),
		'menu_name'           => __( 'Invoices', 'rdm-job-manager' ),
		'parent_item_colon'   => __( 'Parent Invoice :', 'rdm-job-manager' ),
		'all_items'           => __( 'Invoices', 'rdm-job-manager' ),
		'view_item'           => __( 'View Invoice', 'rdm-job-manager' ),
		'add_new_item'        => __( 'Add Invoice', 'rdm-job-manager' ),
		'add_new'             => __( 'Add Invoice', 'rdm-job-manager' ),
		'edit_item'           => __( 'Edit Invoice', 'rdm-job-manager' ),
		'update_item'         => __( 'Update Invoice', 'rdm-job-manager' ),
		'search_items'        => __( 'Search Invoice', 'rdm-job-manager' ),
		'not_found'           => __( 'No Invoice found', 'rdm-job-manager' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rdm-job-manager' ),
	);

	$args = array(
		'label'               => __( 'rdm_invoice', 'rdm-job-manager' ),
		'description'         => __('Invoices', 'rdm-job-manager' ),
		'labels'              => $labels,
		'supports'            => array(),
		'taxonomies'          => array( 'Job_taxonomy' ),
		'hierarchical'        => false,
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
		'capability_type'     => 'page',
		
	);
	register_post_type( 'rdm_invoice', $args );
