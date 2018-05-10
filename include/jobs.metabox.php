<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
	
	
/* 
* configure JobS metaboxes
*/

$prefix = 'rdm_job_';

$config = array(
	'id'             => 'Jobs_meta_box',         
	'title'          => apply_filters('alwppm_Job_cpt_Job_infos_metabox_title',__('Job Infos','rdm-job-manager')),          
	'pages'          => array('rdm_job'),    
	'context'        => 'normal',           
	'priority'       => 'high',            
	'fields'         => array(),          
	'local_images'   => false,         
	'use_with_theme' => false         
);


/*
* Initiate your meta box
*/
$Jobs_meta =  new AT_Meta_Box($config);

$Jobs_meta->addText($prefix.'estimate_field_id',array(
														'name'	=>	apply_filters('rdm_job_estimate_label_text',__('Estimate','rdm-job-manager'))
													)
												);

$Jobs_meta->addTextarea($prefix.'private_notes_field_id',array(
														'name'	=> 	apply_filters('rdm_job_private_notes_label_text',__('Private Job Notes','rdm-job-manager')), 
														'std'	=>	'',
														'group'	=>	'start'
													)
												);


$Jobs_meta->addTextarea($prefix.'public_notes_field_id',array(
														'name'	=>	apply_filters('rdm_job_public_notes_label_text',__('Public Job Notes','rdm-job-manager')), 
														'std'	=>	'',
														'group'	=>	'end'
													)
												);

//Job associated to client
	$Jobs_meta->addPosts($prefix.'client_field_id',array(
															'post_type' => 'rdm_client'
														),
														array(
															'name'			=> apply_filters('rdm_job_associate_to_client_label_text',__('Associate to client','rdm-job-manager')),
															'emptylabel'	=> apply_filters('rdm_job_associate_to_client_no_client_selected_label_text',__('No client selected','rdm-job-manager'))
														)
											);

								

//Job associated to supplier
$Jobs_meta->addPosts($prefix.'supplier_field_id',array(
	'post_type' => 'rdm_supplier'
),
array(
	'name'			=> apply_filters('rdm_job_associate_to_supplier_label_text',__('Associate to supplier','rdm-job-manager')),
	'emptylabel'	=> apply_filters('rdm_job_associate_to_supplier_no_supplier_selected_label_text',__('No supplier selected','rdm-job-manager'))
)
);



//Job Start Date , end date 
	$Jobs_meta->addDate($prefix.'start_date_field_id',array(
											'name'=> apply_filters('rdm_job_start_date_label_text',__('Start Date','rdm-job-manager').' ( i.e 24-12-2015 )'),
											'format' => 'd-m-yy',
											'group' => 'start')
										);
										
	$Jobs_meta->addDate($prefix.'target_end_date_field_id',array(
											'name'=> apply_filters('rdm_job_target_end_date_label_text',__('Target End Date','rdm-job-manager').' ( i.e 24-12-2015 )'),
											'format' => 'd-m-yy')
										);
	
	$Jobs_meta->addDate($prefix.'end_date_field_id',array(
											'name'=> apply_filters('rdm_job_actual_end_date_label_text',__('Actual End Date','rdm-job-manager').' ( i.e 24-12-2015 )'),
											'format' => 'd-m-yy',
											'group' => 'end')
										);

//Job Status .... Lead , Ongoing , Finished
	$Jobs_meta->addHidden($prefix.'text_field_id',array('name'=> 'rdmDummyGroupStartText' , 'std' => 'rdmDummyGroupStartText','group' => 'start'));

	$Jobs_meta->addSelect($prefix.'status_field',
								array(
									'Job_status_not_set'			=>	apply_filters('rdm_job_status_dropdown_not_set_text',__('Not Set','rdm-job-manager')) , 
									'Job_status_lead'				=>	apply_filters('rdm_job_status_dropdown_lead_text',__('Lead','rdm-job-manager')) , 
									'Job_status_ongoing'			=>	apply_filters('rdm_job_status_dropdown_ongoing_text',__('Ongoing','rdm-job-manager')) , 
									'Job_status_on_hold' 			=> 	apply_filters('rdm_job_status_dropdown_on_hold_text',__('Onhold','rdm-job-manager')) , 
									'Job_status_waiting_feedback' 	=> 	apply_filters('rdm_job_status_dropdown_awaiting_feedback_text',__('Awaiting Feedback','rdm-job-manager')) , 
									'Job_status_finished'			=>	apply_filters('rdm_job_status_dropdown_completed_text',__('Completed','rdm-job-manager')) ,
								),
								array(
									'name'	=>	apply_filters('rdm_job_status_dropdown_label_text',__('Job Status ','rdm-job-manager')), 
									'std'	=>	array('Job_status_not_set')
									)
							);
							
							
	
