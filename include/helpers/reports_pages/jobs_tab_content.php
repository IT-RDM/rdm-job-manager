<div class="wrap" style="background-color: #fff;padding: 20px;">
	<h1><?php echo __('Jobs Tab','rdm-job-manager') ?></h1>

		<?php do_action('rdm_jobs_report_page_before_form_table'); ?>
	
		<table class="form-table rdm_jobs_reports_page">

			<tr valign="top">
				<td class="rdm_jobs_report_jobs_tab_form">
				
					<?php do_action('rdm_jobs_report_page_before_form'); ?>
				
					<form method="post" >

						<div>
							
							<div class="rdm_input">
								<div class="rdm_input_header"><?php  echo __('Client','rdm-job-manager'); ?></div>
								<?php Rdm_Jobs_Clients_Helpers::get_all_as_dropdown() ;?>
							</div>
							
							<div class="rdm_input">
								<div class="rdm_input_header"><?php  echo __('Priority','rdm-job-manager'); ?></div>							
								<?php echo Rdm_Jobs_Job_Helpers::dropdown_priorities(); ?>
							</div>	
							
							<div class="rdm_input">
								<div class="rdm_input_header"><?php  echo __('Progress','rdm-job-manager'); ?></div>	
								<?php echo Rdm_Jobs_Job_Helpers::dropdown_progress(); ?>								

							</div>								
							
							<div class="rdm_input">
								<div class="rdm_input_header"><?php  echo __('Status','rdm-job-manager'); ?></div>							
								<?php echo Rdm_Jobs_Job_Helpers::dropdown_statuses(); ?>
							</div>
							
							<div class="rdm_input">
								<div class="rdm_input_header"><?php  echo __('Start Date','rdm-job-manager'); ?></div>
									<?php echo Rdm_Jobs_Job_Helpers::dropdown_before_exactly_after('start_date'); ?>
							</div>
							
							
							<div class="rdm_input">
								<div class="rdm_input_header"><?php  echo __('End Date','rdm-job-manager'); ?></div>
									<?php echo Rdm_Jobs_Job_Helpers::dropdown_before_exactly_after('target_end_date'); ?>
							</div>

							<div class="rdm_input">
								<div class="rdm_input_header"><?php  echo __('Actual end Date','rdm-job-manager'); ?></div>
									<?php echo Rdm_Jobs_Job_Helpers::dropdown_before_exactly_after('actual_end_date'); ?>
							</div>						

							<div class="rdm_input">
								<div class="rdm_input_header">&nbsp;</div>							
								<input type="submit" class="button button-primary button-large" name="<?php echo Rdm_Jobs_Reports_Page::get_slug();?>"  value="<?php  echo __('Search Jobs','rdm-job-manager'); ?>">
							</div>
							
							<div class="rdm_clear"></div>
						</div>
						
					</form>
					
					<?php do_action('rdm_jobs_report_page_after_form'); ?>
					
				</td>
			</tr>

		</table>
		
		
		<?php do_action('rdm_jobs_report_page_before_report_table'); ?>
		
		<table>
			<tr>
				<td>
					<?php echo Rdm_Jobs_Job_Helpers::get_results_for_report(); ?>
				</td>
			</tr>
		</table>
		
		<?php do_action('rdm_jobs_report_page_after_report_table'); ?>

		
</div>