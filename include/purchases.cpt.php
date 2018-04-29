<?php


	$labels = array(
		'name'                => _x( 'Purchase', 'Post Type General Name', 'rdm-job-manager' ),
		'singular_name'       => _x( 'Purchase', 'Post Type Singular Name', 'rdm-job-manager' ),
		'menu_name'           => __( 'Purchases', 'rdm-job-manager' ),
		'parent_item_colon'   => __( 'Parent Purchase :', 'rdm-job-manager' ),
		'all_items'           => __( 'Purchases', 'rdm-job-manager' ),
		'view_item'           => __( 'View Purchase', 'rdm-job-manager' ),
		'add_new_item'        => __( 'Add Purchase', 'rdm-job-manager' ),
		'add_new'             => __( 'Add Purchase', 'rdm-job-manager' ),
		'edit_item'           => __( 'Edit Purchase', 'rdm-job-manager' ),
		'update_item'         => __( 'Update Purchase', 'rdm-job-manager' ),
		'search_items'        => __( 'Search Purchase', 'rdm-job-manager' ),
		'not_found'           => __( 'No Purchase found', 'rdm-job-manager' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rdm-job-manager' ),
	);

	$args = array(
		'label'               => __( 'rdm_purchase', 'rdm-job-manager' ),
		'description'         => __('Purchases', 'rdm-job-manager' ),
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
		'capability_type'     => 'post',
		
	);
	register_post_type( 'rdm_purchase', $args );
