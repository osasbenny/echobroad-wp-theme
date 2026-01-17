<?php
/**
 * Payment Handler
 *
 * @package EchoBroad_Paystack
 */

if (!defined('ABSPATH')) {
    exit;
}

class EchoBroad_Payment_Handler {
    
    public static function init() {
        add_action('wp_ajax_echobroad_initialize_payment', array(__CLASS__, 'initialize_payment'));
        add_action('wp_ajax_nopriv_echobroad_initialize_payment', array(__CLASS__, 'initialize_payment'));
        
        add_action('wp_ajax_echobroad_verify_payment', array(__CLASS__, 'verify_payment'));
        add_action('wp_ajax_nopriv_echobroad_verify_payment', array(__CLASS__, 'verify_payment'));
        
        // Add rewrite rule for callback
        add_action('init', array(__CLASS__, 'add_rewrite_rules'));
        add_action('template_redirect', array(__CLASS__, 'handle_callback'));
    }
    
    public static function add_rewrite_rules() {
        add_rewrite_rule('^payment-callback/?', 'index.php?payment_callback=1', 'top');
        add_rewrite_tag('%payment_callback%', '([^&]+)');
    }
    
    public static function handle_callback() {
        if (get_query_var('payment_callback')) {
            $reference = isset($_GET['reference']) ? sanitize_text_field($_GET['reference']) : '';
            
            if ($reference) {
                // Verify payment
                $plugin = EchoBroad_Paystack::get_instance();
                $api = new EchoBroad_Paystack_API($plugin->get_secret_key());
                $result = $api->verify_transaction($reference);
                
                if ($result && isset($result['status']) && $result['status'] === true) {
                    $data = $result['data'];
                    
                    if ($data['status'] === 'success') {
                        // Update order status
                        EchoBroad_Order_Manager::update_order_status($reference, 'completed', $data['id']);
                        
                        // Redirect to success page
                        wp_redirect(home_url('/payment-success/?reference=' . $reference));
                        exit;
                    }
                }
            }
            
            // Redirect to failed page
            wp_redirect(home_url('/payment-failed/'));
            exit;
        }
    }
    
    public static function initialize_payment() {
        check_ajax_referer('echobroad_payment_nonce', 'nonce');
        
        $item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
        $item_type = isset($_POST['item_type']) ? sanitize_text_field($_POST['item_type']) : '';
        $item_name = isset($_POST['item_name']) ? sanitize_text_field($_POST['item_name']) : '';
        $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
        $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
        
        if (!$item_id || !$email || !$price) {
            wp_send_json_error(array('message' => 'Invalid payment details'));
        }
        
        // Generate unique reference
        $reference = 'ECHO_' . time() . '_' . $item_id;
        
        // Create order
        $order_id = EchoBroad_Order_Manager::create_order(array(
            'reference' => $reference,
            'customer_name' => $name,
            'customer_email' => $email,
            'customer_phone' => $phone,
            'item_id' => $item_id,
            'item_type' => $item_type,
            'item_name' => $item_name,
            'amount' => $price,
            'status' => 'pending'
        ));
        
        if (!$order_id) {
            wp_send_json_error(array('message' => 'Failed to create order'));
        }
        
        // Initialize Paystack transaction
        $plugin = EchoBroad_Paystack::get_instance();
        $api = new EchoBroad_Paystack_API($plugin->get_secret_key());
        
        $metadata = array(
            'order_id' => $order_id,
            'item_id' => $item_id,
            'item_type' => $item_type,
            'item_name' => $item_name,
            'customer_name' => $name,
            'customer_phone' => $phone
        );
        
        $result = $api->initialize_transaction($email, $price, $reference, $metadata);
        
        if ($result && isset($result['status']) && $result['status'] === true) {
            wp_send_json_success(array(
                'authorization_url' => $result['data']['authorization_url'],
                'access_code' => $result['data']['access_code'],
                'reference' => $result['data']['reference']
            ));
        } else {
            $message = isset($result['message']) ? $result['message'] : 'Payment initialization failed';
            wp_send_json_error(array('message' => $message));
        }
    }
    
    public static function verify_payment() {
        check_ajax_referer('echobroad_payment_nonce', 'nonce');
        
        $reference = isset($_POST['reference']) ? sanitize_text_field($_POST['reference']) : '';
        
        if (!$reference) {
            wp_send_json_error(array('message' => 'Invalid reference'));
        }
        
        $plugin = EchoBroad_Paystack::get_instance();
        $api = new EchoBroad_Paystack_API($plugin->get_secret_key());
        
        $result = $api->verify_transaction($reference);
        
        if ($result && isset($result['status']) && $result['status'] === true) {
            $data = $result['data'];
            
            if ($data['status'] === 'success') {
                // Update order
                EchoBroad_Order_Manager::update_order_status($reference, 'completed', $data['id']);
                
                wp_send_json_success(array(
                    'message' => 'Payment verified successfully',
                    'data' => $data
                ));
            }
        }
        
        wp_send_json_error(array('message' => 'Payment verification failed'));
    }
}
