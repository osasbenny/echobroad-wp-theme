/**
 * EchoBroad Paystack Payment Handler
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Handle Buy Now button click
        $('.echobroad-buy-button').on('click', function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var itemId = $button.data('item-id');
            var itemType = $button.data('item-type');
            var itemName = $button.data('item-name');
            var price = $button.data('price');
            
            // Show payment form modal
            showPaymentForm(itemId, itemType, itemName, price);
        });
        
        function showPaymentForm(itemId, itemType, itemName, price) {
            // Create modal HTML
            var modalHtml = '<div class="echobroad-payment-modal">' +
                '<div class="payment-modal-content">' +
                '<span class="payment-modal-close">&times;</span>' +
                '<h2>Complete Your Purchase</h2>' +
                '<div class="purchase-summary">' +
                '<h3>' + itemName + '</h3>' +
                '<p class="price">₦' + Number(price).toLocaleString() + '</p>' +
                '</div>' +
                '<form id="echobroad-payment-form">' +
                '<div class="form-group">' +
                '<label for="customer-name">Full Name *</label>' +
                '<input type="text" id="customer-name" name="name" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="customer-email">Email Address *</label>' +
                '<input type="email" id="customer-email" name="email" required>' +
                '</div>' +
                '<div class="form-group">' +
                '<label for="customer-phone">Phone Number</label>' +
                '<input type="tel" id="customer-phone" name="phone">' +
                '</div>' +
                '<button type="submit" class="cta-button">Pay Now</button>' +
                '</form>' +
                '</div>' +
                '</div>';
            
            // Append modal to body
            $('body').append(modalHtml);
            
            // Show modal
            $('.echobroad-payment-modal').fadeIn();
            
            // Close modal on X click
            $('.payment-modal-close').on('click', function() {
                $('.echobroad-payment-modal').fadeOut(function() {
                    $(this).remove();
                });
            });
            
            // Close modal on outside click
            $('.echobroad-payment-modal').on('click', function(e) {
                if ($(e.target).hasClass('echobroad-payment-modal')) {
                    $(this).fadeOut(function() {
                        $(this).remove();
                    });
                }
            });
            
            // Handle form submission
            $('#echobroad-payment-form').on('submit', function(e) {
                e.preventDefault();
                
                var name = $('#customer-name').val();
                var email = $('#customer-email').val();
                var phone = $('#customer-phone').val();
                
                if (!name || !email) {
                    alert('Please fill in all required fields');
                    return;
                }
                
                // Disable submit button
                var $submitBtn = $(this).find('button[type="submit"]');
                $submitBtn.prop('disabled', true).text('Processing...');
                
                // Initialize payment
                initializePayment(itemId, itemType, itemName, price, name, email, phone, $submitBtn);
            });
        }
        
        function initializePayment(itemId, itemType, itemName, price, name, email, phone, $submitBtn) {
            $.ajax({
                url: echobroadPaystack.ajax_url,
                type: 'POST',
                data: {
                    action: 'echobroad_initialize_payment',
                    nonce: echobroadPaystack.nonce || '',
                    item_id: itemId,
                    item_type: itemType,
                    item_name: itemName,
                    price: price,
                    name: name,
                    email: email,
                    phone: phone
                },
                success: function(response) {
                    if (response.success) {
                        // Open Paystack payment modal
                        openPaystackModal(response.data, email, price * 100, $submitBtn);
                    } else {
                        alert('Error: ' + (response.data.message || 'Payment initialization failed'));
                        $submitBtn.prop('disabled', false).text('Pay Now');
                    }
                },
                error: function() {
                    alert('Connection error. Please try again.');
                    $submitBtn.prop('disabled', false).text('Pay Now');
                }
            });
        }
        
        function openPaystackModal(data, email, amount, $submitBtn) {
            var handler = PaystackPop.setup({
                key: echobroadPaystack.public_key,
                email: email,
                amount: amount,
                currency: echobroadPaystack.currency,
                ref: data.reference,
                callback: function(response) {
                    // Payment successful
                    verifyPayment(response.reference, $submitBtn);
                },
                onClose: function() {
                    // User closed payment modal
                    $submitBtn.prop('disabled', false).text('Pay Now');
                }
            });
            
            handler.openIframe();
        }
        
        function verifyPayment(reference, $submitBtn) {
            $.ajax({
                url: echobroadPaystack.ajax_url,
                type: 'POST',
                data: {
                    action: 'echobroad_verify_payment',
                    nonce: echobroadPaystack.nonce || '',
                    reference: reference
                },
                success: function(response) {
                    if (response.success) {
                        // Redirect to success page
                        window.location.href = window.location.origin + '/payment-success/?reference=' + reference;
                    } else {
                        alert('Payment verification failed. Please contact support.');
                        $submitBtn.prop('disabled', false).text('Pay Now');
                    }
                },
                error: function() {
                    alert('Verification error. Please contact support with reference: ' + reference);
                    $submitBtn.prop('disabled', false).text('Pay Now');
                }
            });
        }
        
    });
    
})(jQuery);
