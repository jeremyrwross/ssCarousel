<?php
/*
Plugin Name: Slick Carousel
Plugin URI: http://www.web.com
Description: Custom CTA Text Area Widget
Author: Web.com
Version: 1
Author URI: http://www.web.com
*/

class sscarousel_slick_01 extends WP_Widget {

    private $WidgetName = 'Slick Carousel Item';
    private $WidgetDesc = 'Individual Slick Carousel Item';
    private $ShowImage = true;
    private $ShowFA = false;
    private $ShowTitle = false;
    private $ShowTextarea = false;
    private $ShowLearnMore = false;

    private $ImageFaClickable = true;
    private $TitleClickable = false;

    private $WrapContent = false;
    private $WrapContentClass = '';

    // Widget Constructor
    function __construct() {
        parent::WP_Widget(false, $this->WidgetName, array( 'description' => $this->WidgetDesc));
    }


    // Dashboard Widget Form
    function form($instance) {

        // Check values
        if( $instance) {
            $title = $instance['title'];
            $cta_img = esc_attr($instance['cta_img']);
            $cta_fa = $instance['cta_fa'];
            $textarea = $instance['textarea'];
            $learn_more_title = $instance['learn_more_title'];
            $learn_more_url = $instance['learn_more_url'];
            $learn_more_target = $instance['learn_more_target'];
        } else {
            $title = '';
            $textarea = '';
            $cta_img = '';
            $cta_fa = '';
            $learn_more_title = '';
            $learn_more_url = '';
            $learn_more_target = '';
        }
        ?>
        <?php if($this->ShowImage): ?>
        <p>
            <label for="<?php echo $this->get_field_id('cta_img'); ?>">Image URL - <small><em>From the <a href="upload.php" target="_blank">Media Library</a></em></small></label>
            <input class="widefat" id="<?php echo $this->get_field_id('cta_img'); ?>" name="<?php echo $this->get_field_name('cta_img'); ?>" type="text" value="<?php echo $cta_img; ?>" />
        </p>
        <?php endif; ?>
        <?php if($this->ShowFA): ?>
        <p>
            <label for="<?php echo $this->get_field_id('cta_fa'); ?>">Font Awesome Icon - <small><em>Use the &lt;i&gt; tag from <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Font Awesome Icons</a></em></small></label>
            <input class="widefat" id="<?php echo $this->get_field_id('cta_fa'); ?>" name="<?php echo $this->get_field_name('cta_fa'); ?>" type="text" value="<?php echo htmlentities($cta_fa); ?>" />
        </p>
        <?php endif; ?>
        <?php if($this->ShowTitle): ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo htmlentities($title); ?>" />
        </p>
        <?php endif; ?>
        <?php if($this->ShowTextarea): ?>
        <p>
            <label for="<?php echo $this->get_field_id('textarea'); ?>">Description</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>" rows="7" cols="20" ><?php echo htmlentities($textarea); ?></textarea>
        </p>
        <?php endif; ?>
        <?php if($this->ShowLearnMore): ?>
        <p>
            <label for="<?php echo $this->get_field_id('learn_more_title'); ?>">Learn More Link Text</label>
            <input class="widefat" id="<?php echo $this->get_field_id('learn_more_title'); ?>" name="<?php echo $this->get_field_name('learn_more_title'); ?>" type="text" value="<?php echo htmlentities($learn_more_title); ?>" />
        </p>
        <?php endif; ?>
        <?php if($this->ShowLearnMore or $this->ImageFaClickable or $this->TitleClickable): ?>
        <p>
            <label for="<?php echo $this->get_field_id('learn_more_url'); ?>">Learn More Link URL</label>
            <input class="widefat" id="<?php echo $this->get_field_id('learn_more_url'); ?>" name="<?php echo $this->get_field_name('learn_more_url'); ?>" type="text" value="<?php echo $learn_more_url; ?>" placeholder="http://" />
            <input class="widefat" id="<?php echo $this->get_field_id('learn_more_target'); ?>" name="<?php echo $this->get_field_name('learn_more_target'); ?>"  type="checkbox" value="_blank" <?php if($learn_more_target=='_blank') echo ' checked'; ?>> <label for="<?php echo $this->get_field_id('learn_more_target'); ?>"  style="display:inline-block; vertical-align: sub;">Open in new window</label>
        </p>
        <?php endif; ?>
        <?php
    }


    // Update widget Content
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        // Fields

        $instance['cta_img'] = $new_instance['cta_img'];
        $instance['cta_fa'] = $new_instance['cta_fa'];
        $instance['title'] = $new_instance['title'];
        $instance['textarea'] = $new_instance['textarea'];
        $instance['learn_more_title'] = $new_instance['learn_more_title'];
        $instance['learn_more_url'] = $new_instance['learn_more_url'];
        $instance['learn_more_target'] = $new_instance['learn_more_target'];
        return $instance;
    }


    // Display widget on front end
    function widget($args, $instance) {
        extract( $args );

        // these are the widget options
        $title = apply_filters('widget_title', $instance['title']);
        $textarea = $instance['textarea'];
        $cta_img = $instance['cta_img'];
        $cta_fa = $instance['cta_fa'];
        $learn_more_title = $instance['learn_more_title'];
        $learn_more_url = $instance['learn_more_url'];
        $learn_more_target = $instance['learn_more_target'];

        // Count number of widgets in the current sidebar
        $sidebar_id = $args['id'];
        $total_widgets = wp_get_sidebars_widgets();
        $sidebar_widgets_count = count($total_widgets[$sidebar_id]);

        // Replace the $before_widget class, with a grid class.
        echo str_replace('class="', 'class="col-1-' . $sidebar_widgets_count . ' ', $before_widget);


        if($this->WrapContent) echo '<div class="'.$this->WrapContentClass.'">';

        // Output the CTA image, if it's set
        if ( $cta_img != '' and $this->ShowImage ) {
            if($title != '') $alt = $title; else $alt = get_bloginfo('name');
            if($this->ImageFaClickable) echo '<a href="'.$learn_more_url.'" target="'.$learn_more_target.'" class="widget-img-link">';
            echo '<img src="'.$cta_img.'" alt="'.$alt.'" class="widget-img">';
            if($this->ImageFaClickable) echo '</a>';
        }


        // Output the Font Awesome icon, if it's set
        if ( $cta_fa != '' and $this->ShowFA ) {
            if($this->ImageFaClickable) echo '<a href="'.$learn_more_url.'" target="'.$learn_more_target.'" class="widget-fa-link">';
            echo $cta_fa;
            if($this->ImageFaClickable) echo '</a>';
        }


        // Output the title
        if ( $title != '' and $this->ShowTitle ) {
            echo $before_title;
            if($this->TitleClickable) echo '<a href="'.$learn_more_url.'" target="'.$learn_more_target.'">';
            echo $title;
            if($this->TitleClickable) echo '</a>';
            echo $after_title;
        }


        // Output the Textarea, if it's set
        if( $textarea != '' and $this->ShowTextarea ) {
            echo '<div class="widget-textarea">'.$textarea.'</div>';
        }


        // Output the Learn More link, if it's set
        if( $learn_more_title != '' and $this->ShowLearnMore ) {
            echo '<div class="widget-learn-more"><a href="'.$learn_more_url.'" target="'.$learn_more_target.'">'.$learn_more_title.'</a></div>';
        }

        if($this->WrapContent) echo '</div>';

        echo $after_widget;

    }
}
