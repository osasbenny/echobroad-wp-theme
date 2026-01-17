<?php
/**
 * Template Name: Payment Failed
 *
 * @package EchoBroad
 */

get_header();
?>

<section class="section payment-result-section">
    <div class="container">
        <div class="payment-result-card failed">
            <div class="payment-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <h1>Payment Failed</h1>
            <p class="payment-message">Unfortunately, your payment could not be processed. Please try again.</p>
            
            <div class="failure-reasons">
                <h3>Common Reasons for Payment Failure:</h3>
                <ul>
                    <li><i class="fas fa-exclamation-circle"></i> Insufficient funds in your account</li>
                    <li><i class="fas fa-exclamation-circle"></i> Incorrect card details</li>
                    <li><i class="fas fa-exclamation-circle"></i> Payment was cancelled</li>
                    <li><i class="fas fa-exclamation-circle"></i> Network connection issues</li>
                </ul>
            </div>
            
            <div class="help-section">
                <h3>Need Help?</h3>
                <p>If you continue to experience issues, please contact our support team:</p>
                <div class="contact-info">
                    <p><i class="fas fa-envelope"></i> <a href="mailto:info@echobroad.com">info@echobroad.com</a></p>
                    <p><i class="fas fa-phone"></i> <a href="tel:+2349071447959">+2349071447959</a></p>
                    <p><i class="fab fa-whatsapp"></i> <a href="https://wa.me/2349071447959" target="_blank">Chat on WhatsApp</a></p>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="javascript:history.back()" class="cta-button">Try Again</a>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="cta-button cta-button-navy">Back to Home</a>
            </div>
        </div>
    </div>
</section>

<style>
.payment-result-card.failed {
    border-top: 5px solid #dc3545;
}

.payment-result-card.failed .payment-icon {
    color: #dc3545;
}

.failure-reasons {
    text-align: left;
    margin: 30px 0;
    padding: 20px;
    background: #FFF5F5;
    border-radius: 8px;
    border-left: 4px solid #dc3545;
}

.failure-reasons h3 {
    color: #001233;
    margin-bottom: 15px;
}

.failure-reasons ul {
    list-style: none;
    padding: 0;
}

.failure-reasons ul li {
    padding: 8px 0;
    font-size: 16px;
    color: #666;
}

.failure-reasons ul li i {
    color: #dc3545;
    margin-right: 10px;
}

.help-section {
    margin: 30px 0;
    padding: 20px;
    background: #F5F5F5;
    border-radius: 8px;
}

.help-section h3 {
    color: #001233;
    margin-bottom: 10px;
}

.help-section p {
    color: #666;
    margin-bottom: 15px;
}

.contact-info {
    margin-top: 15px;
}

.contact-info p {
    margin: 10px 0;
    font-size: 16px;
}

.contact-info a {
    color: #FF0050;
    text-decoration: none;
    font-weight: 600;
}

.contact-info a:hover {
    text-decoration: underline;
}

.contact-info i {
    margin-right: 8px;
    color: #001233;
}
</style>

<?php get_footer(); ?>
