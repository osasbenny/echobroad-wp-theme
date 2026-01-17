<?php
/**
 * Template Name: Contact Page
 *
 * @package EchoBroad
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container" style="padding: 80px 20px;">
        <header class="entry-header" style="text-align: center; margin-bottom: 50px;">
            <h1 class="entry-title" style="font-size: 2.5rem;">Contact Us</h1>
            <p style="color: #666; font-size: 1.2rem;">Get in touch with us for a free consultation</p>
        </header>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 50px; max-width: 1000px; margin: 0 auto;">
            <div class="contact-info">
                <h2 style="margin-bottom: 30px;">Get In Touch</h2>
                
                <div style="margin-bottom: 30px;">
                    <h3 style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <i class="fas fa-envelope" style="color: #FF0050;"></i> Email
                    </h3>
                    <p style="color: #666;"><?php echo esc_html(get_theme_mod('echobroad_email', 'info@echobroad.com')); ?></p>
                </div>
                
                <div style="margin-bottom: 30px;">
                    <h3 style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <i class="fas fa-phone" style="color: #FF0050;"></i> Phone
                    </h3>
                    <p style="color: #666;"><?php echo esc_html(get_theme_mod('echobroad_phone', '+2348071447959')); ?></p>
                </div>
                
                <div style="margin-bottom: 30px;">
                    <h3 style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <i class="fas fa-map-marker-alt" style="color: #FF0050;"></i> Address
                    </h3>
                    <p style="color: #666;"><?php echo esc_html(get_theme_mod('echobroad_address', '39 East West Road, Rumuodara, Port Harcourt')); ?></p>
                </div>
                
                <div class="social-links" style="display: flex; gap: 15px; margin-top: 30px;">
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
                            echo '<a href="' . esc_url($url) . '" target="_blank" style="color: #001233; font-size: 1.5rem;"><i class="' . esc_attr($icon) . '"></i></a>';
                        }
                    }
                    ?>
                </div>
            </div>
            
            <div class="contact-form">
                <h2 style="margin-bottom: 30px;">Send Us a Message</h2>
                
                <?php echo do_shortcode('[echobroad_contact_form]'); ?>
                
                <!-- Fallback form if plugin not active -->
                <form id="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display: flex; flex-direction: column; gap: 20px;">
                    <input type="hidden" name="action" value="echobroad_contact_form">
                    <?php wp_nonce_field('echobroad_contact_form', 'echobroad_contact_nonce'); ?>
                    
                    <div>
                        <label for="name" style="display: block; margin-bottom: 5px; font-weight: 600;">Name *</label>
                        <input type="text" id="name" name="name" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>
                    
                    <div>
                        <label for="email" style="display: block; margin-bottom: 5px; font-weight: 600;">Email *</label>
                        <input type="email" id="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>
                    
                    <div>
                        <label for="phone" style="display: block; margin-bottom: 5px; font-weight: 600;">Phone</label>
                        <input type="tel" id="phone" name="phone" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>
                    
                    <div>
                        <label for="subject" style="display: block; margin-bottom: 5px; font-weight: 600;">Subject *</label>
                        <input type="text" id="subject" name="subject" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>
                    
                    <div>
                        <label for="message" style="display: block; margin-bottom: 5px; font-weight: 600;">Message *</label>
                        <textarea id="message" name="message" rows="6" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; resize: vertical;"></textarea>
                    </div>
                    
                    <button type="submit" class="cta-button" style="align-self: flex-start;">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
