<?php
class Rdm_Jobs_Order_Helpers{

	/*
	* Returns a list of orders associated with client ... Used on extra columns and inside client CPT
	*/
	public static function get_orders_for_client_extra_columns($clientid,$return_or_show='return'){
	
		if($clientid && ( $clientid > 0)){
			//echo $clientid;
			
			$ordersAssociateWithClient = __('No Orders','rdm-job-manager');

			//get all orders for this client
			$get_orders_for_clients_params =array(
				'showposts'=>-1,
				'post_type' => 'shop_order',
				'post_status' => array('wc-processing','wc-on-hold','wc-pending','wc-complete'),
				'meta_key'=>'rdm_jobs_orders_shop_order_field_id',
				'meta_value'=> $clientid
			);
			$query_orders_for_client = new WP_Query();
			$results_orders_for_client = $query_orders_for_client->query($get_orders_for_clients_params);

			
			//if we have at least one order for this client
			if(sizeof($results_orders_for_client)>=1){
			
				$ordersAssociateWithClient='';
			
				foreach($results_orders_for_client as $single_order_for_client){
					
					//Order edit link
					$ordersAssociateWithClient.= '<a href="post.php?post='.$single_order_for_client->ID .'&action=edit">'. $single_order_for_client->post_title .'</a>';
					
					//Order Status
					if(get_post_meta($single_order_for_client->ID , '_rdm_order_notes', true)){
					
						$orderStatus = get_post_meta($single_order_for_client->ID , '_rdm_order_notes', true);

						$orderStatusToDisplay = (isset($orderStatus['status'])) ? ucfirst($orderStatus['status']) : 'Not set';
					}
					
					$ordersAssociateWithClient.= ' ' . $orderStatusToDisplay ;
					$ordersAssociateWithClient.= '<br>';
				} //end foreach
			
				
				return $ordersAssociateWithClient;
			
			} else {
				
				//existing client but no orders associated with him
				return apply_filters('rdm_no_orders_for_this_client',$ordersAssociateWithClient ,'no_orders_found');
			}

		}
		
		return false;
	}
	
	
	/*
	* Returns order total value
	*/
	public static function calculate_total($order_id , $actualTotal ,$returnNewValueOrDiscount='newvalue'){

		$order_id = (int) $order_id;
		
		$order_meta = get_post_meta($order_id,'_order_discount_and_vat',true);

		//if we have i.e subtotal set ... it means we are good to go
		if(!isset($order_meta['order_subtotal'])){
			return false;
		}

		$discountValueEntered = $order_meta['discountValue'];
		$discountTypeEntered  = $order_meta['discountType'];
		
		if( $discountValueEntered &&  $discountTypeEntered != 'none' ){
			
			if($discountTypeEntered=='percent'){
				//check so discounted value isnt lower than 0
				
				$valueAfterDiscount = $actualTotal - ( $actualTotal * $discountValueEntered/100 );

				if( $valueAfterDiscount > 0 ){
					
					if($returnNewValueOrDiscount=='newvalue'){
						$value_to_return =  $valueAfterDiscount;
					}else{
						$value_to_return =  $discountValueEntered ;
					}
				}

			}
			
			if($discountTypeEntered=='amount'){

				//check so discounted value isnt lower than 0
				if( $actualTotal - $discountValueEntered > 0 ){

					if($returnNewValueOrDiscount=='newvalue'){
						$toreturn  = $actualTotal - $discountValueEntered;

						$value_to_return =   $toreturn;
					}else{
						$value_to_return =  $discountValueEntered  ;
					}
				}
				
			}
			
			if(isset($order_meta['vat'])){
				if($order_meta['vat']>0){
					return number_format ($value_to_return  +   ($value_to_return * $order_meta['vat']/100),2) ;
				}else{
					return number_format($value_to_return,2);
					
				}
			}
			
			//return $value_to_return 
			
		}else{
			if(isset($order_meta['vat'])){
				if($order_meta['vat']>0){
					return number_format ($actualTotal  +   ($actualTotal * $order_meta['vat']/100),2) ;
				}else{
					return number_format($actualTotal,2);
				}
			}
		}
	}
	
	
	/*
	* Calculate new value after discount,vat 
	*/
	public static function calculateDiscount($order_id , $actualTotal ,$returnNewValueOrDiscount='newvalue'){

		$order_id = (int) $order_id;
		
		$order_meta = get_post_meta($order_id,'_order_discount_and_vat',true);
	
		//if we have i.e subtotal set ... it means we are good to go
		if(!isset($order_meta['order_subtotal'])){
			return false;
		}
	
		$discountValueEntered = $order_meta['discountValue'];
		$discountTypeEntered  = $order_meta['discountType'];
		
		if( $discountValueEntered &&  $discountTypeEntered != 'none' ){
			
			if($discountTypeEntered=='percent'){
				//check so discounted value isnt lower than 0
				
				$valueAfterDiscount = $actualTotal - ( $actualTotal * $discountValueEntered/100 );

				if( $valueAfterDiscount > 0 ){
					
					if($returnNewValueOrDiscount=='newvalue'){
						return $valueAfterDiscount;
					}else{
						return $discountValueEntered ;
					}
				}
				
				return false;		
			}
			
			if($discountTypeEntered=='amount'){

				//check so discounted value isnt lower than 0
				if( $actualTotal - $discountValueEntered > 0 ){

					if($returnNewValueOrDiscount=='newvalue'){
						 $toreturn  = $actualTotal - $discountValueEntered;

						return  $toreturn;
					}else{
						return $discountValueEntered + ' ' ;
					}
				}
				return false;
			}
			
		}else{
			return false;
		}
	}	

	
	
