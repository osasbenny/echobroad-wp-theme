<?php
/**
 * Paystack API Handler
 *
 * @package EchoBroad_Paystack
 */

if (!defined('ABSPATH')) {
    exit;
}

class EchoBroad_Paystack_API {
    
    private $secret_key;
    private $base_url = 'https://api.paystack.co';
    
    public function __construct($secret_key) {
        $this->secret_key = $secret_key;
    }
    
    /**
     * Initialize a payment transaction
     */
    public function initialize_transaction($email, $amount, $reference, $metadata = array()) {
        $url = $this->base_url . '/transaction/initialize';
        
        $fields = array(
            'email' => $email,
            'amount' => $amount * 100, // Convert to kobo
            'reference' => $reference,
            'currency' => 'NGN',
            'metadata' => $metadata,
            'callback_url' => home_url('/payment-callback/')
        );
        
        $response = $this->make_request($url, 'POST', $fields);
        
        return $response;
    }
    
    /**
     * Verify a transaction
     */
    public function verify_transaction($reference) {
        $url = $this->base_url . '/transaction/verify/' . $reference;
        
        $response = $this->make_request($url, 'GET');
        
        return $response;
    }
    
    /**
     * Make API request
     */
    private function make_request($url, $method = 'GET', $data = array()) {
        $args = array(
            'method' => $method,
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->secret_key,
                'Content-Type' => 'application/json',
            ),
            'timeout' => 60,
        );
        
        if ($method === 'POST' && !empty($data)) {
            $args['body'] = json_encode($data);
        }
        
        $response = wp_remote_request($url, $args);
        
        if (is_wp_error($response)) {
            return array(
                'status' => false,
                'message' => $response->get_error_message()
            );
        }
        
        $body = wp_remote_retrieve_body($response);
        $result = json_decode($body, true);
        
        return $result;
    }
    
    /**
     * Get transaction details
     */
    public function get_transaction($transaction_id) {
        $url = $this->base_url . '/transaction/' . $transaction_id;
        
        $response = $this->make_request($url, 'GET');
        
        return $response;
    }
}
