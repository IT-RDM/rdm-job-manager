<?php 

/* SEND AN EMAIL AFTER POST PURHCASE HAS BEEN PUBLISHED */

function rdm_notify_supplier($ID, $post )  {    
    
        $user_email_address = $_POST['rdm_supplier_email'];
      
        // Purchase author
        $author = $post->post_author; /* Post author ID. */
        
        $title = $post->post_title;
        $permalink = get_permalink( $ID );
        $content    =   $post->post_content;
        $edit = get_edit_post_link( $ID, '' );
        
        // separate the users array    
        $send_to = $user_email_address;

        $subject = sprintf( 'RDM GREGG New Purchase order: %s'. $title );
        $message = sprintf ('Hi There, this is RDM Gregg Purchases department, please find attached our %s order  “%s”' . "\n\n" . $title, $content );
        $message .= sprintf( 'View: %s', $permalink );
        // create the from details 
        $headers[] = 'From: RDM <info@rdmgregg.co.uk>';
        // lets cc in the head just because we can 
        $headers[] = '';

        // The data of the purchase/pdf are stored on DB and are base64 encoded
        // So just get that data from DB , decode it using base64 , and you have the purchase data 

        // Add attachments to wp_mail from codex
        // $attachments = array( WP_CONTENT_DIR . '/uploads/file_to_attach.zip' ); 



        wp_mail($send_to, $subject, $message, $headers, $attachments );
        return $post_ID;
}