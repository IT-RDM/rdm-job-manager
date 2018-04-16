<html>
	<head>
	<style type="text/css" >
		<?php echo apply_filters('albwppm_purchase_pdf_css',$css_content); ?>
	</style>
	</head>
	<body>
	
		<table class="purchase_header_table" > 
			<tr class="company_info"> 
				<td style="width:80%"> 

						<div class="purchase_provider"> 
							<?php echo apply_filters('rdm_jobs_purchase_pdf_company_logo',__('Company','simple-job-managment')); ?>
						</div>
				
						<?php echo apply_filters('albwppm_purchase_pdf_company_logo',$company_logo); ?>

						<div>	
							<span class="company_name"><?php echo apply_filters('albwppm_purchase_pdf_company_title',$company_name); ?></span>
						</div>
						
						<div>
							<span class="company_name"><?php echo apply_filters('albwppm_purchase_pdf_company_address',$company_address); ?></span>
						</div>			
				</td>
				<td >  
				
					<div class="purchase_supplier"> 
						<?php echo apply_filters('rdm_jobs_purchase_pdf_supplier_title',__('Supplier','simple-job-managment')); ?>
					</div>
					
					<span class="supplier_name" > 
						<?php echo apply_filters('albwppm_purchase_pdf_supplier_first_name',$supplier_first_name); ?> 
						<?php echo apply_filters('albwppm_purchase_pdf_supplier_middle_name',$supplier_middle_name); ?> 
						<?php echo apply_filters('albwppm_purchase_pdf_supplier_last_name',$supplier_last_name); ?> 
						
					</span>
					
					<div>
						<?php echo apply_filters('albwppm_purchase_pdf_supplier_address',$supplier_address); ?>
					</div>
					
				</td>
			</tr>
			<tr>
				<td > &nbsp; </td>
				<td class="purchase_id"> 
					<?php echo apply_filters('albwppm_purchase_pdf_purchase_id',__('Invoice','simple-job-managment').' ' .$purchase_id, $purchase_id); ?>
				</td>
			</tr>
		</table>

		
		<table class="order_items">
			<thead>
				<tr>
					<td class="description_title"> <?php echo apply_filters('albwppm_purchase_pdf_description_table_header',__('Description','simple-job-managment')); ?></td>
					<td> <?php echo apply_filters('albwppm_purchase_pdf_price_table_header',__('Price','simple-job-managment')); ?> </td>
					<td> <?php echo apply_filters('albwppm_purchase_pdf_quantity_table_header',__('Quantity','simple-job-managment')); ?> </td>
					<td> <?php echo apply_filters('albwppm_purchase_pdf_total_table_header',__('Total','simple-job-managment')); ?> </td>
				</tr>	
			</thead>
			<tbody>
				<?php foreach($items_array as $single_item) {  ?>
					<tr>
						<td class="item_name"><?php echo apply_filters('albwppm_purchase_pdf_single_item_name_value',$single_item['ItemName']); ?> </td>
						<td class="unit_cost"> <?php echo apply_filters('albwppm_purchase_pdf_single_item_unit_cost_value',$single_item['ItemUnitCost']); ?> </td>
						<td class="item_quantity"><?php echo apply_filters('albwppm_purchase_pdf_single_item_quantity_value',$single_item['ItemQuantity']); ?> </td>
						<td class="item_total"><?php echo apply_filters('albwppm_purchase_pdf_single_item_total_cost_value',$single_item['ItemTotalCost']); ?></td>
					</tr>
				<?php } ?>
				
				<tr class="before_subtotal_separator"> <td colspan="4" class="no-borders"> &nbsp; </td></tr>
			
				
					<tr>
						<td class="no-borders"> </td>

						<?php if($subtotal!=''){ ?>
							<td colspan="2" class="subtotal_title"> <?php echo apply_filters('albwppm_purchase_pdf_subtotal_table_header',__('Subtotal','simple-job-managment')); ?> </td>
							<td><?php echo apply_filters('albwppm_purchase_pdf_subtotal_value',$subtotal); ?> </td>
						<?php } ?>
					</tr>	
				

				<?php if($discount!=''){ ?>
					<tr>
						<td class="no-borders"> &nbsp; </td>
						<td colspan="2"  class="discount_title"> <?php echo apply_filters('albwppm_purchase_pdf_discount_table_header',__('Discount','simple-job-managment')); ?> </td>
						<td><?php echo apply_filters('albwppm_purchase_pdf_discount_value',$discount); ?>  </td>
					</tr>	
				<?php } ?>	

				<?php if($subtotal_after_discount !=''){ ?>
					<tr>
						<td class="no-borders"> &nbsp; </td>
						<td colspan="2"  class="subtotal_after_discount_title"> <?php echo apply_filters('albwppm_purchase_pdf_subtotal_after_discount_table_header',__('Subtotal after discount','simple-job-managment')); ?> </td>
						<td> <?php echo apply_filters('albwppm_purchase_pdf_subtotal_after_discount_value',$subtotal_after_discount); ?>  </td>
					</tr>	
				<?php } ?>

				<?php if($vat!=''){ ?>
					<tr>
						<td class="no-borders"> &nbsp; </td>
						<td colspan="2"  class="vat_title"> <?php echo apply_filters('albwppm_purchase_pdf_vat_table_header',__('VAT','simple-job-managment')); ?> </td>
						<td><?php echo apply_filters('albwppm_purchase_pdf_vat_value',$vat); ?> </td>
					</tr>	
				<?php } ?>


				
			</tbody>
			
			<tfoot>
					<tr class="before_total_separator">
						<td colspan="4" class="no-borders"> &nbsp;  </td>
					</tr>
					
					<?php if($total!=''){ ?>
						<tr >
							<td class="no-borders"> &nbsp; </td>
							<td colspan="2"  class="balance_due_title"> <?php echo apply_filters('albwppm_purchase_pdf_balance_header',__('Balance','simple-job-managment')); ?>  </td>
							
							<td> <span class="balance_due_price"><?php echo $total ; ?></span>  </td>
						</tr>	
					<?php } ?>	
			</tfoot>

		</table>

		<?php if($purchase_specific_terms!=''){ ?>
			<div > 
				<span class="purchase_specific_terms_title">  <?php echo apply_filters('albwppm_purchase_pdf_specific_terms_header',__('Specific terms','simple-job-managment')); ?>   </span>
				<?php echo apply_filters('albwppm_purchase_pdf_specific_terms',$purchase_specific_terms); ?>
			
			</div>
		<?php } ?>

		<?php if($purchase_general_terms_and_conditions!=''){ ?>
			<div > 
				<span class="purchase_general_terms_title">  <?php echo apply_filters('albwppm_purchase_pdf_general_terms_header',__('General terms','simple-job-managment')); ?>  </span>
				<?php echo apply_filters('albwppm_purchase_pdf_general_terms',$purchase_general_terms_and_conditions); ?>
				
			</div>
		<?php } ?>
		
		
		<div id="footer">
		
			<?php if($company_name!=''){ ?>
				<div>	
					<span class="company_title"><?php echo apply_filters('albwppm_purchase_pdf_company_title_footer',$company_name); ?></span>
				</div>
			<?php } ?>
			
			<?php if($company_email!=''){ ?>
				<span class="company_email_title"><?php echo apply_filters('albwppm_purchase_pdf_email_footer_header',__('Email','simple-job-managment')); ?> </span><?php echo $company_email; ?>
			<?php } ?>
			
			<?php if($company_website!=''){ ?>
				<span class="company_website_title"><?php echo apply_filters('albwppm_purchase_pdf_email_website_header',__('Web','simple-job-managment')); ?> </span><?php echo $company_website; ?> 
			<?php } ?>
			
			<?php if($company_mobile!=''){ ?>
				<span class="company_mobile_title"><?php echo apply_filters('albwppm_purchase_pdf_email_mobile_header',__('Mobile','simple-job-managment')); ?> </span><?php echo $company_mobile; ?> 
			<?php } ?>
		</div>

		
	</body>
<html>