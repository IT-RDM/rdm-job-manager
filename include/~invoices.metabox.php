<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/* 
* Invoices metaboxes prefix
*/

	$prefix_invoices = 'rdm_jobs_invoices_';

	
/*
* List all clients,job, processes
*/

	$list_all_clients_info_config = array(
		'id'             	=> 	'all_clients_meta_box',          // meta box id, unique per meta box
		'title'          	=> 	apply_filters('rdm_invoices_cpt_invoice_infos_metabox_title',__('Prepare Invoices','rdm-job-manager')), // meta box title
		'pages'          	=> 	array('rdm_invoice'),      // post types, accept custom post types as well, default is array('post'); optional
		'context'        	=> 	'normal',            // where the meta box appear: normal (default), advanced, side; optional
		'priority'       	=> 	'high',            // order of meta box: high (default), low; optional
		'fields'        	=> 	array(),            // list of meta fields (can be added by field arrays)
		'local_images'  	=> 	false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme'	=> 	false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	
	$all_clients_info_metabox =  new AT_Meta_Box($list_all_clients_info_config);

	//Associate invoice to client,job process
	$all_clients_info_metabox->addPosts($prefix_invoices.'client_field_id',
										array(
											'post_type' =>	'rdm_client',
											'args' 		=> 	array('orderby' => 'title', 'order' => 'ASC')
										),
										array(
											'name'			=>	apply_filters('rdm_invoices_cpt_invoice_infos_metabox_send_to_client_label',__('Send to client','rdm-job-manager')),
											'emptylabel'	=>	apply_filters('rdm_invoices_cpt_invoice_infos_metabox_send_to_client_no_client_selected_option',__('No client selected','rdm-job-manager')),
											'group' 		=> 'start'
										)
									);
	
	$all_clients_info_metabox->addPosts($prefix_invoices.'Job_field_id',
										array(
											'post_type'		=>	'rdm_job',
											'args' 			=>	array('orderby' => 'title', 'order' => 'DESC')
										),
										array(
											'name'			=>	apply_filters('rdm_invoices_cpt_invoice_infos_metabox_related_to_Job_label',__('Related to job','rdm-job-manager')),
											'emptylabel'	=>	apply_filters('rdm_invoices_cpt_invoice_infos_metabox_related_to_Job_no_Job_selected',__('No job selected','rdm-job-manager')),
										)
									);
	
	$all_clients_info_metabox->addPosts($prefix_invoices.'process_field_id',
										array(
											'post_type' => 'rdm_process',
											'args' 		=> array('orderby' => 'title', 'order' => 'DESC')
										),
										array(
											'name'			=>	apply_filters('rdm_invoices_cpt_invoice_infos_metabox_related_to_process_label',__('Related to process','rdm-job-manager')),
											'emptylabel'	=>	apply_filters('rdm_invoices_cpt_invoice_infos_metabox_related_to_Job_no_process_selected',__('No process selected','rdm-job-manager')),
											'group' 		=>	'end'
										)
									);	

	$all_clients_info_metabox->Finish();

	
//Add our custom metabox that will contain the invoice table 	