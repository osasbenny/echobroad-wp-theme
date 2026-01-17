<?php
/**
 * Plugin Name: EchoBroad Paystack Payment Gateway
 * Plugin URI: https://echobroad.com
 * Description: Custom Paystack payment integration for EchoBroad products and courses
 * Version: 1.0.0
 * Author: EchoBroad Team
 * Author URI: https://echobroad.com
 * License: GPL v2 or later
 * Text Domain: echobroad-paystack
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('ECHOBROAD_PAYSTACK_VERSION', '1.0.0');
define('ECHOBROAD_PAYSTACK_PATH', plugin_dir_path(__FILE__));
define('ECHOBROAD_PAYSTACK_URL', plugin_dir_url(__FILE__));

// Include required files
require_once ECHOBROAD_PAYSTACK_PATH . 'includes/class-paystack-api.php';
require_once ECHOBROAD_PAYSTACK_PATH . 'includes/class-payment-handler.php';
require_once ECHOBROAD_PAYSTACK_PATH . 'includes/class-order-manager.php';

/**
 * Main Plugin Class
 */
class EchoBroad_Paystack {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
    }
    
    public function init() {
        // Initialize payment handler
        EchoBroad_Payment_Handler::init();
        
        // Add buy now buttons to products and courses
        add_filter('the_content', array($this, 'add_buy_button'));
    }
    
    public function enqueue_scripts() {
        // Paystack inline JS
        wp_enqueue_script('paystack-inline', 'https://js.paystack.co/v1/inline.js', array(), null, true);
        
        // Plugin CSS
        wp_enqueue_style('echobroad-paystack', ECHOBROAD_PAYSTACK_URL . 'assets/css/paystack.css', array(), ECHOBROAD_PAYSTACK_VERSION);
        
        // Plugin JS
        wp_enqueue_script('echobroad-paystack', ECHOBROAD_PAYSTACK_URL . 'assets/js/paystack.js', array('jquery', 'paystack-inline'), ECHOBROAD_PAYSTACK_VERSION, true);
        
        // Localize script with settings
        wp_localize_script('echobroad-paystack', 'echobroadPaystack', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'public_key' => $this->get_public_key(),
            'currency' => 'NGN',
            'nonce' => wp_create_nonce('echobroad_payment_nonce'),
        ));
    }
    
    public function add_buy_button($content) {
        if (is_singular(array('product', 'course'))) {
            global $post;
            
            $post_type = get_post_type();
            $price = get_post_meta($post->ID, '_' . $post_type . '_price', true);
            
            if ($price) {
                $button = '<div class="echobroad-payment-section">';
                $button .= '<div class="price-display">₦' . number_format($price) . '</div>';
                $button .= '<button class="echobroad-buy-button cta-button" data-item-id="' . $post->ID . '" data-item-type="' . $post_type . '" data-item-name="' . esc_attr($post->post_title) . '" data-price="' . $price . '">Buy Now</button>';
                $button .= '</div>';
                
                $content .= $button;
            }
        }
        
        return $content;
    }
    
    public function add_admin_menu() {
        add_menu_page(
            'Paystack Settings',
            'Paystack',
            'manage_options',
            'echobroad-paystack',
            array($this, 'settings_page'),
            'dashicons-money-alt',
            35
        );
        
        add_submenu_page(
            'echobroad-paystack',
            'Orders',
            'Orders',
            'manage_options',
            'echobroad-orders',
            array($this, 'orders_page')
        );
    }
    
    public function register_settings() {
        register_setting('echobroad_paystack_settings', 'echobroad_paystack_mode');
        register_setting('echobroad_paystack_settings', 'echobroad_paystack_test_public_key');
        register_setting('echobroad_paystack_settings', 'echobroad_paystack_test_secret_key');
        register_setting('echobroad_paystack_settings', 'echobroad_paystack_live_public_key');
        register_setting('echobroad_paystack_settings', 'echobroad_paystack_live_secret_key');
    }
    
    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>Paystack Payment Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('echobroad_paystack_settings');
                do_settings_sections('echobroad_paystack_settings');
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">Payment Mode</th>
                        <td>
                            <select name="echobroad_paystack_mode">
                                <option value="test" <?php selected(get_option('echobroad_paystack_mode'), 'test'); ?>>Test Mode</option>
                                <option value="live" <?php selected(get_option('echobroad_paystack_mode'), 'live'); ?>>Live Mode</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2"><h3>Test API Keys</h3></th>
                    </tr>
                    <tr>
                        <th scope="row">Test Public Key</th>
                        <td><input type="text" name="echobroad_paystack_test_public_key" value="<?php echo esc_attr(get_option('echobroad_paystack_test_public_key')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Test Secret Key</th>
                        <td><input type="password" name="echobroad_paystack_test_secret_key" value="<?php echo esc_attr(get_option('echobroad_paystack_test_secret_key')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2"><h3>Live API Keys</h3></th>
                    </tr>
                    <tr>
                        <th scope="row">Live Public Key</th>
                        <td><input type="text" name="echobroad_paystack_live_public_key" value="<?php echo esc_attr(get_option('echobroad_paystack_live_public_key')); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Live Secret Key</th>
                        <td><input type="password" name="echobroad_paystack_live_secret_key" value="<?php echo esc_attr(get_option('echobroad_paystack_live_secret_key')); ?>" class="regular-text" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
    
    public function orders_page() {
        $orders = EchoBroad_Order_Manager::get_orders();
        ?>
        <div class="wrap">
            <h1>Payment Orders</h1>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($orders) : ?>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?php echo esc_html($order->order_id); ?></td>
                                <td><?php echo esc_html($order->customer_name); ?></td>
                                <td><?php echo esc_html($order->customer_email); ?></td>
                                <td><?php echo esc_html($order->item_name); ?></td>
                                <td>₦<?php echo number_format($order->amount); ?></td>
                                <td><span class="status-<?php echo esc_attr($order->status); ?>"><?php echo esc_html(ucfirst($order->status)); ?></span></td>
                                <td><?php echo esc_html($order->created_at); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">No orders yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
    
    public function get_public_key() {
        // Check for constant first (wp-config.php)
        if (defined('ECHOBROAD_PAYSTACK_PUBLIC_KEY')) {
            return ECHOBROAD_PAYSTACK_PUBLIC_KEY;
        }
        
        $mode = get_option('echobroad_paystack_mode', 'live');
        if ($mode === 'live') {
            return get_option('echobroad_paystack_live_public_key', '');
        }
        return get_option('echobroad_paystack_test_public_key', '');
    }
    
    public function get_secret_key() {
        // Check for constant first (wp-config.php)
        if (defined('ECHOBROAD_PAYSTACK_SECRET_KEY')) {
            return ECHOBROAD_PAYSTACK_SECRET_KEY;
        }
        
        $mode = get_option('echobroad_paystack_mode', 'live');
        if ($mode === 'live') {
            return get_option('echobroad_paystack_live_secret_key', '');
        }
        return get_option('echobroad_paystack_test_secret_key', '');
    }
}

// Initialize plugin
function echobroad_paystack_init() {
    return EchoBroad_Paystack::get_instance();
}
add_action('plugins_loaded', 'echobroad_paystack_init');

// Activation hook - create orders table
register_activation_hook(__FILE__, 'echobroad_paystack_activate');
function echobroad_paystack_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'echobroad_orders';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        order_id varchar(100) NOT NULL,
        reference varchar(100) NOT NULL,
        customer_name varchar(100) NOT NULL,
        customer_email varchar(100) NOT NULL,
        customer_phone varchar(20),
        item_id mediumint(9) NOT NULL,
        item_type varchar(50) NOT NULL,
        item_name varchar(200) NOT NULL,
        amount decimal(10,2) NOT NULL,
        status varchar(20) NOT NULL,
        payment_method varchar(50),
        transaction_id varchar(100),
        created_at datetime NOT NULL,
        updated_at datetime,
        PRIMARY KEY  (id),
        KEY order_id (order_id),
        KEY reference (reference)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
    // Set default payment mode
    if (!get_option('echobroad_paystack_mode')) {
        update_option('echobroad_paystack_mode', 'live');
    }
}