	/*
	* Return number of all orders by default , OPTIONS is array of additional WP_QUERY params
	*/
	
	static function get_all($options=array()){
	
		$query = array('posts_per_page' => -1, 'post_type' => 'shop_order');
		
		if (isset($options['args']) ) {
			$query = array_merge($query,(array)$options['args']);
		}

	
		//get all orders
		$query_all = new WP_Query();
		$results_all = $query_all->query($query);
		
		return sizeof($results_all) ;
	}
	
	
	/*
	* Return number of paid orders
	*/
	static function get_paid(){
	
		$paidOrdersCount = 0;
	
		
		$get_orders_params =array(
			'showposts'=>-1,
			'post_type' => 'shop_order',
			'post_status' => 'publish',
		);
		$query_orders = new WP_Query();
		$results_orders = $query_orders->query($get_orders_params);

		
		//if we have at least one order
		if(sizeof($results_orders)>=1){
		
			foreach($results_orders as $single_order){
				
				//Order Status
				if(get_post_meta($single_order->ID , '_rdm_order_notes', true)){
					$orderStatus = get_post_meta($single_order->ID , '_rdm_order_notes', true);
					//print_r($orderStatus);
					//die();
					if(isset($orderStatus)){
						if($orderStatus['status']=='paid'){
							$paidOrdersCount++;
						}
					}
				}

			} //end foreach

		} //end sizeof
		
		return $paidOrdersCount;
		
	}		
	
	/*
	* Returns % of paid orders 
	*/
	static function get_paid_orders_percent(){
		
		if(self::get_all() <= 0 ){
			return 0;
		}
		
		return ( self::get_paid() / self::get_all() );
	}
	
	
	/*
	* Get the price amount of paid orders
	*/
	
