<?php


	$labels = array(
		'name'                => _x( 'Client', 'Post Type General Name', 'rdm-job-manager' ),
		'singular_name'       => _x( 'Client', 'Post Type Singular Name', 'rdm-job-manager' ),
		'menu_name'           => __( 'Clients', 'rdm-job-manager' ),
		'parent_item_colon'   => __( 'Parent Client :', 'rdm-job-manager' ),
		'all_items'           => __( 'Clients', 'rdm-job-manager' ),
		'view_item'           => __( 'View Client', 'rdm-job-manager' ),
		'add_new_item'        => __( 'Add Client', 'rdm-job-manager' ),
		'add_new'             => __( 'Add Client', 'rdm-job-manager' ),
		'edit_item'           => __( 'Edit Client', 'rdm-job-manager' ),
		'update_item'         => __( 'Update Client', 'rdm-job-manager' ),
		'search_items'        => __( 'Search Client', 'rdm-job-manager' ),
		'not_found'           => __( 'No Client found', 'rdm-job-manager' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rdm-job-manager' ),
	);

	$args = array(
		'label'               => __( 'rdm_client', 'rdm-job-manager' ),
		'description'         => __('Clients', 'rdm-job-manager' ),
		'labels'              => $labels,
		'supports'            => array(),
		'taxonomies'          => array( 'Job_taxonomy' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => 'edit.php?post_type=rdm_job',
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 75,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		
	);
	register_post_type( 'rdm_client', $args );
