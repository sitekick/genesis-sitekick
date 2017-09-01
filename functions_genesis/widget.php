<?php
	
	
add_filter('wp_generate_tag_cloud', 'xf_tag_cloud',10,3);

function xf_tag_cloud($tag_string){
   return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}

class Quotes_Widget extends WP_Widget {
        
      
        public function __construct() {
              $widget_ops = array('classname' => 'quotes-widget', 'description' => 'Widget to display random quote based on page category'); 
              parent::__construct('sitekick-quotes', __('Quotes Widget', 'genesis-sitekick'), $widget_ops);
        }

		public function update( $new_instance, $old_instance ) {
               
               $instance = $old_instance;
		
			   return $instance;
			   }

	    public function widget( $args, $instance ) {
               
              extract( $args );
              
              echo $before_widget;
			   
			  //echo $before_title . 'Quote' . $after_title;
			  
			  echo '<div class="widget-quote">';
		
			  // Create and run custom loop
			 $args = array(
				 'post_type' => 'quotes', 
				 'posts_per_page' => 1, 
				 'orderby' => 'rand',
			 );
			 
			  $quotes = new WP_Query( $args );
			 
			  while ( $quotes->have_posts() ) : $quotes->the_post();
				  $qName = get_post_meta( get_the_ID(), '_quote_source_name_key', true );
				  $qCompany = get_post_meta( get_the_ID(), '_quote_source_company_key', true );
				  $qLink = get_post_meta( get_the_ID(), '_quote_source_link_key', true );
				  
				  $op =  '<div class="quote">';
				  $op .= '<div class="quote-body">' . the_title('<q>','</q>', false) . '</div>';
				  $op .= '<div class="quote-footer">'; 
				  $op .=  !empty($qName) ? '<h5>' . $qName . '</h5>' : '';
				  $op .=  !empty($qCompany) ? '<h6>' . $qCompany . '</h6>' : '';
				  $op .=  !empty($qLink) ? '<a href="'. $qLink . '" target="_blank">Cite</a>' : '';
				  $op .= '</div></div>';
				  
				  print $op;
			  
			  endwhile;
			  
			 
			  
			  wp_reset_postdata();
			   
			  echo $after_widget;

			  }

}

register_widget( 'Quotes_Widget' );
