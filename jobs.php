<?php
/*
Plugin Name: RDM Job Manager
Description: RDM jobs management plugin 
Author: Rdm - Fabio P.
Version: 1.0.1
Text Domain: rdm-job-manager
Domain Path: /languages
*/

add_action('plugins_loaded', 'rdm_load_textdomain');
function rdm_load_textdomain() {
    load_plugin_textdomain( 'rdm-job-manager', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

class Rdm_Job_Management {

	private $plugin_slug ='rdm-job-manager';
	private $singular_cpt_name = 'Job';
	private $plural_cpt_name = 'Jobs';
	private static $instance = null;
	private $plugin_path;
	private $plugin_url;

	/**
	 * Creates or returns an instance of this class.
	 */
	public static function get_instance() {
		// If an instance hasn't been created and set to $instance create an instance and set it to $instance.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}	
	
	/**
	 * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
	 */	
	function __construct(){
	
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_url  = plugin_dir_url( __FILE__ );	

		// Register different CPT_s
		add_action( 'init', array($this,'register_cpts'), 0 );

		//add custom columns to JobS
		add_action( 'manage_posts_custom_column' , array($this,'show_job_custom_columns'), 10, 2 );
		add_action( 'manage_edit-rdm_job_columns' , array($this,'add_job_custom_columns'), 10, 2 );
	
		//add custom columns to PROCESSES
		add_action( 'manage_posts_custom_column' , array($this,'show_process_custom_columns'), 10, 2 );
		add_action( 'manage_edit-rdm_process_columns' , array($this,'add_process_custom_columns'), 10, 2 );	
		
		//add custom columns to CLIENTS
		add_action( 'manage_posts_custom_column' , array($this,'show_clients_custom_columns'), 10, 2 );
		add_action( 'manage_edit-rdm_client_columns' , array($this,'add_clients_custom_columns'), 10, 2 );	
		
		//add custom columns to INVOICES
		//add_action( 'manage_posts_custom_column' , array($this,'show_invoice_custom_columns'), 10, 2 );
		//add_action( 'manage_edit-rdm_invoice_columns' , array($this,'add_invoice_custom_columns'), 10, 2 );		
		
		//add custom columns to SUPPLIERS
		add_action( 'manage_posts_custom_column' , array($this,'show_suppliers_custom_columns'), 10, 2 );
		add_action( 'manage_edit-rdm_supplier_columns' , array($this,'add_suppliers_custom_columns'), 10, 2 );	
		
		//add custom columns to PURCHASES
		add_action( 'manage_posts_custom_column' , array($this,'show_purchase_custom_columns'), 10, 2 );
		add_action( 'manage_edit-rdm_purchase_columns' , array($this,'add_purchase_custom_columns'), 10, 2 );	
		
		//add ajax function to update client infos if associated with WP account
		add_action( 'wp_ajax_update_client_infos_if_associated_ajax', array( $this, 'update_client_infos_if_associated_ajax'));
		
		//add ajax function to update supplier infos if associated with WP account
		add_action( 'wp_ajax_update_supplier_infos_if_associated_ajax', array( $this, 'update_supplier_infos_if_associated_ajax'));
		
		//add admin css
		add_action('admin_enqueue_scripts', array($this,'rdm_job_managment_admin_css'));

		//add admin js
		add_action('in_admin_footer', array($this,'admin_footer'));
		
		$this->run_plugin();	
		
		//add metaboxes
		add_action( 'admin_menu', array( $this, 'albJob_add_meta_boxes' ) );

		//remove ADD JOB from menu on the left
		add_action('admin_menu', array($this,'remove_or_add_submenu_pages'));
		
		//do extra checks when our CPT-s are saved/updated
		add_action('save_post',array($this,'save_post'));
		
		//remove QUICK EDIT
		add_filter('post_row_actions',array($this,'remove_quick_edit'),10,2);
		
		
		//require_once('include/helpers/invoice.helper.class.php');
		//require_once('include/invoices.table.metabox.php');

		require_once('include/helpers/purchase.helper.class.php');
		require_once('include/purchases.table.metabox.php');
		
	}	
	
	/*
	* Remove QUIK EDIT on our CPT-s
	*/
	public function remove_quick_edit($actions ){
		
		global $post;
		
		if( $post->post_type == 'rdm_job' ||  $post->post_type == 'rdm_process'  ||  $post->post_type == 'rdm_client'  ||  $post->post_type == 'rdm_invoice' ||  $post->post_type == 'rdm_supplier'  ||  $post->post_type == 'rdm_purchase'  ) {
			
			unset($actions['inline hide-if-no-js']);
			
		}
		
		return $actions;
		
	}
	
	public function run_plugin(){
	
		require('include/helpers.php');
		require_once('include/meta-box-class/my-meta-box-class.php');

	}
	

	function admin_footer(){
	
		global $pagenow, $typenow;
		if( $typenow=='rdm_invoice' || $typenow =='rdm_job' || $typenow == 'rdm_process' || $typenow == 'rdm_client'  || $typenow == 'rdm_supplier' || $typenow=='rdm_purchase'){
			
			
			wp_register_script( 'rdm-jobs-admin-script', $this->get_plugin_url() . 'assets/admin/js/admin.js' );

			// Localize the script with new data
			$translation_array = array(
				'value_from_wp_user' => __( 'Value From Wordpress Account', 'rdm-job-manager' ),
				
			);
			wp_localize_script( 'rdm-jobs-admin-script', 'rdmJobsadmin', $translation_array );

			// Enqueued script with localized data.
			wp_enqueue_script( 'rdm-jobs-admin-script' );
			
			//wp_enqueue_script( 'rdm-jobs-admin-script', $this->get_plugin_url() . 'assets/admin/js/admin.js', array( 'jquery' ), null, true );
		}

	}
	
	public function get_plugin_url() {
		return $this->plugin_url;
	}

	public function get_plugin_path() {
		return $this->plugin_path;
	}	
	
	/*
	* Admin Scripts,Styles
	*/
	public function rdm_job_managment_admin_css(){
		
		global $pagenow, $typenow;
		
		if( $typenow=='rdm_invoice' || $typenow =='rdm_job' || $typenow == 'rdm_process' || $typenow == 'rdm_client' || $typenow == 'rdm_supplier' || $typenow == 'rdm_purchase' ){
			wp_enqueue_style('rdm-job-manager-circular_admin', $this->get_plugin_url().'assets/admin/css/jobs_admin.css');
		}
		 
		wp_register_script('rdm-job-manager-circular-diagram',$this->get_plugin_url().'assets/circle-diagram/js/circle-progress.js' ,array( 'jquery' ) );
		wp_register_style('rdm-job-manager-circular-diagram',$this->get_plugin_url().'assets/circle-diagram/css/style.css' );
	}
	
	/*
	* Return WP account infos if client is associated with an account
	*/
	public function update_client_infos_if_associated_ajax(){
		$userid = (int) $_POST['userID'];

		if( false == get_user_by( 'id', $userid ) ) {
			$return = array('rdm_found_user' => 'not');
		}else{
			
			$userFound = get_user_by( 'id', $userid );
		
			$return = array(
					'rdm_found_user' 	=>	'yes',
					'user_id' 				=>	$userFound->ID,
					'user_first_name' 		=>	$userFound->first_name,
					'user_last_name' 		=>	$userFound->last_name,
					'user_email' 			=>	$userFound->user_email,
					);
		}

		
		die(json_encode($return));
	}
	
	/*
	* Return WP account infos if supplier is associated with an account
	*/
	public function update_supplier_infos_if_associated_ajax(){
		$userid = (int) $_POST['userID'];

		if( false == get_user_by( 'id', $userid ) ) {
			$return = array('rdm_found_user' => 'not');
		}else{
			
			$userFound = get_user_by( 'id', $userid );
		
			$return = array(
					'rdm_found_user' 	=>	'yes',
					'user_id' 				=>	$userFound->ID,
					'user_first_name' 		=>	$userFound->first_name,
					'user_last_name' 		=>	$userFound->last_name,
					'user_email' 			=>	$userFound->user_email,
					);
		}

		
		die(json_encode($return));
	}
	
	/*
	* Register the different CPT_s 
	*/
	function register_cpts() {

				
		require_once('include/jobs.cpt.php');
		require_once('include/processes.cpt.php');
		require_once('include/clients.cpt.php');
		//require_once('include/invoices.cpt.php');		
		require_once('include/suppliers.cpt.php');
		require_once('include/purchases.cpt.php');	
		
		/*
		$jobs 	= new Rdm_Register_CPT('Job','Jobs');
		$processes 		= new Rdm_Register_CPT('Process','Processes','edit.php?post_type=rdm_job');
		$clients 	= new Rdm_Register_CPT('Client','Clients','edit.php?post_type=rdm_job');
		$invoices 	= new Rdm_Register_CPT('Invoice','Invoices','edit.php?post_type=rdm_job');
		*/
		//remove editor from INVOICE
		remove_post_type_support( 'rdm_invoice', 'editor' );
		remove_post_type_support( 'rdm_purchase', 'editor' );

		do_action('rdm_job_manager_add_new_cpt');
	}	
	
	//Remove "Add Job" from admin menu
	function remove_or_add_submenu_pages() { 
	
		remove_submenu_page('edit.php?post_type=rdm_job', 'post-new.php?post_type=rdm_job');
		
		//Add "Reports" as submenu to job
		add_submenu_page( 'edit.php?post_type=rdm_job', __('Reports','rdm-job-manager'),  __('Reports','rdm-job-manager'), 'manage_options', 'rdm-job-Reports', array($this,'reports_submenu_page_callback' ));		
		
		//Add "Settings" as submenu to job
		add_submenu_page( 'edit.php?post_type=rdm_job',  __('Settings','rdm-job-manager'),  __('Settings','rdm-job-manager'), 'manage_options', 'rdm-job-settings', array($this,'settings_submenu_page_callback' ));

	}	
	
	
	/*
	*	Add metaboxes to CPT_s
	*/	
	function albJob_add_meta_boxes(){
	
		if (is_admin()){

			require_once('include/meta-box-class/my-meta-box-class.php');
			
			//Jobs metaboxes
			require_once('include/jobs.metabox.php');

			//Process metaboxes
			require_once('include/processes.metabox.php');
			
			//Clients metaboxes
			require_once('include/clients.metabox.php');

			//Suppliers metaboxes
			require_once('include/suppliers.metabox.php');
			
			//Purchases metaboxes
			//require_once('include/purchases.metabox.php');
			require_once('include/purchases.table.metabox.php');

			//Invoices metaboxes
			//require_once('include/invoices.metabox.php');
			//require_once('include/invoices.table.metabox.php');
			
			//Orders metaboxes
			require_once('include/orders.metabox.php');
		} //end if is_admin
		
	}

	

	//Show additional columns on JOB list
	function show_job_custom_columns( $column, $post_id ) {
		require('include/jobs_list_extra_columns.php');		
	}
	
	//Show additional columns on TASK list
	function show_process_custom_columns( $column, $post_id ) {
		require('include/processes_list_extra_columns.php');		
	}	

	//Show additional columns on CLIENTS list
	function show_clients_custom_columns( $column, $post_id){
		require('include/clients_list_extra_columns.php');
	}
	//Show additional columns on SUPPLIERS list
	function show_suppliers_custom_columns( $column, $post_id){
		require('include/suppliers_list_extra_columns.php');
	}
	function add_job_custom_columns($columns) {
		//remove default WP date column
		unset($columns['date']);
		
		$columns['title'] 					=	apply_filters('rdm_jobs_cpt_list_post_table_header_job_text',__('Job','rdm-job-manager'));
		$columns['deadline'] 				=	apply_filters('rdm_jobs_cpt_list_post_table_header_deadline_text',__('Deadline','rdm-job-manager'));
		$columns['status'] 	 				=	apply_filters('rdm_jobs_cpt_list_post_table_header_status_text',__('Status','rdm-job-manager'));
		$columns['get_processes_for_job'] 	=	apply_filters('rdm_jobs_cpt_list_post_table_header_processes_text',__('Processes','rdm-job-manager'));
		$columns['client']	 				=	apply_filters('rdm_jobs_cpt_list_post_table_header_client_text',__('Client','rdm-job-manager'));
		$columns['earnings'] 				=	apply_filters('rdm_jobs_cpt_list_post_table_header_earning_text',__('Earning','rdm-job-manager'));

		return apply_filters('rdm_jobs_cpt_list_post_table_header_array',$columns);
		
		
	}

	
	function add_process_custom_columns($columns){
		//remove default WP date column
		unset($columns['date']);
		
		$columns['title'] 				= 	apply_filters('rdm_process_cpt_list_post_table_header_process_title_text',__('Process','rdm-job-manager'));
		$columns['process_deadline'] 		= 	apply_filters('rdm_process_cpt_list_post_table_header_process_deadline_text',__('Process Deadline','rdm-job-manager'));
		$columns['process_status'] 		= 	apply_filters('rdm_process_cpt_list_post_table_header_process_status_text',__('Process Status','rdm-job-manager'));
		$columns['process_for_job']	= 	apply_filters('rdm_process_cpt_list_post_table_header_process_job_text',__('Job','rdm-job-manager'));
		
		return apply_filters('rdm_processes_cpt_list_post_table_header_array',$columns);

	}
	

	function add_clients_custom_columns($columns){

		//remove default WP date column
		unset($columns['date']);	
	
		$columns['title'] 								=	apply_filters('rdm_clients_cpt_list_post_table_header_client_name',__('Client','rdm-job-manager'));
		$columns['rdm_jobs_client_jobs'] 	=	apply_filters('rdm_clients_cpt_list_post_table_header_jobs',__('Jobs','rdm-job-manager'));
		$columns['rdm_jobs_client_invoices'] 	=	apply_filters('rdm_clients_cpt_list_post_table_header_invoices',__('Invoices','rdm-job-manager'));
		$columns['rdm_jobs_client_reviews'] 	=	apply_filters('rdm_clients_cpt_list_post_table_header_reviews',__('Reviews','rdm-job-manager'));		
		
		return apply_filters('rdm_clients_cpt_list_post_table_header_array',$columns);

	}
	
	
	function show_invoice_custom_columns( $column, $post_id){
		require('include/invoice_list_extra_columns.php');
	}
	
	function add_invoice_custom_columns($columns){
	
		//remove default WP date column
		unset($columns['date']);
		
		$columns['title'] 								=	apply_filters('rdm_invoice_cpt_list_post_table_header_invoice_name',__('Invoice','rdm-job-manager'));
		$columns['rdm_jobs_invoice_total'] 				=	apply_filters('rdm_invoice_cpt_list_post_table_header_invoice_total',__('Total','rdm-job-manager'));
		$columns['rdm_jobs_invoice_status'] 			=	apply_filters('rdm_invoice_cpt_list_post_table_header_invoice_status',__('Status','rdm-job-manager'));
		$columns['rdm_jobs_invoice_for_client'] 		=	apply_filters('rdm_invoice_cpt_list_post_table_header_invoice_client_name',__('Client','rdm-job-manager'));

		return $columns;	
	}
	
	//Suppliers Custom Columns
	function add_suppliers_custom_columns($columns){

		//remove default WP date column
		unset($columns['date']);	
	
		$columns['title'] 								=	apply_filters('rdm_suppliers_cpt_list_post_table_header_supplier_name',__('Supplier','rdm-job-manager'));
		$columns['rdm_jobs_supplier_jobs'] 	=	apply_filters('rdm_suppliers_cpt_list_post_table_header_jobs',__('Jobs','rdm-job-manager'));
		$columns['rdm_jobs_supplier_purchases'] 	=	apply_filters('rdm_suppliers_cpt_list_post_table_header_purchases',__('Purchases','rdm-job-manager'));
		$columns['rdm_jobs_supplier_reviews'] 	=	apply_filters('rdm_suppliers_cpt_list_post_table_header_reviews',__('Reviews','rdm-job-manager'));		
		
		return apply_filters('rdm_suppliers_cpt_list_post_table_header_array',$columns);

	}

	function show_purchase_custom_columns( $column, $post_id){
		require('include/purchase_list_extra_columns.php');
	}
	
	function add_purchase_custom_columns($columns){
	
		//remove default WP date column
		unset($columns['date']);
		
		$columns['title'] 										=	apply_filters('rdm_purchase_cpt_list_post_table_header_purchase_name',__('Purchase','rdm-job-manager'));
		$columns['rdm_jobs_purchase_total'] 			=	apply_filters('rdm_purchase_cpt_list_post_table_header_purchase_total',__('Total','rdm-job-manager'));
		$columns['rdm_jobs_purchase_status'] 			=	apply_filters('rdm_purchase_cpt_list_post_table_header_purchase_status',__('Status','rdm-job-manager'));
		$columns['rdm_jobs_purchase_for_supplier'] 		=	apply_filters('rdm_purchase_cpt_list_post_table_header_purchase_client_name',__('Supplier','rdm-job-manager'));

		return $columns;	
	}

	/*
	* Add "Reports" as submenu page
	*/
	function reports_submenu_page_callback(){
		require_once('include/admin_reports.class.php');
		require_once('include/helpers/invoice.helper.class.php');
		require_once('include/helpers/clients.helper.class.php');
		require_once('include/helpers/purchase.helper.class.php');
		require_once('include/helpers/suppliers.helper.class.php');

		require_once('include/helpers/processes.helper.class.php');
		require_once('include/admin_reports_page.php');

	}
	
	
	/*
	* Add "Settings" as submenu to job
	*/
	function settings_submenu_page_callback(){
		require_once('include/admin_settings_page.php');
	}
	

	/*
	* Additional functions when our CPT-s are saved
	*/
	function save_post($postID){
	
		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']) || false !== wp_is_post_revision( $postID )){
			return;
		}
	
		if(get_post_type($postID) == 'rdm_job'){
			
			//start date
			if(isset($_POST['rdm_job_start_date_field_id'])){
				if($_POST['rdm_job_start_date_field_id']!=''){
					update_post_meta($postID,'rdm_job_start_date_field_id_timestamp',self::convert_human_date_to_unix($_POST['rdm_job_start_date_field_id']));
				}
			}

			//target end date
			if(isset($_POST['rdm_job_target_end_date_field_id'])){
				if($_POST['rdm_job_target_end_date_field_id']!=''){
					update_post_meta($postID,'rdm_job_target_end_date_field_id_timestamp',self::convert_human_date_to_unix($_POST['rdm_job_target_end_date_field_id']));
				}
			}			
			
			//end date
			if(isset($_POST['rdm_job_end_date_field_id'])){
				if($_POST['rdm_job_end_date_field_id']!=''){
					update_post_meta($postID,'rdm_job_end_date_field_id_timestamp',self::convert_human_date_to_unix($_POST['rdm_job_end_date_field_id']));
				}
			}
	
		}
	
	}
	


	/**
	 *  @brief Convert a date with format
	 *  
	 *  @param [in] $date 22-05-1981
	 *  @return unixtimestamp
	 *  
	 *  @details Details
	 */
	static function convert_human_date_to_unix($date){
		$converted_date = date_parse_from_format('d-m-Y', $date);
		$timestamp = mktime(0, 0, 0, $converted_date['month'], $converted_date['day'], $converted_date['year']);
		
		return $timestamp;
	}
	
}

//Start it all 
Rdm_Job_Management::get_instance();

$GLOBALS['kari'] = Rdm_Job_Management::get_instance();

//Options page helper class 
require_once('include/settings.options.class.php');

							
// After purchase has been submitted send an email to the admin
// see purchases.tables.metabox and submit.purchase files
include( plugin_dir_path(__FILE__) . 'include/submit.purchase.to.admin.php');
add_action('publish_rdm_purchase', 'rdm_after_purchase_created_notify_admin');

// After purchase has been submitted send an email to the selected supplier
// https://codex.wordpress.org/Plugin_API/Action_Reference/publish_post
include( plugin_dir_path(__FILE__) . 'include/submit.purchase.to.supplier.php');
add_action('publish_rdm_purchase', 'rdm_notify_supplier');