	static function get_orders_amount_by_status($status){
		
		$total_amount = 0;
	
		//get all paid orders
		$get_orders_params =array(
			'showposts'=>-1,
			'post_type' => 'shop_order',
			'post_status' => 'publish',
		);
		$query_orders = new WP_Query();
		$results_orders = $query_orders->query($get_orders_params);
		
		//if we have at least one order
		if(sizeof($results_orders)>=1){
		
			foreach($results_orders as $single_order){
				
				if(self::get_order_notes_value_by_order_id($single_order->ID,'status')==$status){
				
					$order_subtotal = self::get_order_discount_and_value_by_order_id($single_order->ID,'order_subtotal');
					if($order_subtotal>0){
						$total_amount+=  $order_subtotal;
					}
				
				}

			} 

		} //end sizeof
		
		return $total_amount;		
		
	}

	
	/*
	* Get order meta value by order ID
	*/
	static function get_order_meta_value_by_order_id($id,$meta=''){
		
		if($id=='' || $meta == ''){
			return __('Not Set','rdm-job-manager');	
		}

		$meta_value = get_post_meta($id,$meta,true);
		
		if($meta_value=='not_set'){
			return __('Not Set','rdm-job-manager');
		}
		
		
		return ($meta_value) ? $meta_value : __('Not Set','rdm-job-manager');
		
	}
	
	/*
	* Get order notes
	*/
	static function get_order_notes_value_by_order_id($id,$meta=''){
		
		if($id=='' || $meta == ''){
			return __('Not Set','rdm-job-manager');
		}
		
		$value_to_return = __('Not Set','rdm-job-manager');

		$meta_value_array = get_post_meta($id,'_rdm_order_notes',true);
		
		if(isset($meta_value_array)){
			if(isset($meta_value_array[$meta])){
				if($meta_value_array[$meta]=='not_set'){
					return $value_to_return;
				}
				$value_to_return = $meta_value_array[$meta];
			}
		}
		return $value_to_return;
		
	}	
	
	/*
	* Get order price/vat/amount
	*/
	static function get_order_discount_and_value_by_order_id($id,$meta=''){
		
		if($id=='' || $meta == ''){
			return __('Not Set','rdm-job-manager');
		}
		
		$value_to_return = __('Not Set','rdm-job-manager');

		$meta_value_array = get_post_meta($id,'_order_discount_and_vat',true);
		
		if(isset($meta_value_array)){
			if(isset($meta_value_array[$meta])){
				if($meta_value_array[$meta]=='not_set'){
					return $value_to_return;
				}
				$value_to_return = $meta_value_array[$meta];
			}
		}
		return $value_to_return;
		
	}		
	
	
	/*
	* Get orders by status ... completed , ongoing , hold
	*/
	static function get_by_status($status){
	
		switch ($status){
		
			case 'unpaid':
				$which_status = 'unpaid';
				break;
				
			case 'paid':
				$which_status = 'paid';
				break;
				
			case 'overdue':
				$which_status = 'overdue';
				break;
				
			case 'cancelled':
				$which_status = 'cancelled';
				break;					

			default :
				$which_status = 'paid';				
				
		}
	

	
		$ordersFound = 0;
	
		//get all orders
		$get_orders_params =array(
			'showposts'=>-1,
			'post_type' => 'shop_order',
			'post_status' => 'publish',
		);
		$query_orders = new WP_Query();
		$results_orders = $query_orders->query($get_orders_params);

		
		//if we have at least one order
		if(sizeof($results_orders)>=1){
		
			foreach($results_orders as $single_order){
				
				//Order Status
				if(get_post_meta($single_order->ID , '_rdm_order_notes', true)){
					$orderStatus = get_post_meta($single_order->ID , '_rdm_order_notes', true);
					if(isset($orderStatus)){
						if($orderStatus['status']==$which_status){
							$ordersFound++;
						}
					}
				}

			} //end foreach

		} //end sizeof
		
		return $ordersFound;	

	}	
	
	
	/*
	* Lists possible order payment status as dropdown
	*/
	
