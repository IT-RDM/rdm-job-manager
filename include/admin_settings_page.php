<?php
//image upload

//enqueue image upload scripts
wp_enqueue_script( 'albdsgJobplugin-image-upload',untrailingslashit( plugins_url( '../assets/admin/' , __FILE__ ) ).'/js/image_upload.js' ,array( 'jquery', 'media-upload', 'thickbox' ) );
wp_enqueue_style( 'thickbox' );


// form was submited , save option

if( isset( $_POST[Rdm_Jobs_Settings_Option_Page::get_class_meta_name()] ) ) {


	$opts_array = array();
	
	$opts_array['company_name'] 						= (isset($_POST['company_name'])) ? sanitize_text_field($_POST['company_name']) : '';
	$opts_array['company_logo_img'] 					= (isset($_POST['company_logo_img'])) ? sanitize_text_field($_POST['company_logo_img']) : '';
	$opts_array['company_address'] 						= (isset($_POST['company_address'])) ? esc_textarea ($_POST['company_address']) : '';
	$opts_array['company_email'] 						= (isset($_POST['company_email'])) ? sanitize_text_field($_POST['company_email']) : '';
	$opts_array['company_website'] 						= (isset($_POST['company_website'])) ? sanitize_text_field($_POST['company_website']) : '';
	$opts_array['company_phone'] 						= (isset($_POST['company_phone'])) ? sanitize_text_field($_POST['company_phone']) : '';
	$opts_array['invoice_terms'] 						= (isset($_POST['invoice_terms'])) ? esc_textarea($_POST['invoice_terms']) : '';
	$opts_array['invoice_default_vat'] 					= (isset($_POST['invoice_default_vat'])) ? sanitize_text_field($_POST['invoice_default_vat']) : '';
	$opts_array['invoice_default_currency'] 			= (isset($_POST['invoice_default_currency'])) ? sanitize_text_field($_POST['invoice_default_currency']) : '';
	$opts_array['invoice_default_currency_position'] 	= (isset($_POST['invoice_default_currency_position'])) ? sanitize_text_field($_POST['invoice_default_currency_position']) : 'left';
	$opts_array['pdf_template'] 						= (isset($_POST['selected_pdf_template'])) ? sanitize_text_field($_POST['selected_pdf_template']) : 'template1';
	$opts_array['purchase_terms'] 						= (isset($_POST['purchase_terms'])) ? esc_textarea($_POST['purchase_terms']) : '';
	$opts_array['purchase_default_vat'] 				= (isset($_POST['purchase_default_vat'])) ? sanitize_text_field($_POST['purchase_default_vat']) : '';
	$opts_array['purchase_default_currency'] 			= (isset($_POST['purchase_default_currency'])) ? sanitize_text_field($_POST['purchase_default_currency']) : '';
	$opts_array['purchase_default_currency_position'] 	= (isset($_POST['purchase_default_currency_position'])) ? sanitize_text_field($_POST['purchase_default_currency_position']) : 'left';
	
	
	update_option( Rdm_Jobs_Settings_Option_Page::get_class_meta_name() ,$opts_array);
}


	
?>

