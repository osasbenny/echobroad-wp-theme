<?php
/**
 * The footer template file
 *
 * @package EchoBroad
 */
?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section footer-brand">
                <h3>Echo<span class="highlight">Broad</span></h3>
                <p class="footer-description">
                    Make your business the talk of town. We don't just run ads, we build what makes them convert. Ads. Creatives. Strategy.
                </p>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/products')); ?>">E-Store</a></li>
                    <li><a href="<?php echo esc_url(home_url('/courses')); ?>">Courses</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a></li>
                </ul>
            </div>
            
            <div class="footer-section footer-contact">
                <h3>Contact</h3>
                <p><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('echobroad_email', 'info@echobroad.com')); ?></p>
                <p><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('echobroad_phone', '+2348071447959')); ?></p>
                <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(get_theme_mod('echobroad_address', '39 East West Road, Rumuodara, Port Harcourt')); ?></p>
            </div>
            
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <?php
                    $social_networks = array(
                        'facebook' => 'fab fa-facebook-f',
                        'instagram' => 'fab fa-instagram',
                        'linkedin' => 'fab fa-linkedin-in',
                        'youtube' => 'fab fa-youtube'
                    );
                    
                    foreach ($social_networks as $network => $icon) {
                        $url = get_theme_mod('echobroad_' . $network);
                        if ($url) {
                            echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer"><i class="' . esc_attr($icon) . '"></i></a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Echobroad Agency. All rights reserved.</p>
            <p>Designed by <a href="<?php echo esc_url(home_url('/')); ?>">EchoBroad Team</a></p>
        </div>
    </div>
</footer>

<div class="scroll-to-top">
    <i class="fas fa-arrow-up"></i>
</div>

<?php wp_footer(); ?>
</body>
</html>
