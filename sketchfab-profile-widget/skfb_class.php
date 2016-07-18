<?php

/**
 * Sketchfab Widget Class
 */
class sketchfab_widget extends WP_Widget {

    /** constructor */
    function __construct() {
        parent::__construct(
                'skfb_id', __('Sketchfab Profile Widget', 'sketchfab-profile-widget')
        );
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {

        global $app_id;
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $app_id = $instance['app_id'];
        $skfb_user = $instance['skfb_user'];
        $width = $instance['width'];
        $height = $instance['height'];
        $data_small_header = isset($instance['data_small_header']) && $instance['data_small_header'] != '' ? 'true' : 'false';
        $data_adapt_container_width = isset($instance['data_adapt_container_width']) && $instance['data_adapt_container_width'] != '' ? 'true' : 'false';
        $data_hide_cover = isset($instance['data_hide_cover']) && $instance['data_hide_cover'] != '' ? 'true' : 'false';
        $data_show_facepile = isset($instance['data_show_facepile']) && $instance['data_show_facepile'] != '' ? 'true' : 'false';
        $data_show_models = isset($instance['data_show_models']) && $instance['data_show_models'] != '' ? 'true' : 'false';
        $custom_css = $instance['custom_css'];
        
add_filter( 'https_ssl_verify', '__return_false' );

$json = file_get_contents( 'https://api.sketchfab.com/v2/users?username=' . $skfb_user . '' );

$decode = json_decode($json, true);
       
$sketchfabs = $decode['results'];
$sketchfab_uid = $sketchfabs[0]['uid'];
$sketchfab_displayName = $sketchfabs[0]['displayName'];
$sketchfab_profileUrl = $sketchfabs[0]['profileUrl'];
$sketchfab_modelCount = $sketchfabs[0]['modelCount'];
$sketchfab_modelsUrl = $sketchfabs[0]['modelsUrl'];
$sketchfab_collectionCount = $sketchfabs[0]['collectionCount'];
$sketchfab_collectionsUrl = $sketchfabs[0]['collectionsUrl'];
$sketchfab_likeCount = $sketchfabs[0]['likeCount'];
$sketchfab_likesUrl = $sketchfabs[0]['likesUrl'];
$sketchfab_followingCount = $sketchfabs[0]['followingCount'];
$sketchfab_followingsUrl = $sketchfabs[0]['followingsUrl'];
$sketchfab_followerCount = $sketchfabs[0]['followerCount'];
$sketchfab_followersUrl = $sketchfabs[0]['followersUrl'];
$sketchfab_account = $sketchfabs[0]['account'];
$sketchfab_avatars = array ( $sketchfabs[0]['avatars'] );
$sketchfab_images = $sketchfab_avatars[0]['images'] ;
$sketchfab_imageurl = array ( $sketchfab_images[3]['url']);

      echo $args['before_widget'];
     
        if ($title)
            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
    echo '<ul class="sketchfab-widget">'; 

        echo '<div style="width:100%; height: 100%" class="sketchfab-widget" data-small-header="' . $data_small_header . '" data-adapt-container-width="' . $data_adapt_container_width . '" data-hide-cover="' . $data_hide_cover . '" data-show-facepile="' . $data_show_facepile . '" data-show-models="' . $data_show_models . '" style="' . $custom_css . '">
<div>
<a href="#"><img style="width:130px" src="https://d2f25wgezub9nf.cloudfront.net/builds/web/dist/sketchfab-logo-8bc6696c7ed7369e1acaee4ec5168169.png"></a> <a href="#">View Profile</a>
</div>
<a href="' . $sketchfab_profileUrl . '" target="_blank" title="' . $sketchfab_displayName . ' on Sketchfab">
<img src="' .  $sketchfab_images[0]['url'] . '" alt="' . $sketchfab_displayName . '" class="avatar" style="width:70px; border-radius: 4px; box-shadow: 0 1px 1px rgba(0,0,0,.3); margin-right: 15px; float: left">
<span style="font-size:19px; font-weight:600; line-height: 20px;display: inline-block;"><span style="float:left;">
' . $sketchfab_displayName . '</span>
';
if ( $sketchfab_account == 'pro' )
echo '<div style="align-items: center;margin-top: auto;margin-bottom: auto;margin-left: 10px;-webkit-box-flex: 0;padding: 1px 6px;font-size: 11px;border-radius: 4px; font-weight: 600; text-transform: uppercase; line-height: 16px; background: #1caad9; width: 21px; float: left;color: white">PRO</div>';

echo '</span></a><br />
        <a href="' . $sketchfab_modelsUrl . '" target="_blank" style="width: 90px;display: inline-block;float:left"><strong>' . $sketchfab_modelCount . '</strong> models</a>
        <a href="' . $sketchfab_followingsUrl . '" style="width: 100px; display:inline-block; float:left" target="_blank"><strong>' . $sketchfab_followingCount . '</strong> followings</a>
        <a href="' . $sketchfab_collectionsUrl . '" style="width: 90px; display:inline-block; float:left" target="_blank"><strong>' . $sketchfab_collectionCount . '</strong> collections</a>
        <a href="' . $sketchfab_followersUrl . '" style="width: 100px; display:inline-block; float:left target="_blank"><strong>' . $sketchfab_followerCount . '</strong> followers</a><br />
<a href="#" style="color: #555!important;
    background-color: #e7e7e7;
    height: 36px;
    line-height: 34px;
    position: relative;
    border: 2px solid transparent;
    border-radius: 4px;
    padding: 5px 20px;
    font-family: sans-serif;
    font-size: .9em;
    font-weight: 600;
    text-align: center;
    text-shadow: none;
    text-transform: uppercase;
    cursor: pointer;
    outline: none;
    -webkit-transition: background .2s;
    transition: background .2s;">View profile</a>
<p style="display: none; color:#7a7a7a;font-size:0.90em;text-align:right;border-top: 1px solid #ccc;margin-top: 10px;line-height: 14px;position: relative;">powered by <a style="color: #3a3a3a" href="https://sketchfab.com" target="_blank">Sketchfab</a></p>
<br />
        </div>';
        echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance = array('data_small_header' => 'false', 'data_adapt_container_width' => 'false', 'data_hide_cover' => 'false', 'data_show_facepile' => 'false', 'data_show_models' => 'true');
        foreach ($instance as $field => $val) {
            if (isset($new_instance[$field]))
                $instance[$field] = 'true';
        }
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['app_id'] = strip_tags($new_instance['app_id']);
        $instance['skfb_user'] = strip_tags($new_instance['skfb_user']);
        $instance['width'] = strip_tags($new_instance['width']);
        $instance['height'] = strip_tags($new_instance['height']);
        $instance['data_small_header'] = strip_tags($new_instance['data_small_header']);
        $instance['data_adapt_container_width'] = strip_tags($new_instance['data_adapt_container_width']);
        $instance['data_hide_cover'] = strip_tags($new_instance['data_hide_cover']);
        $instance['data_show_facepile'] = strip_tags($new_instance['data_show_facepile']);
        $instance['data_show_models'] = strip_tags($new_instance['data_show_models']);
        $instance['custom_css'] = strip_tags($new_instance['custom_css']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {

        /**
         * Set Default Value for widget form
         */
        $defaults = array('title' => 'Follow me on Sketchfab', 'app_id' => '', 'skfb_user' => 'guillermosainz', 'width' => '250px', 'height' => '350', 'data_small_header' => 'false', 'data_small_header' => 'false', 'data_adapt_container_width' => 'false', 'data_hide_cover' => 'false', 'data_show_facepile' => 'on', 'data_show_models' => 'true', 'custom_css' => '');
        $instance = wp_parse_args((array) $instance, $defaults);
        $title = esc_attr($instance['title']);
        $app_id = isset($instance['app_id']) ? esc_attr($instance['app_id']) : "";
        $skfb_user = isset($instance['skfb_user']) ? esc_attr($instance['skfb_user']) : "guillermosainz";
        $width = esc_attr($instance['width']);
        $height = esc_attr($instance['height']);
        $data_adapt_container_width = esc_attr($instance['data_adapt_container_width']);
        $data_hide_cover = esc_attr($instance['data_hide_cover']);
        $data_show_facepile = esc_attr($instance['data_show_facepile']);
        $data_show_models = esc_attr($instance['data_show_models']);
        $custom_css = isset($instance['custom_css']) ? esc_attr($instance['custom_css']) : "";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'sketchfab-profile-widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('skfb_user'); ?>"><?php _e('Sketchfab username:', 'sketchfab-profile-widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('skfb_user'); ?>" name="<?php echo $this->get_field_name('skfb_user'); ?>" type="text" value="<?php echo $skfb_user; ?>" />
        </p>
        <p style="display:none">
            <label for="<?php echo $this->get_field_id('app_id'); ?>"><?php _e('Sketchfab API token:', 'sketchfab-profile-widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('app_id'); ?>" name="<?php echo $this->get_field_name('app_id'); ?>" type="text" value="<?php echo $app_id ?>" />
            <small>
                <?php _e('You can get it in'); ?>
                <a href="https://sketchfab.com/settings/password" target="_blank">
                    <?php _e('Your Settings'); ?>
                </a>
            </small>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['data_show_models'], "on") ?> id="<?php echo $this->get_field_id('data_show_models'); ?>" name="<?php echo $this->get_field_name('data_show_models'); ?>" />
            <label for="<?php echo $this->get_field_id('data_show_models'); ?>"><?php _e('Show last model info (soon!)', 'sketchfab-profile-widget'); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['data_hide_cover'], "on") ?> id="<?php echo $this->get_field_id('data_hide_cover'); ?>" name="<?php echo $this->get_field_name('data_hide_cover'); ?>" />
            <label for="<?php echo $this->get_field_id('data_hide_cover'); ?>"><?php _e('Hide widget Title', 'sketchfab-profile-widget'); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['data_show_facepile'], "on") ?> id="<?php echo $this->get_field_id('data_show_facepile'); ?>" name="<?php echo $this->get_field_name('data_show_facepile'); ?>" />
            <label for="<?php echo $this->get_field_id('data_show_facepile'); ?>"><?php _e('Show social stats', 'sketchfab-profile-widget'); ?></label>
        </p>
        <p>
            <input onclick="shoWidth();" class="checkbox" type="checkbox" <?php checked($instance['data_adapt_container_width'], "on") ?> id="<?php echo $this->get_field_id('data_adapt_container_width'); ?>" name="<?php echo $this->get_field_name('data_adapt_container_width'); ?>" />
            <label for="<?php echo $this->get_field_id('data_adapt_container_width'); ?>"><?php _e('Adapt to full sidebar width', 'sketchfab-profile-widget'); ?></label>
        </p>
        <p class="width_option <?php echo $instance['data_adapt_container_width'] == 'on' ? 'hideme' : ''; ?>">
            <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Set Width:', 'sketchfab-profile-widget'); ?></label>
            <input size="5" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
        </p>
        <p style="display:none">
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Set Height:', 'sketchfab-profile-widget'); ?></label>
            <input size="5" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('custom_css'); ?>"><?php _e('Custom Css: ', 'sketchfab-profile-widget'); ?></label><br />
            <textarea rows="4" cols="30" name="<?php echo $this->get_field_name('custom_css'); ?>"><?php echo trim($custom_css); ?></textarea>
        </p>
        <script type="text/javascript">
            function shoWidth() {
                if (jQuery(".width_option").hasClass('hideme'))
                    jQuery(".width_option").removeClass('hideme');
                else
                    jQuery(".width_option").addClass('hideme');
            }
        </script>
        <style type="text/css">.hideme {display: none;}</style>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("sketchfab_widget");'));
?>