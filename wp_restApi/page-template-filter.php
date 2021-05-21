<?php
//Function for overriding Page Template when in <base>/katana

 function katana_page_template( $page_template ) {
   if ( is_page( 'katana' ) && get_permalink() == home_url() . '/katana/') {
     $page_template = dirname( __FILE__ ) . '/custom-template/page-katana.php';
   }
   return $page_template;
 }
