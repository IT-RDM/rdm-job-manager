<div class="wrap" style="background-color: #fff;padding: 20px;">
	
		<table class="form-table rdm_jobs_reports_page reports_overview">
			
			<tr valign="top">
				
				<td style="text-align:center">					
					<p class="diagram_title"><?php  echo __('Completed jobs','rdm-job-manager'); ?></p>
					<div class="rdm_jobs_diagram Jobs_progress"><strong></strong></div>	

					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Total Jobs','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Job_Helpers::get_all(); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>					

					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Completed Jobs','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Job_Helpers::get_by_status('completed'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>	
				
					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Lead Jobs','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Job_Helpers::get_by_status('lead'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>
					
					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Ongoing Jobs','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Job_Helpers::get_by_status('ongoing'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>	

					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('On-hold Jobs','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Job_Helpers::get_by_status('onhold'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>		

					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Awaiting Feedback','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Job_Helpers::get_by_status('awaiting_feedback'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>			
					
					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Status not set','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Job_Helpers::get_by_status('not_set'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>
					
					
				</td>
				
				<td style="text-align:center">		
				
					<p class="diagram_title"><?php  echo __('Completed Processes','rdm-job-manager'); ?></p>		
					<div class="rdm_jobs_diagram processes_progress"><strong></strong> </div>	

					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Total Processes','rdm-job-manager'); ?></p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Processes_Helpers::get_all(); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>
					
					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Completed processes','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Processes_Helpers::get_by_status('completed'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>	

					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Ongoing Processes','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Processes_Helpers::get_by_status('ongoing'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>			

					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('On-hold Jobs','rdm-job-manager'); ?>  </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Processes_Helpers::get_by_status('onhold'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>		

					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Processes not started','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Processes_Helpers::get_by_status('not_started'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>					
					
				</td>	
				
				<td style="text-align:center">

					<p class="diagram_title"> <?php  echo __('Paid Invoices','rdm-job-manager'); ?> </p>		
					<div class="rdm_jobs_diagram invoices_progress"><strong></strong></div>
					
				
					<div class="breakdown_container">
						<div class="paid_title"> <p> <?php  echo __('Income','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Invoice_Helpers::get_invoices_amount_by_status('paid'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>
					
					<div class="breakdown_container">
						<div class="unpaid_title"> <p><?php  echo __('Pending','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Invoice_Helpers::get_invoices_amount_by_status('unpaid'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>					

					
					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Total Invoices','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Invoice_Helpers::get_all(); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>
					
					<div class="breakdown_container">
						<div class="breakdown_title"> <?php  echo __('Paid Invoices','rdm-job-manager'); ?> </div>
						<div class="breakdown_value"><?php echo Rdm_Jobs_Invoice_Helpers::get_by_status('paid'); ?></div>
						<div class="rdm_clear"></div>						
					</div>		

					<div class="breakdown_container">
						<div class="breakdown_title"> <?php  echo __('Unpaid Invoices','rdm-job-manager'); ?> </div>
						<div class="breakdown_value"><?php echo Rdm_Jobs_Invoice_Helpers::get_by_status('unpaid'); ?></div>
						<div class="rdm_clear"></div>						
					</div>		

					<div class="breakdown_container">
						<div class="breakdown_title"> <?php  echo __('Overdue Invoices','rdm-job-manager'); ?> </div>
						<div class="breakdown_value"><?php echo Rdm_Jobs_Invoice_Helpers::get_by_status('overdue'); ?></div>
						<div class="rdm_clear"></div>						
					</div>		

					<div class="breakdown_container">
						<div class="breakdown_title"> <?php  echo __('Cancelled Invoices','rdm-job-manager'); ?> </div>
						<div class="breakdown_value"><?php echo Rdm_Jobs_Invoice_Helpers::get_by_status('cancelled'); ?></div>
						<div class="rdm_clear"></div>						
					</div>						

				</td>	
				<td style="text-align:center">

					<p class="diagram_title"> <?php  echo __('Paid Purchases','rdm-job-manager'); ?> </p>		
					<div class="rdm_jobs_diagram purchases_progress"><strong></strong></div>


					<div class="breakdown_container">
						<div class="paid_title"> <p> <?php  echo __('Income','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Purchase_Helpers::get_purchases_amount_by_status('paid'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>

					<div class="breakdown_container">
						<div class="unpaid_title"> <p><?php  echo __('Pending','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Purchase_Helpers::get_purchases_amount_by_status('unpaid'); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>					


					<div class="breakdown_container">
						<div class="breakdown_title"> <p> <?php  echo __('Total Purchases','rdm-job-manager'); ?> </p></div>
						<div class="breakdown_value"> <p> <?php echo Rdm_Jobs_Purchase_Helpers::get_all(); ?> </p> </div>
						<div class="rdm_clear"></div>
					</div>

					<div class="breakdown_container">
						<div class="breakdown_title"> <?php  echo __('Paid Purchases','rdm-job-manager'); ?> </div>
						<div class="breakdown_value"><?php echo Rdm_Jobs_Purchase_Helpers::get_by_status('paid'); ?></div>
						<div class="rdm_clear"></div>						
					</div>		

					<div class="breakdown_container">
						<div class="breakdown_title"> <?php  echo __('Unpaid Purchases','rdm-job-manager'); ?> </div>
						<div class="breakdown_value"><?php echo Rdm_Jobs_Purchase_Helpers::get_by_status('unpaid'); ?></div>
						<div class="rdm_clear"></div>						
					</div>		

					<div class="breakdown_container">
						<div class="breakdown_title"> <?php  echo __('Overdue Purchases','rdm-job-manager'); ?> </div>
						<div class="breakdown_value"><?php echo Rdm_Jobs_Purchase_Helpers::get_by_status('overdue'); ?></div>
						<div class="rdm_clear"></div>						
					</div>		

					<div class="breakdown_container">
						<div class="breakdown_title"> <?php  echo __('Cancelled Purchases','rdm-job-manager'); ?> </div>
						<div class="breakdown_value"><?php echo Rdm_Jobs_Purchase_Helpers::get_by_status('cancelled'); ?></div>
						<div class="rdm_clear"></div>						
					</div>						

					</td>			
			</tr>			

			
			
		</table>
		
	
</div>

<script>
	jQuery(document).ready(function($){
	
		
		//Jobs % report
		jQuery('.rdm_jobs_reports_page .jobs_progress').circleProgress({
			<?php if(Rdm_Jobs_Job_Helpers::get_all() > 0) { ?>
				value: <?php echo (Rdm_Jobs_Job_Helpers::get_by_status('completed') / Rdm_Jobs_Job_Helpers::get_all()); ?>,
			<?php } else { ?>
				value: 0,
			<?php } ?>
			size: 200,
			thickness:30,
			startAngle: -1.57,
			fill: {
			  gradient: ['#3aeabb', '#3aeabb']
			}}
			).on('circle-animation-progress', function(event, progress, stepValue) {
				jQuery(this).find('strong').html(parseInt(100 * stepValue) + '<i>%</i>');
			});
		
		
		//Processes % report
		jQuery('.rdm_jobs_reports_page .processes_progress').circleProgress({
			<?php if(Rdm_Jobs_Processes_Helpers::get_all() > 0) { ?>
				value: <?php echo (Rdm_Jobs_Processes_Helpers::get_completed() / Rdm_Jobs_Processes_Helpers::get_all()); ?>,
			<?php }else{ ?>
				value: 0,
			<?php } ?>
			size: 200,
			thickness:30,
			startAngle: -1.57,
			fill: {
			  gradient: ['#3aeabb', '#3aeabb']
			}}
			).on('circle-animation-progress', function(event, progress, stepValue) {
				jQuery(this).find('strong').html(parseInt(100 * stepValue) + '<i>%</i>');
			});			
		
		
		
		//Invoices % report
		jQuery('.rdm_jobs_reports_page .invoices_progress').circleProgress({
			value: <?php echo Rdm_Jobs_Invoice_Helpers::get_paid_invoices_percent(); ?>,
			size: 200,
			thickness:30,
			startAngle: -1.57,
			fill: {
			  gradient: ['#3aeabb', '#3aeabb']
			}}
			).on('circle-animation-progress', function(event, progress, stepValue) {
				jQuery(this).find('strong').html(parseInt(100 * stepValue) + '<i>%</i>');
			});	

		//Purchases % report
		jQuery('.rdm_jobs_reports_page .purchases_progress').circleProgress({
		value: <?php echo Rdm_Jobs_Purchase_Helpers::get_paid_purchases_percent(); ?>,
		size: 200,
		thickness:30,
		startAngle: -1.57,
		fill: {
			gradient: ['#3aeabb', '#3aeabb']
		}}
		).on('circle-animation-progress', function(event, progress, stepValue) {
			jQuery(this).find('strong').html(parseInt(100 * stepValue) + '<i>%</i>');
		});	
					
	});
</script>