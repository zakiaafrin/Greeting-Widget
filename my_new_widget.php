<?php
/*
Plugin Name: Greetings Widget
Plugin URI: http://wordpress.org/extend/plugins/#
Description: This is a new greeting widget plugin
Author: Zakia Afrin Jeme
Version: 1.0.0
Author URI: http://zjeme@techlaunch.io
*/

//Register the Widget
add_action('widgets_init', function(){
    register_widget( 'My_New_Widget' );
 });

class My_New_Widget extends WP_Widget {
// class constructor
  public function __construct() {
    $widget_options = array( 
      'classname' => 'my_new_widget',
      'description' => 'This is a new Widget example for WP class',
    );
    parent::__construct( 'my_new_widget', 'Greetings Widget', $widget_options );
  }

// output the widget content on the front end
public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance[ 'title' ] );
    $blog_title = get_bloginfo( 'name' );
    $tagline = get_bloginfo( 'description' );
    echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; 
    $messages = array("Hi, I'm Zakia. This is my new widget." => "1", "I want to make things that make a difference." => "2", "I make things that look good." => "3", "I love designing and building creative, functional websites." => "4");
   
      "<p>" . print_r(array_rand($messages,1)) . "</p>";
   echo $args['after_widget'];
  }
  
// output the option form in admin Widges screen
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
  <p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
  <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>"
    value="<?php echo esc_attr( $title ); ?>" />
  </p>
  <?php 
  }

   // save options
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
    return $instance;
  }
}