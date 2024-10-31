<?php
/*
Plugin Name: Royal Seal Ent Radio
Plugin URI: https://royalsealent.com/radioplugin/blackControllers_withPlaylist_ex2.html
Description: This plugin will add a WRSE Radio Player on your website, by using this shortcode [wrse].
Author: Eric Deshawn Pettway
Author URI: https://royalsealent.com
Version: 1.0
*/

/*-- Shortcode For WRSE Radio --*/

function wrse_source( $atts ){
?>
<iframe src="https://royalsealent.com/radioplugin/popup.html" name="wrseradio" scrolling="no" frameborder="no" align="center" height = "180px" width = "100%">
</iframe>
<?php
}
add_shortcode('wrse', 'wrse_source');
add_filter('widget_text', 'do_shortcode');


/*-- Widget For WRSE Radio Player --*/
class wrseradiowidget extends WP_Widget
{
  function wrseradiowidget()
  {
    $widget_ops = array('classname' => 'wrseradiowidget', 'description' => 'WRSE Radio Player Widget.' );
    $this->WP_Widget('wrseradiowidget', 'WRSE Radio', $widget_ops);
  }
 
  function form($instance) 
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    //echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
    echo $before_title . $title . $after_title;;
 
    // WIDGET CODE
  ?>
<iframe src="https://royalsealent.com/radioplugin/popup.html" name="wrseradio" scrolling="no" frameborder="no" align="center" height = "180px" width = "100%">
</iframe>
 <?php
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("wrseradiowidget");') );
?>