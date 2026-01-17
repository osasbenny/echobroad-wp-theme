<?php
/**
 * Order Manager
 *
 * @package EchoBroad_Paystack
 */

if (!defined('ABSPATH')) {
    exit;
}

class EchoBroad_Order_Manager {
    
    /**
     * Create a new order
     */
    public static function create_order($data) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'echobroad_orders';
        
        $order_id = 'ORD_' . time() . '_' . rand(1000, 9999);
        
        $insert_data = array(
            'order_id' => $order_id,
            'reference' => $data['reference'],
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => isset($data['customer_phone']) ? $data['customer_phone'] : '',
            'item_id' => $data['item_id'],
            'item_type' => $data['item_type'],
            'item_name' => $data['item_name'],
            'amount' => $data['amount'],
            'status' => $data['status'],
            'created_at' => current_time('mysql')
        );
        
        $result = $wpdb->insert($table_name, $insert_data);
        
        if ($result) {
            // Send order confirmation email
            self::send_order_email($order_id, $insert_data);
            return $order_id;
        }
        
        return false;
    }
    
    /**
     * Update order status
     */
    public static function update_order_status($reference, $status, $transaction_id = '') {
        global $wpdb;
        $table_name = $wpdb->prefix . 'echobroad_orders';
        
        $update_data = array(
            'status' => $status,
            'updated_at' => current_time('mysql')
        );
        
        if ($transaction_id) {
            $update_data['transaction_id'] = $transaction_id;
        }
        
        $result = $wpdb->update(
            $table_name,
            $update_data,
            array('reference' => $reference)
        );
        
        if ($result !== false && $status === 'completed') {
            // Get order details
            $order = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM $table_name WHERE reference = %s",
                $reference
            ));
            
            if ($order) {
                // Send payment success email
                self::send_payment_success_email($order);
            }
        }
        
        return $result;
    }
    
    /**
     * Get order by reference
     */
    public static function get_order_by_reference($reference) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'echobroad_orders';
        
        return $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $table_name WHERE reference = %s",
            $reference
        ));
    }
    
    /**
     * Get all orders
     */
    public static function get_orders($limit = 50) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'echobroad_orders';
        
        return $wpdb->get_results(
            "SELECT * FROM $table_name ORDER BY created_at DESC LIMIT $limit"
        );
    }
    
    /**
     * Send order confirmation email
     */
    private static function send_order_email($order_id, $data) {
        $to = $data['customer_email'];
        $subject = 'Order Confirmation - EchoBroad Agency';
        
        $message = "Dear {$data['customer_name']},\n\n";
        $message .= "Thank you for your order!\n\n";
        $message .= "Order Details:\n";
        $message .= "Order ID: {$order_id}\n";
        $message .= "Item: {$data['item_name']}\n";
        $message .= "Amount: ₦" . number_format($data['amount']) . "\n\n";
        $message .= "Please complete your payment to access your purchase.\n\n";
        $message .= "Best regards,\n";
        $message .= "EchoBroad Team\n";
        $message .= "info@echobroad.com\n";
        $message .= "+2349071447959";
        
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        
        wp_mail($to, $subject, $message, $headers);
        
        // Send copy to admin
        wp_mail('info@echobroad.com', 'New Order: ' . $order_id, $message, $headers);
    }
    
    /**
     * Send payment success email
     */
    private static function send_payment_success_email($order) {
        $to = $order->customer_email;
        $subject = 'Payment Successful - EchoBroad Agency';
        
        $message = "Dear {$order->customer_name},\n\n";
        $message .= "Your payment has been received successfully!\n\n";
        $message .= "Order Details:\n";
        $message .= "Order ID: {$order->order_id}\n";
        $message .= "Reference: {$order->reference}\n";
        $message .= "Item: {$order->item_name}\n";
        $message .= "Amount Paid: ₦" . number_format($order->amount) . "\n";
        $message .= "Transaction ID: {$order->transaction_id}\n\n";
        
        if ($order->item_type === 'course') {
            $message .= "You can now access your course materials. Please check your email for access details.\n\n";
        } else {
            $message .= "Your digital product will be delivered to your email shortly.\n\n";
        }
        
        $message .= "If you have any questions, please contact us:\n";
        $message .= "Email: info@echobroad.com\n";
        $message .= "Phone: +2349071447959\n\n";
        $message .= "Thank you for choosing EchoBroad!\n\n";
        $message .= "Best regards,\n";
        $message .= "EchoBroad Team";
        
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        
        wp_mail($to, $subject, $message, $headers);
        
        // Send notification to admin
        $admin_message = "New payment received!\n\n";
        $admin_message .= "Customer: {$order->customer_name} ({$order->customer_email})\n";
        $admin_message .= "Item: {$order->item_name}\n";
        $admin_message .= "Amount: ₦" . number_format($order->amount) . "\n";
        $admin_message .= "Order ID: {$order->order_id}\n";
        $admin_message .= "Reference: {$order->reference}";
        
        wp_mail('info@echobroad.com', 'New Payment Received: ' . $order->order_id, $admin_message, $headers);
    }
}
