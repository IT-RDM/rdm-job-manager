<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
require_once('helpers/purchase.helper.class.php');
require_once('helpers/suppliers.helper.class.php');
	
/* 
* SUPPLIERS metaboxes prefix
*/

$prefix_suppliers = 'rdm_supplier_';

	
/*
* Supplier Infos
*/

	$suppliers_info_config = array(
		'id'             => 'suppliers_meta_box',          // meta box id, unique per meta box
		'title'          => apply_filters('rdm_suppliers_cpt_personal_information_metabox_title',__('Personal Information','rdm-job-manager')),          // meta box title
		'pages'          => array('rdm_supplier'),      // post types, accept custom post types as well, default is array('post'); optional
		'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
		'priority'       => 'high',            // order of meta box: high (default), low; optional
		'fields'         => array(),            // list of meta fields (can be added by field arrays)
		'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	
	$suppliers_info_metabox =  new AT_Meta_Box($suppliers_info_config);

	//Associate supplier to existing WP account

		$getUserFromWpArray['dont_associate'] = apply_filters('rdm_supplier_cpt_associate_with_user_dropdown_dont_associate_option_text',__('Dont Associate','rdm-job-manager'));
		
		$getAllWpUsers = get_users( 'orderby=nicename' );

		foreach ( $getAllWpUsers as $getAllWpUser ) {
			$getUserFromWpArray[$getAllWpUser->ID] = apply_filters('rdm_supplier_cpt_associate_with_user_dropdown_text', $getAllWpUser->user_nicename  , $getAllWpUser->ID);
		}

		$suppliers_info_metabox->addSelect(
										$prefix_suppliers.'asociate_with_existing_wp_account_field',
										$getUserFromWpArray,
										array(
											'name'=>  apply_filters('rdm_supplier_cpt_associate_with_existing_wp_account_dropdown_label',__('Associate with existing WordPress account','rdm-job-manager')), 
											'std'=> array(
														'dont_associate'
													),
										)
								);


	//array of options/fields for personal information metabox
	$suppliers_info_array=array(
	
		//first name , middle name , last name ... GROUP
		array(
			'id'		=> 'rdm_supplier_first_name_field_id',
			'type' 		=> 'text',
			'options' 	=> array(
				'name' 	=> apply_filters('rdm_single_supplier_cpt_first_name_label_text',__('First name','rdm-job-manager')),
				'group' => 'start',
				'class'	=> 'rdm_text_input',
			)
		),
		array(
			'id'		=> 'rdm_supplier_middle_name_field_id',
			'type' 		=> 'text',
			'options' 	=> array(
				'name' 	=> 	apply_filters('rdm_single_supplier_cpt_middle_name_label_text',__('Middle name','rdm-job-manager')),
				'class'	=> 'rdm_text_input',
			)
		),		
		array(
			'id'		=> 'rdm_supplier_last_name_field_id',
			'type' 		=> 'text',
			'options' 	=> array(
				'name' 	=> 	apply_filters('rdm_single_supplier_cpt_last_name_label_text',__('Last name','rdm-job-manager')),
				'group' => 	'end',			
				'class'	=> 'rdm_text_input',				
			)
		),
		
		//email,phone,mobile .... GROUP
		array(
			'id'		=> 'rdm_supplier_email_field_id',
			'type' 		=> 'text',
			'options' 	=> array(
				'name' 	=> 	apply_filters('rdm_single_supplier_cpt_email_label_text',__('Email','rdm-job-manager')),
				'group' => 	'start',
				'class'	=> 'rdm_text_input',
			)
		),
		array(
			'id'		=> 'rdm_supplier_phone_field_id',
			'type' 		=> 'text',
			'options' 	=> array(
				'name' 	=> 	apply_filters('rdm_single_supplier_cpt_phone_label_text',__('Phone','rdm-job-manager')),
				'class'	=> 'rdm_text_input',
				
			)
		),		
		array(
			'id'		=> 'rdm_supplier_mobile_field_id',
			'type' 		=> 'text',
			'options' 	=> array(
				'name' 	=> 	apply_filters('rdm_single_supplier_cpt_mobile_label_text',__('Mobile','rdm-job-manager')),
				'group' => 	'end',	
				'class'	=> 'rdm_text_input',
			)
		),		
		
		//Address
		array(
			'id'		=> 'rdm_supplier_address_field_id',
			'type' 		=> 'textarea',
			'options' 	=> array(
				'name' 	=> 	apply_filters('rdm_single_supplier_cpt_address_label_text',__('Address','rdm-job-manager')),
				'class'	=> 'rdm_textarea_input',
			)
		),
		
		//skype,facebook,twitter.... GROUP
		array(
			'id'		=> 'rdm_supplier_skype_field_id',
			'type' 		=> 'text',
			'options' 	=> array(
				'name' 	=> 	apply_filters('rdm_single_supplier_cpt_skype_label_text',__('Skype','rdm-job-manager')),
				'group' => 	'start',
				'class'	=> 'rdm_text_input',				
			)
		),
		array(
			'id'		=> 'rdm_supplier_facebook_field_id',
			'type' 		=> 'text',
			'options' 	=> array(
				'name' 	=> 	apply_filters('rdm_single_supplier_cpt_facebook_label_text',__('Facebook','rdm-job-manager')),
				'class'	=> 'rdm_text_input',				
				
			)
		),		
		array(
			'id'		=> 'rdm_supplier_twitter_field_id',
			'type' 		=> 'text',
			'options' 	=> array(
				'name' 	=> 	apply_filters('rdm_single_supplier_cpt_twitter_label_text','Twitter'),
				'group' => 	'end',
				'class'	=> 'rdm_text_input',				
			)
		),			
		
	);
	
	//Allow others to add custom fields to this metabox
	$suppliers_info_array = apply_filters('rdm_suppliers_extra_personal_information_metabox_fields',$suppliers_info_array);
	
	
	foreach($suppliers_info_array as $single_supplier_info){
		
		if($single_supplier_info['type']=='text'){
			$suppliers_info_metabox->addText($single_supplier_info['id'],$single_supplier_info['options']);
		}
		
		if($single_supplier_info['type']=='textarea'){
			$suppliers_info_metabox->addTextarea($single_supplier_info['id'],$single_supplier_info['options']);
		}
		
	}

	$suppliers_info_metabox->Finish();



/*
* Supplier Jobs
*/


	$suppliers_Job_config = array(
		'id'             => 'suppliers_Job_meta_box',          // meta box id, unique per meta box
		'title'          => apply_filters('rdm_suppliers_cpt_Jobs_metabox_title',__('Supplier Jobs','rdm-job-manager')),          // meta box title
		'pages'          => array('rdm_supplier'),      // post types, accept custom post types as well, default is array('post'); optional
		'context'        => 'side',            // where the meta box appear: normal (default), advanced, side; optional
		'priority'       => 'high',            // order of meta box: high (default), low; optional
		'fields'         => array(),            // list of meta fields (can be added by field arrays)
		'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

 
 	$JobsAssociateWithSupplier = apply_filters('rdm_no_Jobs_from_this_supplier_yet','No jobs','default_value');

	//If we have a supplier ID , look for existing jobs associated with supplier ID
	if(isset($_GET['post'])){
	
		$postIDForJobs = $_GET['post'];

		$JobsAssociateWithSupplier = Rdm_Jobs_Job_Helpers::get_Jobs_for_supplier_extra_columns($postIDForJobs);

	} //end if isset post id 

	$suppliers_Jobs_metabox =  new AT_Meta_Box($suppliers_Job_config);
	
	$suppliers_Jobs_metabox->addParagraph('button_id',array('value' => $JobsAssociateWithSupplier));
	
	$suppliers_Jobs_metabox->Finish(); 
 /*
* Client Jobs
*/


$clients_Job_config = array(
	'id'             => 'clients_Job_meta_box',          // meta box id, unique per meta box
	'title'          => apply_filters('rdm_clients_cpt_Jobs_metabox_title',__('Client Jobs','rdm-job-manager')),          // meta box title
	'pages'          => array('rdm_client'),      // post types, accept custom post types as well, default is array('post'); optional
	'context'        => 'side',            // where the meta box appear: normal (default), advanced, side; optional
	'priority'       => 'high',            // order of meta box: high (default), low; optional
	'fields'         => array(),            // list of meta fields (can be added by field arrays)
	'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
	'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);


$JobsAssociateWithClient = apply_filters('rdm_no_Jobs_from_this_client_yet','No jobs','default_value');

//If we have a client ID , look for existing jobs associated with client ID
if(isset($_GET['post'])){

	$postIDForJobs = $_GET['post'];

	$JobsAssociateWithClient = Rdm_Jobs_Job_Helpers::get_Jobs_for_client_extra_columns($postIDForJobs);

} //end if isset post id 

$clients_Jobs_metabox =  new AT_Meta_Box($clients_Job_config);

$clients_Jobs_metabox->addParagraph('button_id',array('value' => $JobsAssociateWithClient));

$clients_Jobs_metabox->Finish();
 
/*
* Supplier Purchases 
*/
	$suppliers_purchases_config = array(
		'id'             => 'suppliers_purchases_meta_box',          // meta box id, unique per meta box
		'title'          => apply_filters('rdm_suppliers_cpt_purchases_metabox_title',__('Supplier Purchases','rdm-job-manager')),          // meta box title
		'pages'          => array('rdm_supplier'),      // post types, accept custom post types as well, default is array('post'); optional
		'context'        => 'side',            // where the meta box appear: normal (default), advanced, side; optional
		'priority'       => 'low',            // order of meta box: high (default), low; optional
		'fields'         => array(),            // list of meta fields (can be added by field arrays)
		'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	
	
	//Default value for new suppliers
	$purchasesAssociateWithSupplier = apply_filters('rdm_no_purchases_for_this_supplier','No purchases','default_value');

	//If we have a supplier ID , look for existing purchases associated with supplier ID
	if(isset($_GET['post'])){
		$postIDForPurchases = $_GET['post'];

		$purchaseStatusToDisplay = 'Not Set';

		$purchasesAssociateWithSupplier = Rdm_Jobs_Purchase_Helpers::get_purchases_for_supplier_extra_columns($postIDForPurchases);

	} //end if isset post id 	
	
	$suppliers_purchases_metabox =  new AT_Meta_Box($suppliers_purchases_config);
	$suppliers_purchases_metabox->addParagraph($prefix_suppliers.'supplier_purchases_field_id',array('value' => $purchasesAssociateWithSupplier));
	$suppliers_purchases_metabox->Finish();
	
	
/*
* Supplier Review  
*/

	$suppliers_review_config = array(
		'id'             => 'suppliers_review_meta_box',        
		'title'          => apply_filters('rdm_suppliers_cpt_reviews_metabox_title',__('Supplier Review','rdm-job-manager')),         
		'pages'          => array('rdm_supplier'),    
		'context'        => 'side',          
		'priority'       => 'low',          
		'fields'         => array(),        
		'local_images'   => false,        
		'use_with_theme' => false        
	);


	$suppliers_reviews_metabox =  new AT_Meta_Box($suppliers_review_config);
	$suppliers_reviews_metabox->addSelect($prefix_suppliers.'review_field',array(
					'supplier_no_review_set'	=>	apply_filters('rdm_supplier_reviews_dropdown_review_default_text',__('No reviews','rdm-job-manager')) , 
					'supplier_review_1_star'	=>	apply_filters('rdm_supplier_reviews_dropdown_one_star_text','1 star'),
					'supplier_review_2_star'	=>	apply_filters('rdm_supplier_reviews_dropdown_two_star_text','2 stars'),
					'supplier_review_3_star'	=>	apply_filters('rdm_supplier_reviews_dropdown_three_star_text','3 stars'),
					'supplier_review_4_star'	=>	apply_filters('rdm_supplier_reviews_dropdown_four_star_text','4 stars'),
					'supplier_review_5_star'	=>	apply_filters('rdm_supplier_reviews_dropdown_five_star_text','5 stars'),
					),
					array('name'=> '','std'=> array('supplier_no_review_set'))
										);
	$suppliers_reviews_metabox->Finish();
