<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
	
	
/* 
* configure ORDERS metaboxes
*/

	$prefix_orders = 'shop_order_';

	$config = array(
		'id'             =>		'shop_order_meta_box',          // meta box id, unique per meta box
		'title'          => 	apply_filters('rdm_shop_order_cpt_shop_order_infos_metabox_title',__('Related Job','rdm-job-manager')),          // meta box title
		'pages'          => 	array('shop_order'),      // post types, accept custom post types as well, default is array('post'); optional
		'context'        => 	'side',            // where the meta box appear: normal (default), advanced, side; optional
		'priority'       => 	'high',            // order of meta box: high (default), low; optional
		'fields'         => 	array(),            // list of meta fields (can be added by field arrays)
		'local_images'   => 	false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => 	false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


/*
* Initiate your meta box
*/
	$orders_meta =  new AT_Meta_Box($config);

//ORDER is for job
	$orders_meta->addPosts($prefix_orders.'for_Job_field',array('post_type' => 'rdm_job'),array(
			'name'			=>	apply_filters('shop_order_cpt_shop_order_infos_metabox_associate_with_Job_label_title',__('Associate with Job','rdm-job-manager')),
			'emptylabel'	=>	apply_filters('shop_order_cpt_shop_order_infos_metabox_associate_with_Job_no_Job_option',__('No job selected','rdm-job-manager'))
	)
);
//ORDER Status .... Pending, On-hold, Progressing, Completed
$processes_meta->addSelect($prefix_processes.'status_process_field',array(
	'process_status_wc-pending'	=>	apply_filters('rdm_process_cpt_metabox_process_status_wc-pending_text',__('Pending','rdm-job-manager')),
	'process_status_wc-progressing'	=>	apply_filters('rdm_process_cpt_metabox_process_status_wc-progressing_text',__('Ongoing','rdm-job-manager')),
	'process_status_wc-on-hold'		=>	apply_filters('rdm_process_cpt_metabox_process_status_wc-on-hold_text',__('On Hold','rdm-job-manager')),
	'process_status_wc-completed'		=>	apply_filters('rdm_process_cpt_metabox_process_status_wc-completed_text',__('Completed','rdm-job-manager')),
	'process_status_wc-cancelled'		=>	apply_filters('rdm_process_cpt_metabox_process_status_wc-cancelled_text',__('Cancelled','rdm-job-manager'))
),
array(
	'name'	=>	apply_filters('rdm_process_cpt_metabox_process_status_label_text',__('Process Status','rdm-job-manager')),
	'std'	=>	array('process_status_wc-pending')
)
);




//Finish Meta Box Declaration 
	$orders_meta->Finish();