	static function dropdown_paid_status(){
	
		$selected ='';
	
		//check if we have a status selected 
		if(isset($_POST['rdm_order_status_for_report_page']) && $_POST['rdm_order_status_for_report_page']){
			$selected = $_POST['rdm_order_status_for_report_page'];
		}
		
		?><select  name="rdm_order_status_for_report_page">
			<option value=""><?php echo __('All','rdm-job-manager');?></option>
			<option value="unpaid" <?php echo ($selected == 'unpaid') ? ' selected = "selected" ' : ''; ?>><?php echo __('Unpaid','rdm-job-manager') ?></option>
			<option value="paid" <?php echo ($selected == 'paid') ? ' selected = "selected" ' : ''; ?>><?php echo __('Paid','rdm-job-manager') ?></option>
			<option value="overdue" <?php echo ($selected == 'overdue') ? ' selected = "selected" ' : ''; ?>><?php echo __('Overdue','rdm-job-manager') ?></option>
			<option value="cancelled" <?php echo ($selected == 'cancelled') ? ' selected = "selected" ' : ''; ?>><?php echo __('Cancelled','rdm-job-manager') ?></option>
		</select>
		
		<?php
	}		
	
	/*
	* Create INPUT FIELD
	*/
	static function create_input($input_name,$placeholder=''){
		
		$selected_value ='';
		
		//check if we have a value set for the field
		if(isset($_POST[$input_name]) && $_POST[$input_name]!=''){
			$selected_value = $_POST[$input_name];
		}	

		echo '<input type="text" name="'.$input_name.'" placeholder="'.$placeholder.'" value="'.$selected_value.'">';
		
	}	
	
	
	/*
	*  REPORT SECTION BEGINS
	*/
	
