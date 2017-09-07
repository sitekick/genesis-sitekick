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
				 'post_status'  => 'publish'
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


class Service_Widget extends WP_Widget {
        
      
        public function __construct() {
              $widget_ops = array('classname' => 'service-widget', 'description' => 'Widget to display random service benefits with link to service page'); 
              parent::__construct('sitekick-services', __('Service Widget', 'genesis-sitekick'), $widget_ops);
        }

		public function update( $new_instance, $old_instance ) {
               
               $instance = $old_instance;
		
			   return $instance;
			   }

	    public function widget( $args, $instance ) {
               
             extract( $args );
              
              // Create and run custom loop
			 
			  $serviceArgs =  array(
				'post_type' => 'services', 
				'posts_per_page' => 1, 
				'orderby' => 'rand',
				'post_status'  => 'publish',
				'meta_key' => '_service_promote_key',
				'meta_value'  => 'true',
				); 
			  
			  $services = new WP_Query( $serviceArgs );
              
              $service = get_post($services->posts[0]);
             
              $postID = $service->ID;
              
			  $fields = get_post_meta($postID);
			  
              echo $before_widget;
			  $widget_title = !empty($fields['_service_benefit_key'][0]) ? $fields['_service_benefit_key'][0] : 'Standard benefit';
			  echo $before_title . $widget_title . $after_title;
			  
			 printf('<div class="widget-panels"><div class="panel image">%s</div><div class="panel copy"><h4>%s</h4><p>%s</p><a class="btn" href="/services">Learn more</a></div></div>',
				  get_the_post_thumbnail($postID,'thumbnail'),
				  get_the_title($postID),
				  get_the_excerpt($postID)
				  );
				  
			  wp_reset_postdata();
			   
			  echo $after_widget;

			  }

}

register_widget( 'Service_Widget' );