<div class="wrap" style="background-color: #fff;padding: 20px;">
	<h1><?php echo __('Settings Page','rdm-job-manager') ?></h1>
	<form method="post" >
		<table class="form-table">

			<tr valign="top">
				<th scope="row"><?php echo __('Company Name','rdm-job-manager') ?></th>
				<td  colspan="3">
					<input type="text" name="company_name" value="<?php echo Rdm_Jobs_Settings_Option_Page::get('company_name');?>">
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><?php echo __('Company Address','rdm-job-manager') ?></th>
				<td  colspan="3">
				
					<textarea class="at-textarea large-text" name="company_address" id="company_address" cols="60" rows="10" autocomplete="off"><?php echo Rdm_Jobs_Settings_Option_Page::get('company_address');?></textarea>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php echo __('Company Email','rdm-job-manager') ?></th>
				<td  colspan="3">
					<input type="text" name="company_email" value="<?php echo Rdm_Jobs_Settings_Option_Page::get('company_email');?>">
				</td>
			</tr>	

			<tr valign="top">
				<th scope="row"><?php echo __('Company Website','rdm-job-manager') ?></th>
				<td  colspan="3">
					<input type="text" name="company_website" value="<?php echo Rdm_Jobs_Settings_Option_Page::get('company_website');?>">
				</td>
			</tr>		

			<tr valign="top">
				<th scope="row"><?php echo __('Company Phone','rdm-job-manager') ?></th>
				<td  colspan="3">
					<input type="text" name="company_phone" value="<?php echo Rdm_Jobs_Settings_Option_Page::get('company_phone');?>">
				</td>
			</tr>			
			
			<tr valign="top">
				<th scope="row"><?php echo __('Company Logo','rdm-job-manager') ?> </th>
				<td  colspan="3">
	
					<input type="text" name="company_logo_img" id="company_logo_img" value="<?php echo Rdm_Jobs_Settings_Option_Page::get('company_logo_img');?>"> <span id="rdm_company_image_button" ><?php echo __('Upload','rdm-job-manager') ?></span>

					<div id="company_logo_img_preview"></div>
				</td>
			</tr>	

			<tr valign="top">
				<th scope="row"><?php echo __('Invoice Template','rdm-job-manager') ?></th>
				<td  colspan="3">
					<?php echo Rdm_Jobs_Settings_Option_Page::list_pdf_templates();?>
				</td>
			</tr>				
			
			
			<tr valign="top">
				<th scope="row"><?php echo __('Default Currency','rdm-job-manager') ?></th>
				<td  colspan="3">
					<input type="text" name="invoice_default_currency" value="<?php echo Rdm_Jobs_Settings_Option_Page::get('invoice_default_currency');?>">
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php echo esc_html(__('Currency Position','rdm-job-manager')) ?></th>
				<td  colspan="3">
					<select  name="invoice_default_currency_position" >
						<option <?php selected( Rdm_Jobs_Settings_Option_Page::get('invoice_default_currency_position'), 'left'); ?>   value="left"><?php echo __('Left of price','rdm-job-manager') ?> </option >
						<option  <?php selected( Rdm_Jobs_Settings_Option_Page::get('invoice_default_currency_position'), 'right'); ?>    value="right"><?php echo __('Right of price','rdm-job-manager') ?> </option>
					</select>
					
				</td>
			</tr>			
			
			<tr valign="top">
				<th scope="row"><?php echo __('Default VAT Value','rdm-job-manager') ?></th>
				<td  colspan="3">
				
					<input type="text" name="invoice_default_vat" value="<?php echo Rdm_Jobs_Settings_Option_Page::get('invoice_default_vat');?>"> %
				</td>
			</tr>				
			
			<tr valign="top">
				<th scope="row"><?php echo __('Invoice Terms','rdm-job-manager') ?></th>
				<td  colspan="3">
				
					<textarea class="at-textarea large-text" name="invoice_terms" id="invoice_terms" cols="60" rows="10" autocomplete="off"><?php echo Rdm_Jobs_Settings_Option_Page::get('invoice_terms');?></textarea>
				</td>
			</tr>			
			
			<!-- Purchases -->
			<tr valign="top">
				<th scope="row"><?php echo __('Purchase Template','rdm-job-manager') ?></th>
				<td  colspan="3">
					<?php echo Rdm_Jobs_Settings_Option_Page::list_purchase_pdf_templates();?>
				</td>
			</tr>				
			
			
			<tr valign="top">
				<th scope="row"><?php echo __('Default Currency','rdm-job-manager') ?></th>
				<td  colspan="3">
					<input type="text" name="purchase_default_currency" value="<?php echo Rdm_Jobs_Settings_Option_Page::get('purchase_default_currency');?>">
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php echo esc_html(__('Currency Position','rdm-job-manager')) ?></th>
				<td  colspan="3">
					<select  name="purchase_default_currency_position" >
						<option <?php selected( Rdm_Jobs_Settings_Option_Page::get('purchase_default_currency_position'), 'left'); ?>   value="left"><?php echo __('Left of price','rdm-job-manager') ?> </option >
						<option  <?php selected( Rdm_Jobs_Settings_Option_Page::get('purchase_default_currency_position'), 'right'); ?>    value="right"><?php echo __('Right of price','rdm-job-manager') ?> </option>
					</select>
					
				</td>
			</tr>			
			
			<tr valign="top">
				<th scope="row"><?php echo __('Default VAT Value','rdm-job-manager') ?></th>
				<td  colspan="3">
				
					<input type="text" name="purchase_default_vat" value="<?php echo Rdm_Jobs_Settings_Option_Page::get('purchase_default_vat');?>"> %
				</td>
			</tr>				
			
			<tr valign="top">
				<th scope="row"><?php echo __('Purchase Terms','rdm-job-manager') ?></th>
				<td  colspan="3">
				
					<textarea class="at-textarea large-text" name="purchase_terms" id="purchase_terms" cols="60" rows="10" autocomplete="off"><?php echo Rdm_Jobs_Settings_Option_Page::get('purchase_terms');?></textarea>
				</td>
			</tr>			
			
			<tr>
				<td>
					<input type="submit" class="button button-primary button-large" name="<?php echo Rdm_Jobs_Settings_Option_Page::get_class_meta_name();?>"  value="<?php echo  __('Save Changes','rdm-job-manager') ?>">
				</td>
			</tr>
			
			
		</table>
</div>