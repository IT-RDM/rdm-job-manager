<?php


	$labels = array(
		'name'                => _x( 'Process', 'Post Type General Name', 'rdm-job-manager' ),
		'singular_name'       => _x( 'Process', 'Post Type Singular Name', 'rdm_job' ),
		'menu_name'           => __( 'Processes', 'rdm-job-manager' ),
		'parent_item_colon'   => __( 'Parent Process :', 'rdm-job-manager' ),
		'all_items'           => __( 'Processes', 'rdm-job-manager' ),
		'view_item'           => __( 'View Process', 'rdm-job-manager' ),
		'add_new_item'        => __( 'Add Process', 'rdm-job-manager' ),
		'add_new'             => __( 'Add Process', 'rdm-job-manager' ),
		'edit_item'           => __( 'Edit Process', 'rdm-job-manager' ),
		'update_item'         => __( 'Update Process', 'rdm-job-manager' ),
		'search_items'        => __( 'Search Process', 'rdm-job-manager' ),
		'not_found'           => __( 'No Process found', 'rdm-job-manager' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rdm-job-manager' ),
	);

	$args = array(
		'label'               => __( 'rdm_Process', 'rdm-job-manager' ),
		'description'         => __('Processes', 'rdm-job-manager' ),
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
	register_post_type( 'rdm_process', $args );
