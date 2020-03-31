<?php 
/*
Plugin Name: white list comment domains
Plugin URI:  https://github.com/
Description: For stuff that's magical
Version:     1.0
Author:      Tom Woodward
Author URI:  http://bionicteaching.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: my-toolset

*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


add_filter( 'preprocess_comment', 'white_list_comment_domains' );

function white_list_comment_domains( $commentdata ){
  // filter...
  $ok_domains = array('vcu.edu','richmond.edu','fake.edu');//APPROVE DOMAINS GO HERE *************
  // write_log ($commentdata);
  $email = $commentdata['comment_author_email'];
  $comment_id = $commentdata['comment_post_ID'];
  $domain = substr(strrchr($email, "@"), 1);
  if (in_array($domain, $ok_domains, true)) {
    return $commentdata;
  } else {
     wp_die( __( '<strong>ERROR</strong>: please use an approved email domain.', 'textdomain' ) );
     return $commentdata;
  }
}



//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