	static function get_results_for_report(){
	
	
		if(sizeof($_POST)<1 ){
			return;
		}	
		
		//default args to return all orders
		$default_args = array(
			'showposts'=>-1,
			'post_type' => 'shop_order',
			'post_status' => 'publish',		
			
			'meta_query' => array(
				'relation' => 'AND',
			)
			
		);			


		//check if client is set
		if(isset($_POST['rdm_jobs_reports_JobTab_clients_list']) && $_POST['rdm_jobs_reports_JobTab_clients_list']>0){

			$prep_client = array(
							'key' => 'rdm_jobs_orders_client_field_id' , 
							'value' => $_POST['rdm_jobs_reports_JobTab_clients_list'] , 
							'compare' => '='
							); 

			array_push( $default_args['meta_query'], $prep_client);
			
		}		
		
		
		//check if job is set
		if(isset($_POST['rdm_jobs_orders_Job_field_id']) && $_POST['rdm_jobs_orders_Job_field_id']>0){

			$prep_Job = array(
							'key' => 'rdm_jobs_orders_Job_field_id' , 
							'value' => $_POST['rdm_jobs_orders_Job_field_id'] , 
							'compare' => '='
							); 

			array_push( $default_args['meta_query'], $prep_Job);
			
		}		
		
		//check if status
		if(isset($_POST['rdm_order_status_for_report_page']) && $_POST['rdm_order_status_for_report_page']!=''){

			$prep_status = array(
							'key' => '_rdm_order_notes' , 
							'value' => serialize(strval($_POST['rdm_order_status_for_report_page'])) , 
							'compare' => 'LIKE'
							); 

			array_push( $default_args['meta_query'], $prep_status);
			
		}			
		
		
		//get all orders
		$query_all_orders = new WP_Query();
		$results_all_orders = $query_all_orders->query($default_args);			
		$orders_found = sizeof($results_all_orders) ; 	 
	 
		
	 
		echo  apply_filters('rdm_reports_orders_page_found_orders_title' , sprintf( _n( '<h3>Found  %s order </h3>', '<h3>Found  %s orders </h3>', $orders_found, 'rdm-job-manager' ), $orders_found ));
		
		
		//if we have at least one order ... show the table
		if( $orders_found >=1 ){
			
			?>
			<div style="color:red;padding: 20px;">
			
			<table class="wp-list-table widefat fixed posts">
				<thead>
					<tr>
	
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('Title','rdm-job-manager') ?></strong></span></a>
						</th>		
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('Status','rdm-job-manager') ?></strong></span></a>
						</th>	
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('Amount','rdm-job-manager') ?></strong></span></a>
						</th>							
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('To be paid by','rdm-job-manager') ?></strong></span></a>
						</th>	
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('Paid on','rdm-job-manager') ?></strong></span></a>
						</th>							
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('Client','rdm-job-manager') ?></strong></span></a>
						</th>		
									
						
					</tr>
				</thead>
				<tfoot>
					<tr>
	
						<th scope="col"  class="manage-column column-title sortable desc" style="width: 3em;">
							<a ><span><strong><?php echo __('Title','rdm-job-manager') ?></strong></span></a>
						</th>		
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('Status','rdm-job-manager') ?></strong></span></a>
						</th>	
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('Amount','rdm-job-manager') ?></strong></span></a>
						</th>						
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('To be paid by','rdm-job-manager') ?></strong></span></a>
						</th>		
						<th scope="col"  class="check-column manage-column column-title sortable desc " style="padding-top:0px;width: 3em;">
							<a ><span><strong><?php echo __('Paid on','rdm-job-manager') ?></strong></span></a>
						</th>							
						<th scope="col"  class="manage-column column-title sortable desc" style="width: 3em;">
							<a ><span><strong><?php echo __('Client','rdm-job-manager') ?></strong></span></a>
						</th>	
							
			

					</tr>
				</tfoot>	
				<tbody id="the-list">	
	
			<?php
			
			$row_counter = 0;
			$color = '';
			
			foreach ($results_all_orders as $single_order){ 
				
				if($row_counter%2==0){
					$color='alternate';
				}else{
					$color='';
				}
			
				?>
				
				<tr class=" hentry  iedit <?php echo $color ;?> widefat">
				
					
					<td class="check-column" style="padding:9px 0px 8px 10px;">
						<a href="<?php echo get_edit_post_link($single_order->ID);?>"><strong><?php echo $single_order->post_title ;?></strong></a>
					</td>	
					
					<td class="check-column" style="padding:9px 0px 8px 10px;">
						<?php echo ucwords(self::get_order_notes_value_by_order_id($single_order->ID,'status'));?>
					</td>
					<td class="check-column" style="padding:9px 0px 8px 10px;">
						<?php 
						$order_subtotal = self::get_order_discount_and_value_by_order_id($single_order->ID,'order_subtotal');
						if($order_subtotal>0){
							//($order_id , $actualTotal ,$returnNewValueOrDiscount='newvalue'){
							echo self::calculate_total($single_order->ID,$order_subtotal);
						}
						?>
					</td>					
					<td class="check-column" style="padding:9px 0px 8px 10px;">
						<?php echo self::get_order_notes_value_by_order_id($single_order->ID,'toBePaidOn');?>
					</td>	
					<td class="check-column" style="padding:9px 0px 8px 10px;">
						<?php echo self::get_order_notes_value_by_order_id($single_order->ID,'paidOn');?>
					</td>					
					<td class="check-column" style="padding:9px 0px 8px 10px;">
						<?php 
							$client_id_for_order = self::get_order_meta_value_by_order_id($single_order->ID,'rdm_jobs_orders_client_field_id');
							
							if($client_id_for_order>0){
							echo '<a href="'.get_edit_post_link($client_id_for_order).'">'.get_the_title($client_id_for_order).'</a>';
						}?>
					</td>	

				
					
				</tr>
				
				<?php
				
				$row_counter++ ; 
				
			} //end foreach
			
			?>
			
					</tbody>
				</table>	
			</div>
			
			<?php
		}				
	 
	 
	}
	
	/*
	*  REPORT SECTION ENDS
	*/
	
	

} //end class