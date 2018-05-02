<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

switch ( $column ) {
	
	case 'process_deadline':
		$end_date= get_post_meta($post_id,'rdm_process_end_date_field_id',true);
		echo $end_date;
		break;

	case 'process_for_Job' :
		$process_id= get_post_meta($post_id,'rdm_process_for_Job_field',true);
		$Job_title = get_the_title($process_id);
		echo '<a href="'.get_edit_post_link($process_id).'">' . $Job_title .' </a>';
		break;

	case 'process_status':
		$status = get_post_meta($post_id,'rdm_process_status_process_field',true);
		$process_status ='';
		
		
		switch ($status){
		
		
			case 'process_status_not_started':
				$process_status =   __('Not Started','rdm-job-manager');  
			break;			
				
			case 'process_status_onhold':
				$process_status =   __('On Hold','rdm-job-manager');  
				break;			
				
			case 'process_status_cancelled':
				$process_status =   __('Cancelled','rdm-job-manager');  
				break;

			
			case 'process_status_ongoing':
				$process_status =    __('Ongoing','rdm-job-manager');  
				break;
			
			case 'process_status_finished':
				$process_status =  '<span style="color:rgb(47, 195, 15);">'.  __('Completed','rdm-job-manager') .'</span>';
				break;

		}
		
		echo $process_status ;
		
		break;			
}