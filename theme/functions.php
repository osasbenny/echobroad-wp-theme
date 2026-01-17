<?php
/**
 * EchoBroad Theme Functions
 * 
 * @package EchoBroad
 */

// Theme Setup
function echobroad_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'echobroad'),
        'footer' => __('Footer Menu', 'echobroad'),
    ));
    
    // Add image sizes
    add_image_size('echobroad-blog', 400, 250, true);
    add_image_size('echobroad-service', 600, 400, true);
}
add_action('after_setup_theme', 'echobroad_theme_setup');

// Enqueue Scripts and Styles
function echobroad_enqueue_scripts() {
    // Main stylesheet
    wp_enqueue_style('echobroad-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Animations CSS
    wp_enqueue_style('echobroad-animations', get_template_directory_uri() . '/css/animations.css', array('echobroad-style'), '1.0.0');
    
    // Font Awesome for icons
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Main JavaScript
    wp_enqueue_script('echobroad-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'echobroad_enqueue_scripts');

// Register Widget Areas
function echobroad_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'echobroad'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'echobroad'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'echobroad'),
        'id'            => 'footer-widgets',
        'description'   => __('Add widgets here to appear in your footer.', 'echobroad'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'echobroad_widgets_init');

// Custom Post Types
function echobroad_register_post_types() {
    // Services Post Type
    register_post_type('service', array(
        'labels' => array(
            'name' => __('Services', 'echobroad'),
            'singular_name' => __('Service', 'echobroad'),
            'add_new' => __('Add New Service', 'echobroad'),
            'add_new_item' => __('Add New Service', 'echobroad'),
            'edit_item' => __('Edit Service', 'echobroad'),
            'new_item' => __('New Service', 'echobroad'),
            'view_item' => __('View Service', 'echobroad'),
            'search_items' => __('Search Services', 'echobroad'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'services'),
    ));
    
    // Courses Post Type
    register_post_type('course', array(
        'labels' => array(
            'name' => __('Courses', 'echobroad'),
            'singular_name' => __('Course', 'echobroad'),
            'add_new' => __('Add New Course', 'echobroad'),
            'add_new_item' => __('Add New Course', 'echobroad'),
            'edit_item' => __('Edit Course', 'echobroad'),
            'new_item' => __('New Course', 'echobroad'),
            'view_item' => __('View Course', 'echobroad'),
            'search_items' => __('Search Courses', 'echobroad'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-book',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'courses'),
    ));
    
    // Products Post Type
    register_post_type('product', array(
        'labels' => array(
            'name' => __('Products', 'echobroad'),
            'singular_name' => __('Product', 'echobroad'),
            'add_new' => __('Add New Product', 'echobroad'),
            'add_new_item' => __('Add New Product', 'echobroad'),
            'edit_item' => __('Edit Product', 'echobroad'),
            'new_item' => __('New Product', 'echobroad'),
            'view_item' => __('View Product', 'echobroad'),
            'search_items' => __('Search Products', 'echobroad'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-cart',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'products'),
    ));
    
    // Testimonials Post Type
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('Testimonials', 'echobroad'),
            'singular_name' => __('Testimonial', 'echobroad'),
            'add_new' => __('Add New Testimonial', 'echobroad'),
            'add_new_item' => __('Add New Testimonial', 'echobroad'),
            'edit_item' => __('Edit Testimonial', 'echobroad'),
            'new_item' => __('New Testimonial', 'echobroad'),
            'view_item' => __('View Testimonial', 'echobroad'),
            'search_items' => __('Search Testimonials', 'echobroad'),
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'echobroad_register_post_types');

// Add Custom Meta Boxes
function echobroad_add_meta_boxes() {
    // Course Meta Box
    add_meta_box(
        'course_details',
        __('Course Details', 'echobroad'),
        'echobroad_course_meta_box_callback',
        'course',
        'normal',
        'high'
    );
    
    // Product Meta Box
    add_meta_box(
        'product_details',
        __('Product Details', 'echobroad'),
        'echobroad_product_meta_box_callback',
        'product',
        'normal',
        'high'
    );
    
    // Testimonial Meta Box
    add_meta_box(
        'testimonial_details',
        __('Testimonial Details', 'echobroad'),
        'echobroad_testimonial_meta_box_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'echobroad_add_meta_boxes');

// Course Meta Box Callback
function echobroad_course_meta_box_callback($post) {
    wp_nonce_field('echobroad_course_meta_box', 'echobroad_course_meta_box_nonce');
    
    $price = get_post_meta($post->ID, '_course_price', true);
    $level = get_post_meta($post->ID, '_course_level', true);
    $duration = get_post_meta($post->ID, '_course_duration', true);
    
    echo '<p><label for="course_price">' . __('Price (₦):', 'echobroad') . '</label>';
    echo '<input type="text" id="course_price" name="course_price" value="' . esc_attr($price) . '" /></p>';
    
    echo '<p><label for="course_level">' . __('Level:', 'echobroad') . '</label>';
    echo '<input type="text" id="course_level" name="course_level" value="' . esc_attr($level) . '" placeholder="e.g., Beginner to Advanced" /></p>';
    
    echo '<p><label for="course_duration">' . __('Duration:', 'echobroad') . '</label>';
    echo '<input type="text" id="course_duration" name="course_duration" value="' . esc_attr($duration) . '" placeholder="e.g., 6 weeks" /></p>';
}

// Product Meta Box Callback
function echobroad_product_meta_box_callback($post) {
    wp_nonce_field('echobroad_product_meta_box', 'echobroad_product_meta_box_nonce');
    
    $price = get_post_meta($post->ID, '_product_price', true);
    $icon = get_post_meta($post->ID, '_product_icon', true);
    
    echo '<p><label for="product_price">' . __('Price (₦):', 'echobroad') . '</label>';
    echo '<input type="text" id="product_price" name="product_price" value="' . esc_attr($price) . '" /></p>';
    
    echo '<p><label for="product_icon">' . __('Icon Class (Font Awesome):', 'echobroad') . '</label>';
    echo '<input type="text" id="product_icon" name="product_icon" value="' . esc_attr($icon) . '" placeholder="e.g., fa-shopping-bag" /></p>';
}

// Testimonial Meta Box Callback
function echobroad_testimonial_meta_box_callback($post) {
    wp_nonce_field('echobroad_testimonial_meta_box', 'echobroad_testimonial_meta_box_nonce');
    
    $author = get_post_meta($post->ID, '_testimonial_author', true);
    $position = get_post_meta($post->ID, '_testimonial_position', true);
    $rating = get_post_meta($post->ID, '_testimonial_rating', true);
    
    echo '<p><label for="testimonial_author">' . __('Author Name:', 'echobroad') . '</label>';
    echo '<input type="text" id="testimonial_author" name="testimonial_author" value="' . esc_attr($author) . '" /></p>';
    
    echo '<p><label for="testimonial_position">' . __('Position/Title:', 'echobroad') . '</label>';
    echo '<input type="text" id="testimonial_position" name="testimonial_position" value="' . esc_attr($position) . '" /></p>';
    
    echo '<p><label for="testimonial_rating">' . __('Rating (1-5):', 'echobroad') . '</label>';
    echo '<input type="number" id="testimonial_rating" name="testimonial_rating" value="' . esc_attr($rating) . '" min="1" max="5" /></p>';
}

// Save Meta Box Data
function echobroad_save_meta_boxes($post_id) {
    // Course Meta
    if (isset($_POST['echobroad_course_meta_box_nonce']) && wp_verify_nonce($_POST['echobroad_course_meta_box_nonce'], 'echobroad_course_meta_box')) {
        if (isset($_POST['course_price'])) {
            update_post_meta($post_id, '_course_price', sanitize_text_field($_POST['course_price']));
        }
        if (isset($_POST['course_level'])) {
            update_post_meta($post_id, '_course_level', sanitize_text_field($_POST['course_level']));
        }
        if (isset($_POST['course_duration'])) {
            update_post_meta($post_id, '_course_duration', sanitize_text_field($_POST['course_duration']));
        }
    }
    
    // Product Meta
    if (isset($_POST['echobroad_product_meta_box_nonce']) && wp_verify_nonce($_POST['echobroad_product_meta_box_nonce'], 'echobroad_product_meta_box')) {
        if (isset($_POST['product_price'])) {
            update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['product_price']));
        }
        if (isset($_POST['product_icon'])) {
            update_post_meta($post_id, '_product_icon', sanitize_text_field($_POST['product_icon']));
        }
    }
    
    // Testimonial Meta
    if (isset($_POST['echobroad_testimonial_meta_box_nonce']) && wp_verify_nonce($_POST['echobroad_testimonial_meta_box_nonce'], 'echobroad_testimonial_meta_box')) {
        if (isset($_POST['testimonial_author'])) {
            update_post_meta($post_id, '_testimonial_author', sanitize_text_field($_POST['testimonial_author']));
        }
        if (isset($_POST['testimonial_position'])) {
            update_post_meta($post_id, '_testimonial_position', sanitize_text_field($_POST['testimonial_position']));
        }
        if (isset($_POST['testimonial_rating'])) {
            update_post_meta($post_id, '_testimonial_rating', absint($_POST['testimonial_rating']));
        }
    }
}
add_action('save_post', 'echobroad_save_meta_boxes');

// Customizer Options
function echobroad_customize_register($wp_customize) {
    // Contact Information Section
    $wp_customize->add_section('echobroad_contact', array(
        'title' => __('Contact Information', 'echobroad'),
        'priority' => 30,
    ));
    
    // Email
    $wp_customize->add_setting('echobroad_email', array(
        'default' => 'info@echobroad.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('echobroad_email', array(
        'label' => __('Email Address', 'echobroad'),
        'section' => 'echobroad_contact',
        'type' => 'text',
    ));
    
    // Phone
    $wp_customize->add_setting('echobroad_phone', array(
        'default' => '+2348071447959',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('echobroad_phone', array(
        'label' => __('Phone Number', 'echobroad'),
        'section' => 'echobroad_contact',
        'type' => 'text',
    ));
    
    // Address
    $wp_customize->add_setting('echobroad_address', array(
        'default' => '39 East West Road, Rumuodara, Port Harcourt',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('echobroad_address', array(
        'label' => __('Address', 'echobroad'),
        'section' => 'echobroad_contact',
        'type' => 'textarea',
    ));
    
    // Social Media Section
    $wp_customize->add_section('echobroad_social', array(
        'title' => __('Social Media Links', 'echobroad'),
        'priority' => 31,
    ));
    
    $social_networks = array('facebook', 'instagram', 'linkedin', 'youtube');
    foreach ($social_networks as $network) {
        $wp_customize->add_setting('echobroad_' . $network, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('echobroad_' . $network, array(
            'label' => ucfirst($network) . ' URL',
            'section' => 'echobroad_social',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'echobroad_customize_register');

// Excerpt Length
function echobroad_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'echobroad_excerpt_length');

// Excerpt More
function echobroad_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'echobroad_excerpt_more');
