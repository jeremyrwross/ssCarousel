<?php

// Enqueue Javascript files
function sscarousel_load_slick_js() {
    wp_enqueue_script( 'sscarousel-slick-script', get_template_directory_uri().'/scripts/slick/slick.min.js', array('jquery'), '1.5.7', true );
}
add_action( 'wp_enqueue_scripts', 'sscarousel_load_slick_js' );


function sscarousel_custom_widget_setup_slick() {
    register_sidebar( array(
        'name' => 'Slick Carousel',
        'id' => 'sscarousel_sidebar_slick_01',
        'description' => 'Carousel',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action( 'widgets_init', 'sscarousel_custom_widget_setup_slick' );

include 'widgets/sscarousel_slick_01.php';
add_action('widgets_init', create_function('', 'return register_widget("sscarousel_slick_01");'));

function sscarousel_slick_sidebar_shortcode() {

  ob_start();
  get_sidebar("sscarousel_sidebar_slick_01");
  $sidebar="<div class=\"slider slick-slider-responsive\">";
  $sidebar.=ob_get_contents();
  $sidebar.="</div>";
  ob_end_clean();

  return $sidebar;
}

add_shortcode('get_slick_sidebar', 'sscarousel_slick_sidebar_shortcode');





