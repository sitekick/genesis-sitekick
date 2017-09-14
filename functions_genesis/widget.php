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


class Profile_Widget extends WP_Widget {

	/**
	 * Sets up a new Text widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_profile',
			'description' => __( 'Author bio and gravatar image.' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 400, 'height' => 350 );
		parent::__construct( 'profile', __( 'User profile' ), $widget_ops, $control_ops );
	}

	
	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$widget_profile = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$userId = ! empty( $instance['user'] ) ? $instance['user'] : 0;
		
		/**
		 * Filters the content of the Text widget.
		 *
		 * @since 2.3.0
		 * @since 4.4.0 Added the `$this` parameter.
		 *
		 * @param string         $widget_text The widget content.
		 * @param array          $instance    Array of settings for the current widget.
		 * @param WP_Widget_Text $this        Current Text widget instance.
		 */
		$text = apply_filters( 'widget_profile', $widget_profile, $instance, $this );
		
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
			<div class="profile">
				<div class="gravatar"><?php echo get_avatar($userId, 115); ?></div>
				<div class="bio"><?php echo $text; ?></div>
			</div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Text widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = wp_kses_post( $new_instance['text'] );
		}
		$instance['user'] = $new_instance['user'] ;
		
		return $instance;
		
		
	}

	/**
	 * Outputs the Text widget settings form.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'user' => 0) );
		$title = sanitize_text_field( $instance['title'] );
		$userID = isset( $instance['user'] ) ? $instance['user'] : 0;
		
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e( 'User:' ); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>">
		<?php
		$users = get_users();
		
		foreach($users as $user){
			
			printf('<option value="%s" %s>%s</option>',
			 $user->ID,
			 $user->ID == $userID ? ' selected' : '',
			 $user->display_name
			);
		}
		?>
		</select></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Bio:' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

		<?php
	}
}

register_widget( 'Profile_Widget' );
