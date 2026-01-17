<?php
/**
 * The header template file
 *
 * @package EchoBroad
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-container">
            <div class="site-logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>">
                    </a>
                    <?php
                }
                ?>
            </div>
            
            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="cta-button">Get Started</a>
            </nav>
            
            <button class="menu-toggle" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>
