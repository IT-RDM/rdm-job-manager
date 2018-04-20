<?php  
/*
	* Email Purchase to Admin 
	*/
	function rdm_after_purchase_created_notify_admin($ID, $post) {
		// no action if post type is not 'rdm_purchase'
		/* if (get_post_type( $post_id ) != 'rdm_purchase') {
		
			return;
		} */
		
		//if is a revision do not send an email
		
		 /* if(wp_is_post_revision($post_id)) {
			
		return;
		}  */
		
		/* 
		if (get_post_status( $post_id ) != 'publish') { 
			return;
		} 
 */

		// Email headings 
		$author 		= $post->post_author; /* Post author ID. */
		$name 			= get_the_author_meta( 'display_name', $author );
        $email 			= get_the_author_meta( 'user_email', $author );
        $title 			= $post->post_title;
		$subject 		= sprintf( 'Purchase order: %s', $title . 'has been submitted. Contact details:' . $name, $email );
		$message		=	'Here is a copy of your purchase order' . '?Download PDF link?'; 
		$headers[]		=	'From: RDM Gregg purchases <info@rdmgregg.co.uk> ';
		$attachments	=	'';
		
		// Send email
        $to[] = sprintf( '%s <%s>', $name, $email );
		//$to   			=   get_option( 'admin_email' );
			wp_mail( $to, $subject, $message, $headers );
		
        }
