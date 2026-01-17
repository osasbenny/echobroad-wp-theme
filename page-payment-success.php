<?php
/**
 * Template Name: Payment Success
 *
 * @package EchoBroad
 */

get_header();
?>

<section class="section payment-result-section">
    <div class="container">
        <div class="payment-result-card success">
            <div class="payment-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Payment Successful!</h1>
            <p class="payment-message">Thank you for your purchase. Your payment has been processed successfully.</p>
            
            <?php
            $reference = isset($_GET['reference']) ? sanitize_text_field($_GET['reference']) : '';
            if ($reference) {
                echo '<p class="reference-number">Reference: <strong>' . esc_html($reference) . '</strong></p>';
                
                // Get order details
                if (class_exists('EchoBroad_Order_Manager')) {
                    $order = EchoBroad_Order_Manager::get_order_by_reference($reference);
                    if ($order) {
                        ?>
                        <div class="order-details">
                            <h3>Order Details</h3>
                            <table>
                                <tr>
                                    <td><strong>Order ID:</strong></td>
                                    <td><?php echo esc_html($order->order_id); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Item:</strong></td>
                                    <td><?php echo esc_html($order->item_name); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Amount Paid:</strong></td>
                                    <td>₦<?php echo number_format($order->amount); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td><span class="status-badge success"><?php echo esc_html(ucfirst($order->status)); ?></span></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    }
                }
            }
            ?>
            
            <div class="next-steps">
                <h3>What's Next?</h3>
                <ul>
                    <li><i class="fas fa-envelope"></i> Check your email for order confirmation and access details</li>
                    <li><i class="fas fa-book"></i> Access your purchased content from your account</li>
                    <li><i class="fas fa-headset"></i> Contact support if you need any assistance</li>
                </ul>
            </div>
            
            <div class="action-buttons">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="cta-button">Back to Home</a>
                <a href="<?php echo esc_url(home_url('/courses')); ?>" class="cta-button cta-button-yellow">Browse More Courses</a>
            </div>
        </div>
    </div>
</section>

<style>
.payment-result-section {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
}

.payment-result-card {
    background: white;
    padding: 50px;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 700px;
    margin: 0 auto;
}

.payment-result-card.success {
    border-top: 5px solid #28a745;
}

.payment-icon {
    font-size: 80px;
    margin-bottom: 20px;
}

.payment-result-card.success .payment-icon {
    color: #28a745;
}

.payment-result-card h1 {
    color: #001233;
    margin-bottom: 15px;
}

.payment-message {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
}

.reference-number {
    background: #F5F5F5;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 30px;
    font-size: 16px;
}

.order-details {
    text-align: left;
    margin: 30px 0;
    padding: 20px;
    background: #F5F5F5;
    border-radius: 8px;
}

.order-details h3 {
    color: #001233;
    margin-bottom: 15px;
    text-align: center;
}

.order-details table {
    width: 100%;
    border-collapse: collapse;
}

.order-details table td {
    padding: 10px;
    border-bottom: 1px solid #E0E0E0;
}

.order-details table tr:last-child td {
    border-bottom: none;
}

.status-badge {
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: bold;
}

.status-badge.success {
    background: #28a745;
    color: white;
}

.next-steps {
    text-align: left;
    margin: 30px 0;
}

.next-steps h3 {
    color: #001233;
    margin-bottom: 15px;
}

.next-steps ul {
    list-style: none;
    padding: 0;
}

.next-steps ul li {
    padding: 10px 0;
    font-size: 16px;
    color: #666;
}

.next-steps ul li i {
    color: #FF0050;
    margin-right: 10px;
}

.action-buttons {
    margin-top: 30px;
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .payment-result-card {
        padding: 30px 20px;
    }
    
    .payment-icon {
        font-size: 60px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .action-buttons .cta-button {
        width: 100%;
    }
}
</style>

<?php get_footer(); ?>