//Job progress	
	$Jobs_meta->addSelect($prefix.'progress_field',array(
													'not_set'	=>	apply_filters('rdm_job_progress_dropdown_not_set_text',__('Not Set','rdm-job-manager')) ,
													'10'		=>	apply_filters('rdm_job_progress_dropdown_10_percent_text','10 %') ,
													'20'		=>	apply_filters('rdm_job_progress_dropdown_20_percent_text','20 %') ,
													'30'		=>	apply_filters('rdm_job_progress_dropdown_30_percent_text','30 %') ,
													'40' 		=> 	apply_filters('rdm_job_progress_dropdown_40_percent_text','40 %') ,
													'50'		=>	apply_filters('rdm_job_progress_dropdown_50_percent_text','50 %') ,
													'60'		=>	apply_filters('rdm_job_progress_dropdown_60_percent_text','60 %') ,
													'70'		=>	apply_filters('rdm_job_progress_dropdown_70_percent_text','70 %') ,
													'80'		=>	apply_filters('rdm_job_progress_dropdown_80_percent_text','80 %') ,
													'90'		=>	apply_filters('rdm_job_progress_dropdown_90_percent_text','90 %') ,
													'100'		=>	apply_filters('rdm_job_progress_dropdown_100_percent_text','100 %') ,
												),
												array(
													'name'	=>	apply_filters('rdm_job_progress_dropdown_label_text',__('Job Progress ','rdm-job-manager')), 
													'std'	=>	array('not_set')
												)
											);	

//Job priority
	$Jobs_meta->addSelect($prefix.'priority_field',array(
														'Job_priority_not_set'	=>	apply_filters('rdm_job_priority_dropdown_not_set_text',__('Not Set','rdm-job-manager')),
														'Job_priority_low'		=>	apply_filters('rdm_job_priority_dropdown_low_text',__('Low','rdm-job-manager')),
														'Job_priority_normal'	=>	apply_filters('rdm_job_priority_dropdown_normal_text',__('Normal','rdm-job-manager')),
														'Job_priority_high' 	=>	apply_filters('rdm_job_priority_dropdown_high_text',__('High','rdm-job-manager')),
													),
													array(
														'name'	=>	apply_filters('rdm_job_priority_dropdown_label_text',__('Job Priority','rdm-job-manager')), 
														'std'	=>	array('Job_priority_not_set')
													)
												);	
	
	$Jobs_meta->addHidden($prefix.'text_field_id',array(
													'name'	=>	'rdmDummyGroupEndText' , 
													'std' 	=>	'rdmDummyGroupEndText',
													'group' =>	'end'
													)
												);

// Job Garments List 
/* if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5ab3a0e92953a',
		'title' => 'Client Products Details',
		'fields' => array(
			array(
				'key' => 'field_5aabb14f6f21a',
				'label' => 'Garments Sheets',
				'name' => 'garments_sheets',
				'type' => 'relationship',
				'instructions' => 'Use this field to select a sheet of garments related to this customer.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'show_fields_options' => '',
				'user_roles' => array(
					0 => 'all',
				),
				'post_type' => array(
					0 => 'garment_sheets',
				),
				'taxonomy' => array(
				),
				'filters' => array(
					0 => 'search',
				),
				'elements' => array(
					0 => 'featured_image',
				),
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			),
		),
		'location' => array(
			array(
				
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'rdm_job',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'left',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
	endif; */


	//Finish Meta Box Declaration 
	$Jobs_meta->Finish();



