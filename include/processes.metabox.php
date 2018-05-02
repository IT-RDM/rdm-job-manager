<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
	
	
/* 
* configure PROCESSES metaboxes
*/

	$prefix_processes = 'rdm_process_';

	$config = array(
		'id'             =>		'process_meta_box',          // meta box id, unique per meta box
		'title'          => 	apply_filters('rdm_process_cpt_process_infos_metabox_title',__('Process Infos','rdm-job-manager')),          // meta box title
		'pages'          => 	array('rdm_process'),      // post types, accept custom post types as well, default is array('post'); optional
		'context'        => 	'normal',            // where the meta box appear: normal (default), advanced, side; optional
		'priority'       => 	'high',            // order of meta box: high (default), low; optional
		'fields'         => 	array(),            // list of meta fields (can be added by field arrays)
		'local_images'   => 	false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => 	false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


/*
* Initiate your meta box
*/
	$processes_meta =  new AT_Meta_Box($config);

//TASK is for job
	$processes_meta->addPosts($prefix_processes.'for_Job_field',array('post_type' => 'rdm_job'),array(
																											'name'			=>	apply_filters('rdm_process_cpt_process_infos_metabox_associate_with_Job_label_title',__('Associate to job','rdm-job-manager')),
																											'emptylabel'	=>	apply_filters('rdm_process_cpt_process_infos_metabox_associate_with_Job_no_Job_option',__('No job selected','rdm-job-manager'))
																									)
																);

//TASK Start Date , end date 
	$processes_meta->addDate($prefix_processes.'start_date_field_id',array(
																'name'	=> apply_filters('rdm_process_cpt_process_infos_metabox_start_date_label',__('Start Date','rdm-job-manager')),
																'group' => 'start'
																)
														);
														
	$processes_meta->addDate($prefix_processes.'end_date_field_id',array(
																'name'	=> apply_filters('rdm_process_cpt_process_infos_metabox_end_date_label',__('End Date','rdm-job-manager')),
																'group' => 'end'
																)
														);

//TASK Status .... Lead , Ongoing , Finished
	$processes_meta->addSelect($prefix_processes.'status_process_field',array(
																'process_status_not_started'	=>	apply_filters('rdm_process_cpt_metabox_process_status_not_started_text',__('Not Started','rdm-job-manager')),
																'process_status_ongoing'		=>	apply_filters('rdm_process_cpt_metabox_process_status_ongoing_text',__('Ongoing','rdm-job-manager')),
																'process_status_onhold'		=>	apply_filters('rdm_process_cpt_metabox_process_status_on_hold_text',__('On Hold','rdm-job-manager')),
																'process_status_finished'		=>	apply_filters('rdm_process_cpt_metabox_process_status_completed_text',__('Completed','rdm-job-manager')),
																'process_status_cancelled'		=>	apply_filters('rdm_process_cpt_metabox_process_status_cancelled_text',__('Cancelled','rdm-job-manager'))
															),
															array(
																'name'	=>	apply_filters('rdm_process_cpt_metabox_process_status_label_text',__('Process Status','rdm-job-manager')),
																'std'	=>	array('process_status_not_started')
															)
														);


//TASK files
	$process_files[] = $processes_meta->addText($prefix_processes.'process_file_description_id',array(
																						'name'	=> apply_filters('rdm_process_cpt_metabox_process_single_file_description_label',__('File Description','rdm-job-manager'))
																					),
																					true
																				);
	
	$process_files[] = $processes_meta->addFile($prefix_processes.'process_file_field_id',array(
																					'name'	=>	apply_filters('rdm_process_cpt_metabox_process_add_process_file_label',__('Add process file','rdm-job-manager'))
																				),
																				true
																			);
	
	$processes_meta->addRepeaterBlock($prefix_processes.'re_processes_',array(
															'inline'   	=>	false, 
															'name'     	=>	apply_filters('rdm_process_cpt_metabox_process_file_label',__('Process Files','rdm-job-manager')),
															'fields'   	=>	$process_files, 
															'sortable'	=>	true
														  )
									);

//Finish Meta Box Declaration 
	$processes_meta->Finish();