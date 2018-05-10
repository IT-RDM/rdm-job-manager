<div class="wrap" style="background-color: #fff;padding: 20px;">
	<h1><?php echo __('Invoices Tab','rdm-job-manager') ?></h1>

		<table class="form-table rdm_jobs_reports_page">

			<tr valign="top">
				<td class="rdm_jobs_report_jobs_tab_form">
					<form method="post" >

						<div>
							<div class="rdm_input">
								<div class="rdm_input_header"><?php echo __('For Client','rdm-job-manager') ?></div>
								<?php Rdm_Jobs_Clients_Helpers::get_all_as_dropdown() ;?>
							</div>
							
							<div class="rdm_input">
								<div class="rdm_input_header"><?php echo __('Job','rdm-job-manager') ?></div>							
								<?php Rdm_Jobs_Job_Helpers::get_all_as_dropdown() ;?>
							</div>	
							
							<div class="rdm_input">
								<div class="rdm_input_header"><?php echo __('Status','rdm-job-manager') ?></div>	
								<?php echo Rdm_Jobs_Invoice_Helpers::dropdown_paid_status(); ?>				

							</div>								
							
							<div class="rdm_input">
								<div class="rdm_input_header">&nbsp;</div>							
								<input type="submit" class="button button-primary button-large" name="<?php echo Rdm_Jobs_Reports_Page::get_slug();?>"  value="<?php echo __('Search Invoices','rdm-job-manager') ?>">
							</div>
							
							<div class="rdm_clear"></div>
						</div>
						
					</form>
				</td>
			</tr>
		</table>
		
		
		<table>
			<tr>
				<td>
					<?php echo Rdm_Jobs_Invoice_Helpers::get_results_for_report(); ?>
				</td>
			</tr>
		</table>
		
</div>

