header.php, footer.php or page template method

<?php if (is_active_sidebar('webcom_sidebar_slick_01') ) : ?>
    <div class="slider slick-slider-responsive">
        <?php dynamic_sidebar('webcom_sidebar_slick_01'); ?>
    </div>
<?php endif; ?>


Shortcode for content

[get_slick_sidebar]

