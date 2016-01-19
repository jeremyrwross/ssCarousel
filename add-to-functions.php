<?php

// Enqueue Javascript files
function webcom_load_slick_js() {
    wp_enqueue_script( 'webcom-slick-script', get_template_directory_uri().'/scripts/slick/slick.min.js', array('jquery'), '1.5.7', true );
}
add_action( 'wp_enqueue_scripts', 'webcom_load_slick_js' );


function webcom_custom_widget_setup_slick() {
    register_sidebar( array(
        'name' => 'Slick Carousel',
        'id' => 'webcom_sidebar_slick_01',
        'description' => 'Carousel',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action( 'widgets_init', 'webcom_custom_widget_setup_slick' );

include 'widgets/webcom_cta_01.php';
add_action('widgets_init', create_function('', 'return register_widget("webcom_cta_01");'));

function webcom_slick_sidebar_shortcode() {

  ob_start();
  get_sidebar("webcom_sidebar_slick_01");
  $sidebar="<div class=\"slider slick-slider-responsive\">";
  $sidebar.=ob_get_contents();
  $sidebar.="</div>";
  ob_end_clean();

  return $sidebar;
}

add_shortcode('get_slick_sidebar', 'webcom_slick_sidebar_shortcode');





