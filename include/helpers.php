<?php




/*
* Returns Process Status as bullets
*/
function rdm_get_human_process_status_by_meta_value_as_bullet($status){

	$processStatusToDisplay = 'Not Set';

	
	switch ($status){
		
		case 'process_status_cancelled':
			$processStatusToDisplay = '<span class="rdm_generic_bullet_cancelled ">X</span>';
			break;
	
		case 'process_status_not_started':
			$processStatusToDisplay = '<span class="rdm_generic_bullet_not_started"></span>';
			break;
		
		case 'process_status_ongoing':
			$processStatusToDisplay =  '<span class="rdm_generic_bullet_ongoing"></span>';
			break;
		
		case 'process_status_finished':
			$processStatusToDisplay =  '<span class="rdm_generic_bullet_finished"></span>';
			break;
		
		case 'process_status_onhold':
			$processStatusToDisplay =  '<span class="rdm_generic_bullet_onhold"></span>';
			break;			
	}

	return $processStatusToDisplay ;
}



/*
* ECHO Process status as LI bullets
*/
function processes_for_job_as_bullets($jobID){
			//get all processes for this post 
			$get_process_for_job_params =array(
				'showposts'=>-1,
				'post_type' => 'rdm_process',
				'post_status' => 'publish',
				'meta_key'=>'rdm_process_for_job_field',
				'meta_value'=> $jobID
			);
			$query_process_of_job = new WP_Query();
			$results_processes_for_job = $query_process_of_job->query($get_process_for_job_params);
		
			//if we have a process
			if(sizeof($results_processes_for_job) >= 1 ){
				
			
				foreach($results_processes_for_job as $single_process_for_job){
				
					$process_id	 = $single_process_for_job->ID ;
					$process_status_meta = get_post_meta($single_process_for_job->ID,'rdm_process_status_process_field',true);
					

						if ($process_status_meta == 'process_status_not_started'){
							echo apply_filters('rdm_jobs_cpt_list_post_table_single_job_process_not_started',rdm_get_human_process_status_by_meta_value_as_bullet('process_status_not_started').'<a href="'.get_edit_post_link($process_id).'"  title="Process not Started" > # ' . $process_id .' </a> <div></div>',$jobID,$process_id , $process_status_meta );
							
						}elseif ($process_status_meta == 'process_status_ongoing'){
							
							echo  apply_filters('rdm_jobs_cpt_list_post_table_single_job_process_ongoing',rdm_get_human_process_status_by_meta_value_as_bullet('process_status_ongoing').'<a href="'.get_edit_post_link($process_id).'" title="Process ongoing"> # ' . $process_id .' </a>  <br>',$jobID,$process_id , $process_status_meta);
							
						}elseif ($process_status_meta == 'process_status_finished'){
							echo  apply_filters('rdm_jobs_cpt_list_post_table_single_job_process_finished',rdm_get_human_process_status_by_meta_value_as_bullet('process_status_finished').'<a href="'.get_edit_post_link($process_id).'" title="Process finished"> # ' . $process_id .' </a>  <br>',$jobID,$process_id , $process_status_meta);
							
						}elseif ($process_status_meta == 'process_status_cancelled'){
							echo  apply_filters('rdm_jobs_cpt_list_post_table_single_job_process_cancelled',rdm_get_human_process_status_by_meta_value_as_bullet('process_status_cancelled').'<a href="'.get_edit_post_link($process_id).'" title="Process cancelled"> # ' . $process_id .' </a>  <br>',$jobID,$process_id , $process_status_meta);
							
						}elseif ($process_status_meta == 'process_status_onhold'){
							echo  apply_filters('rdm_jobs_cpt_list_post_table_single_job_process_onhold',rdm_get_human_process_status_by_meta_value_as_bullet('process_status_onhold').'<a href="'.get_edit_post_link($process_id).'" title="Process onhold"> # ' . $process_id .' </a>  <br>',$jobID,$process_id , $process_status_meta);
							
						}else{
							
							//unexpected process status ... return plain edit link for process
							echo  apply_filters('rdm_jobs_cpt_list_post_table_single_job_process_unexpected_status','<a href="'.get_edit_post_link($process_id).'" title="Process status unknown"> # ' . $process_id .' </a>  <br>',$jobID,$process_id , $process_status_meta);
						}						

				}
				
			}
}