/*
* Job has the following processes 
*/


	$Jobs_processes_config = array(
		'id'             => 'Job_processes_meta_box',          // meta box id, unique per meta box
		'title'          => apply_filters('rdm_jobs_cpt_Job_processes_metabox_title',__('Job Processes','rdm-job-manager')),          // meta box title
		'pages'          => array('rdm_job'),      // post types, accept custom post types as well, default is array('post'); optional
		'context'        => 'side',            // where the meta box appear: normal (default), advanced, side; optional
		'priority'       => 'low',            // order of meta box: high (default), low; optional
		'fields'         => array(),            // list of meta fields (can be added by field arrays)
		'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


	$processesAssociateWithJob = apply_filters('rdm_jobs_cpt_Job_processes_metabox_no_processes_yet',__('Job Processes','rdm-job-manager'));

	//If we have a job ID , look for existing processes associated with it
	if(isset($_GET['post'])){
		
		$processIDForJobs = $_GET['post'];

		$processStatusToDisplay = __('Not Set','rdm-job-manager'); 

		//get all jobs for this client
		$get_processes_for_Job_params =array(
			'showposts'		=>	-1,
			'post_type' 	=>	'rdm_process',
			'post_status' 	=>	'publish',
			'meta_key'		=>	'rdm_process_for_Job_field',
			'meta_value'	=>	$processIDForJobs
		);
		
		$query_processes_for_Job = new WP_Query();
		
		$results_processes_for_Job = $query_processes_for_Job->query($get_processes_for_Job_params);

		//if we have at least one job for this client
		if(sizeof($results_processes_for_Job)>=1){
		
			$processesAssociateWithJob='';
		
			foreach($results_processes_for_Job as $single_process_for_Job){
				
				//Process Status
				if(get_post_meta($single_process_for_Job->ID , 'rdm_process_status_process_field', true)){
				
					$processStatus = get_post_meta($single_process_for_Job->ID , 'rdm_process_status_process_field', true);

					$processStatusToDisplay = rdm_get_human_process_status_by_meta_value_as_bullet($processStatus);
				}
				
				$processesAssociateWithJob.= $processStatusToDisplay ;
				
				//Process edit link
				$processesAssociateWithJob.= apply_filters ( 'rdm_jobs_cpt_Job_single_process_metabox_link' , '<a href="'.get_edit_post_link($single_process_for_Job->ID).'">'. $single_process_for_Job->post_title .'</a>' , $single_process_for_Job->ID , $single_process_for_Job->post_title );				
				$processesAssociateWithJob.= '<br>';
				
			} 
		
		} 

		

	} //end if isset post id 


	$processes_Jobs_metabox =  new AT_Meta_Box($Jobs_processes_config);
	
	$processes_Jobs_metabox->addParagraph('button_id',array('value' => $processesAssociateWithJob));
	
	$processes_Jobs_metabox->Finish();

/*
* Job has the following orders 
*/


$Jobs_orders_config = array(
	'id'             => 'job_orders_meta_box',          // meta box id, unique per meta box
	'title'          => apply_filters('rdm_jobs_cpt_job_orders_metabox_title',__('Job Orders','rdm-job-manager')),          // meta box title
	'pages'          => array('rdm_job'),      // post types, accept custom post types as well, default is array('post'); optional
	'context'        => 'side',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'       => 'low',            // order of meta box: high (default), low; optional
	'fields'         => array(),            // list of meta fields (can be added by field arrays)
	'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);


$ordersAssociateWithJob = apply_filters('rdm_jobs_cpt_job_orders_metabox_no_orders_yet',__('Job Orders','rdm-job-manager'));

//If we have a job ID , look for existing orders associated with it
if(isset($_GET['post'])){
	
	$orderIDForJobs = $_GET['post'];

	$orderStatusToDisplay = __('Not Set','rdm-job-manager'); 

	//get all orders for this client
	$get_orders_for_Job_params =array(
		'showposts'		=>	-1,
		'post_type' 	=>	'shop_order',
		'post_status' 	=>	'wc-pending',
		'meta_key'		=>	'shop_order_for_job_field',
		'meta_value'	=>	$orderIDForJobs
	);
	
	$query_orders_for_Job = new WP_Query();
	
	$results_orders_for_Job = $query_orders_for_Job->query($get_orders_for_Job_params);

	//if we have at least one order for this Job
	if(sizeof($results_orders_for_Job)>=1){
	
		$ordersAssociateWithJob='';
	
		foreach($results_orders_for_Job as $single_order_for_Job){
			
			//Order Status
			if(get_post_meta($single_order_for_Job->ID , 'shop_order_status_order_field', true)){
			
				$orderStatus = get_post_meta($single_order_for_Job->ID , 'shop_order_status_order_field', true);

				$orderStatusToDisplay = rdm_get_human_order_status_by_meta_value_as_bullet($orderStatus);
			}
			
			$ordersAssociateWithJob.= $orderStatusToDisplay ;
			
			//Order edit link
			$ordersAssociateWithJob.= apply_filters ( 'rdm_jobs_cpt_Job_single_order_metabox_link' , '<a href="'.get_edit_post_link($single_order_for_Job->ID).'">'. $single_order_for_Job->post_title .'</a>' , $single_order_for_Job->ID , $single_order_for_Job->post_title );				
			$ordersAssociateWithJob.= '<br>';
			
		} 
	
	} 

	

} //end if isset post id 


$orders_Jobs_metabox =  new AT_Meta_Box($Jobs_orders_config);

$orders_Jobs_metabox->addParagraph('button_id',array('value' => $ordersAssociateWithJob));

$orders_Jobs_metabox->Finish();