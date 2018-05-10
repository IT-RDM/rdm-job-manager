<?php


	$labels = array(
		'name'                => _x( 'Job', 'Post Type General Name', 'rdm-job-manager' ),
		'singular_name'       => _x( 'Job', 'Post Type Singular Name', 'rdm-job-manager' ),
		'menu_name'           => __( 'Jobs', 'rdm-job-manager' ),
		'parent_item_colon'   => __( 'Parent Job :', 'rdm-job-manager' ),
		'all_items'           => __( 'Jobs', 'rdm-job-manager' ),
		'view_item'           => __( 'View Job', 'rdm-job-manager' ),
		'add_new_item'        => __( 'Add Job', 'rdm-job-manager' ),
		'add_new'             => __( 'Add Job', 'rdm-job-manager' ),
		'edit_item'           => __( 'Edit Job', 'rdm-job-manager' ),
		'update_item'         => __( 'Update Job', 'rdm-job-manager' ),
		'search_items'        => __( 'Search Job', 'rdm-job-manager' ),
		'not_found'           => __( 'No Job found', 'rdm-job-manager' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rdm-job-manager' ),
	);

	$args = array(
		'label'               => __( 'rdm_job', 'rdm-job-manager' ),
		'description'         => __('Jobs', 'rdm-job-manager' ),
		'labels'              => $labels,
		'supports'            => array(),
		'taxonomies'          => array( 'Job_taxonomy' ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'			  => 'dashicons-clipboard',
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'page',
		
	);
	register_post_type( 'rdm_job', $args );