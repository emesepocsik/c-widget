<?php class My_Custom_Widget extends WP_Widget {
 
    public function __construct() {
		$widget_ops = array( 
		  'classname' => 'my_custom_widget',
		  'description' => 'Custom post type list widget',
		);
		parent::__construct( 'my_custom_widget', 'Custom post type', $widget_ops);
    }
 
	// Widget form backend 
	public function form( $instance ) {
		// Set widget defaults
		$defaults = array(
			'title'    => '',
            'subtitle' => '',
			'text'     => '',
			'textarea' => '',
			'checkbox' => '',
			'select'   => '',
            'column'   => '',
            'customclass'     => '',
            'button'     => '',
            'buttonurl'     => '',
		);
 
		extract(wp_parse_args((array) $instance, $defaults )); ?>
 
		<?php // Widget Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title', 'my-less-theme' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

        <?php // Widget Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php _e( 'Alcim', 'my-less-theme' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
		</p>

        <?php // Dropdown ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'select' ); ?>"><?php _e( 'Select', 'my-less-theme' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'select' ); ?>" id="<?php echo $this->get_field_id( 'select' ); ?>" class="widefat">
			<?php
            echo '<option value="">Válassz</option>';
            $args = array('public' => true, '_builtin' => false); //a WP core post typeokat nem akarjuk
            $post_types = get_post_types($args, 'names', 'and');
            foreach ( $post_types as $post_type ) {
                echo '<option value="'. $post_type .'" '. selected($select, $post_type, false) .'>' . $post_type . '</option>';
			}
                ?>
			</select>
		</p>

		<?php // Text ?>
            	<?php $hajok = get_posts(array( 'post_type' => $select, 'numberposts' => -1)); ?>
		          <?php $max = sizeof($hajok); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Hány postot lássunk?', 'my-less-theme' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="number" min ="1" max="<?php echo $max; ?>" value="<?php echo esc_attr( $text ); ?>" />
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'column' ) ); ?>"><?php _e( 'Oszlop:', 'my-less-theme' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'column' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column' ) ); ?>" type="number" min ="1" max="9" value="<?php echo esc_attr( $column ); ?>" />
        </p>
 
 
		<?php // Checkbox ?>
		<p>
			<input id="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>"><?php _e( 'Kép megjelenítés?', 'my-less-theme' ); ?></label>
		</p>
	   <?php // Text ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'customclass' ) ); ?>"><?php _e( 'Egyedi osztály:', 'my-less-theme' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'customclass' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'customclass' ) ); ?>" type="text" value="<?php echo esc_attr( $customclass ); ?>" />
		</p>
 
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button' ) ); ?>"><?php _e( 'Gomb felirat', 'my-less-theme' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button' ) ); ?>" type="text" value="<?php echo esc_attr( $button ); ?>" />
		</p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'buttonurl' ) ); ?>"><?php _e( 'Gomb hivatkozás', 'my-less-theme' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'buttonurl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'buttonurl' ) ); ?>" type="text" value="<?php echo esc_attr( $buttonurl ); ?>" />
		</p>
 
	<?php }
    
	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
        $instance['subtitle'] = isset( $new_instance['subtitle'] ) ? wp_strip_all_tags( $new_instance['subtitle'] ) : '';
		$instance['text'] = isset( $new_instance['text'] ) ? wp_strip_all_tags( $new_instance['text'] ) : '';
        $instance['column'] = isset( $new_instance['column'] ) ? wp_strip_all_tags( $new_instance['column'] ) : '';
		$instance['textarea'] = isset( $new_instance['textarea'] ) ? wp_kses_post( $new_instance['textarea'] ) : '';
		$instance['checkbox'] = isset( $new_instance['checkbox'] ) ? 1 : false;
		$instance['select'] = isset( $new_instance['select'] ) ? wp_strip_all_tags( $new_instance['select'] ) : '';
        $instance['customclass'] = isset( $new_instance['customclass'] ) ? wp_strip_all_tags( $new_instance['customclass'] ) : '';
        $instance['button'] = isset( $new_instance['button'] ) ? wp_strip_all_tags( $new_instance['button'] ) : '';
        $instance['buttonurl'] = isset( $new_instance['buttonurl'] ) ? wp_strip_all_tags( $new_instance['buttonurl'] ) : '';
		return $instance;
	}
    
	// Display the widget
	public function widget( $args, $instance ) {
		extract( $args );
		$title  = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
        $subtitle  = isset( $instance['subtitle'] ) ? $instance['subtitle'] : '';
		$text = isset( $instance['text'] ) ? $instance['text'] : '';
        $column = isset( $instance['column'] ) ? $instance['column'] : '';
		$textarea = isset( $instance['textarea'] ) ? $instance['textarea'] : '';
		$select = isset( $instance['select'] ) ? $instance['select'] : '';
		$checkbox = !empty( $instance['checkbox'] ) ? $instance['checkbox'] : false;
        $customclass = isset( $instance['customclass'] ) ? $instance['customclass'] : '';
         $button = isset( $instance['button'] ) ? $instance['button'] : '';
          $buttonurl = isset( $instance['buttonurl'] ) ? $instance['buttonurl'] : '';
 
		echo $before_widget;

        
         $args = array(
        'post_type' => $select, //ez a custom post type
        'order' => 'ASC',
        'numberposts' => $text
        );
        
        
        $posts = get_posts($args);
        
		echo '<div class="widget '.$customclass.' ">';
        
            // widget title
			if ( $subtitle ) {
				echo '<h3 class="align-center decor">' . $subtitle . '</h3>';
			}
			// widget title
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}
           
            //checkbox ha van kép
            if ($checkbox){
               echo '<div class="column-'. $column .' card">';
       
               foreach($posts as $post){
                   echo  '<div>';
                   echo '<a href="' . $post->post_name . '">';
                   echo get_the_post_thumbnail($post->ID);
                   echo '<h3>'.  $post->post_title .'</h3>';
                    echo  '</a>';
                    echo  '</div>';
               }
            echo  '</div>';
            } else {
                 echo  '<ul>';
                   foreach($posts as $post){
                       echo  '<li>';
                        echo '<a href="' . $post->post_name . '">';
                        echo $post->post_title;
                       echo  '</a>';
                       echo  '</li>';
                   }
                 echo  '</ul>';
            }

        	
			if ( $button ) {
				echo '<p class="align-center"><a class="button" href="'. $buttonurl .'">'. $button .'</a></p>';
			}
        
        echo  '</div>';
        
   
		echo $after_widget;
	}
}
 
// Register the widget
function my_register_custom_widget() {
	register_widget( 'My_Custom_Widget' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );
?>
