<?php
/**
 * Plugin Name: EchoBroad Contact Form
 * Plugin URI: https://echobroad.com
 * Description: Custom contact form plugin for EchoBroad theme with email notifications
 * Version: 1.0.0
 * Author: EchoBroad Team
 * Author URI: https://echobroad.com
 * License: GPL v2 or later
 * Text Domain: echobroad-contact
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Contact Form Shortcode
function echobroad_contact_form_shortcode() {
    ob_start();
    ?>
    <form id="echobroad-contact-form" method="post" class="echobroad-contact-form">
        <?php wp_nonce_field('echobroad_contact_submit', 'echobroad_contact_nonce'); ?>
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label for="contact_name" style="display: block; margin-bottom: 5px; font-weight: 600;">Name *</label>
            <input type="text" id="contact_name" name="contact_name" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
        </div>
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label for="contact_email" style="display: block; margin-bottom: 5px; font-weight: 600;">Email *</label>
            <input type="email" id="contact_email" name="contact_email" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
        </div>
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label for="contact_phone" style="display: block; margin-bottom: 5px; font-weight: 600;">Phone</label>
            <input type="tel" id="contact_phone" name="contact_phone" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
        </div>
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label for="contact_subject" style="display: block; margin-bottom: 5px; font-weight: 600;">Subject *</label>
            <input type="text" id="contact_subject" name="contact_subject" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
        </div>
        
        <div class="form-group" style="margin-bottom: 20px;">
            <label for="contact_message" style="display: block; margin-bottom: 5px; font-weight: 600;">Message *</label>
            <textarea id="contact_message" name="contact_message" rows="6" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; resize: vertical;"></textarea>
        </div>
        
        <div class="form-message" style="margin-bottom: 20px; display: none;"></div>
        
        <button type="submit" class="cta-button" style="background-color: #FF0050; color: white; padding: 12px 30px; border: none; border-radius: 5px; font-weight: 600; cursor: pointer;">Send Message</button>
    </form>
    
    <script>
    jQuery(document).ready(function($) {
        $('#echobroad-contact-form').on('submit', function(e) {
            e.preventDefault();
            
            var $form = $(this);
            var $button = $form.find('button[type="submit"]');
            var $message = $form.find('.form-message');
            
            $button.prop('disabled', true).text('Sending...');
            $message.hide();
            
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: $form.serialize() + '&action=echobroad_contact_submit',
                success: function(response) {
                    if (response.success) {
                        $message.html('<p style="color: green; padding: 15px; background: #d4edda; border-radius: 5px;">' + response.data.message + '</p>').show();
                        $form[0].reset();
                    } else {
                        $message.html('<p style="color: red; padding: 15px; background: #f8d7da; border-radius: 5px;">' + response.data.message + '</p>').show();
                    }
                    $button.prop('disabled', false).text('Send Message');
                },
                error: function() {
                    $message.html('<p style="color: red; padding: 15px; background: #f8d7da; border-radius: 5px;">An error occurred. Please try again.</p>').show();
                    $button.prop('disabled', false).text('Send Message');
                }
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('echobroad_contact_form', 'echobroad_contact_form_shortcode');

// Handle Form Submission
function echobroad_contact_form_submit() {
    // Verify nonce
    if (!isset($_POST['echobroad_contact_nonce']) || !wp_verify_nonce($_POST['echobroad_contact_nonce'], 'echobroad_contact_submit')) {
        wp_send_json_error(array('message' => 'Security verification failed.'));
    }
    
    // Sanitize input
    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $phone = sanitize_text_field($_POST['contact_phone']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);
    
    // Validate
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields.'));
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
    }
    
    // Prepare email
    $to = get_option('admin_email');
    $email_subject = 'New Contact Form Submission: ' . $subject;
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Phone: $phone\n\n";
    $email_body .= "Subject: $subject\n\n";
    $email_body .= "Message:\n$message\n";
    
    $headers = array(
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email,
    );
    
    // Send email
    $sent = wp_mail($to, $email_subject, $email_body, $headers);
    
    // Save to database
    global $wpdb;
    $table_name = $wpdb->prefix . 'echobroad_contacts';
    
    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'submitted_at' => current_time('mysql'),
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s')
    );
    
    if ($sent) {
        wp_send_json_success(array('message' => 'Thank you! Your message has been sent successfully.'));
    } else {
        wp_send_json_error(array('message' => 'Failed to send message. Please try again later.'));
    }
}
add_action('wp_ajax_echobroad_contact_submit', 'echobroad_contact_form_submit');
add_action('wp_ajax_nopriv_echobroad_contact_submit', 'echobroad_contact_form_submit');

// Create database table on plugin activation
function echobroad_contact_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'echobroad_contacts';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20),
        subject varchar(200) NOT NULL,
        message text NOT NULL,
        submitted_at datetime NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'echobroad_contact_create_table');

// Add admin menu for viewing submissions
function echobroad_contact_admin_menu() {
    add_menu_page(
        'Contact Submissions',
        'Contact Forms',
        'manage_options',
        'echobroad-contacts',
        'echobroad_contact_admin_page',
        'dashicons-email',
        30
    );
}
add_action('admin_menu', 'echobroad_contact_admin_menu');

// Admin page to view submissions
function echobroad_contact_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'echobroad_contacts';
    
    $contacts = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC");
    
    ?>
    <div class="wrap">
        <h1>Contact Form Submissions</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($contacts) : ?>
                    <?php foreach ($contacts as $contact) : ?>
                        <tr>
                            <td><?php echo esc_html($contact->submitted_at); ?></td>
                            <td><?php echo esc_html($contact->name); ?></td>
                            <td><?php echo esc_html($contact->email); ?></td>
                            <td><?php echo esc_html($contact->phone); ?></td>
                            <td><?php echo esc_html($contact->subject); ?></td>
                            <td><?php echo esc_html(wp_trim_words($contact->message, 15)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No submissions yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
