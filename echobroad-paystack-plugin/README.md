# EchoBroad Paystack Payment Gateway

A custom WordPress plugin for seamless Paystack payment integration with EchoBroad products and courses.

## Features

- ✅ Direct Paystack API integration
- ✅ Secure payment processing
- ✅ Automatic "Buy Now" buttons on products and courses
- ✅ Beautiful payment modal with customer information form
- ✅ Order management system
- ✅ Email notifications (customer and admin)
- ✅ Transaction verification
- ✅ Admin dashboard for viewing orders
- ✅ Test and Live mode support
- ✅ Mobile responsive design

## Installation

1. Copy the `echobroad-paystack-plugin` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The plugin will automatically create the orders database table
4. Default Live API keys are pre-configured

## Configuration

### Setting Up API Keys

1. Go to **WordPress Admin > Paystack > Settings**
2. Choose your payment mode (Test or Live)
3. Enter your Paystack API keys (get them from your Paystack dashboard)
4. Click "Save Changes"

**Note**: For better security, use wp-config.php constants instead (see below).

### Secure Configuration

For security, API keys should be stored in `wp-config.php`:

```php
define('ECHOBROAD_PAYSTACK_PUBLIC_KEY', 'your_public_key_here');
define('ECHOBROAD_PAYSTACK_SECRET_KEY', 'your_secret_key_here');
```

Alternatively, you can enter them in the plugin settings page.

## How It Works

### Automatic Buy Buttons

The plugin automatically adds "Buy Now" buttons to:
- All **Product** posts (custom post type)
- All **Course** posts (custom post type)

The button displays the price and item name from post meta.

### Payment Flow

1. **Customer clicks "Buy Now"** → Payment modal opens
2. **Customer fills in details** → Name, email, phone
3. **Customer clicks "Pay Now"** → Paystack payment window opens
4. **Customer completes payment** → Paystack processes transaction
5. **Payment verified** → Order status updated to "completed"
6. **Emails sent** → Confirmation to customer and admin
7. **Redirect to success page** → Customer sees order details

### Payment Pages

The theme includes two payment result pages:
- **Payment Success** (`page-payment-success.php`) - Shows order confirmation
- **Payment Failed** (`page-payment-failed.php`) - Shows failure message with support info

## Admin Features

### Viewing Orders

1. Go to **WordPress Admin > Paystack > Orders**
2. View all payment orders with:
   - Order ID
   - Customer name and email
   - Item purchased
   - Amount paid
   - Payment status
   - Transaction date

### Order Statuses

- **Pending** - Payment initiated but not completed
- **Completed** - Payment successful and verified
- **Failed** - Payment failed or cancelled

## Email Notifications

### Customer Emails

1. **Order Confirmation** - Sent when order is created
2. **Payment Success** - Sent when payment is verified

### Admin Emails

- Copy of all customer emails sent to: `info@echobroad.com`
- Includes order details and customer information

## Security Features

- ✅ AJAX nonce verification
- ✅ Input sanitization and validation
- ✅ Secure API key storage
- ✅ Transaction verification before order completion
- ✅ SQL injection protection

## Database

The plugin creates a custom table: `wp_echobroad_orders`

**Table Structure:**
- Order ID
- Payment reference
- Customer details (name, email, phone)
- Item details (ID, type, name)
- Amount
- Status
- Transaction ID
- Timestamps

## API Integration

### Paystack API Endpoints Used

1. **Initialize Transaction** - `/transaction/initialize`
2. **Verify Transaction** - `/transaction/verify/:reference`

### Callback URL

The plugin registers a custom callback URL:
- `https://yourdomain.com/payment-callback/`

This URL handles payment verification after Paystack redirect.

## Customization

### Styling

Payment modal styles are in:
- `assets/css/paystack.css`

### JavaScript

Payment handling logic is in:
- `assets/js/paystack.js`

### Modifying Email Templates

Edit the email functions in:
- `includes/class-order-manager.php`

## Testing

### Test Mode

1. Set payment mode to "Test" in settings
2. Add your test API keys from Paystack dashboard
3. Use Paystack test cards for testing

### Test Cards

Paystack provides test cards for different scenarios:
- **Success**: 4084084084084081
- **Insufficient Funds**: 4084080000000408
- **Declined**: 4084084084084081 (with CVV 408)

## Troubleshooting

### Payment Not Processing

- Check that API keys are correct
- Verify payment mode matches your keys (Test/Live)
- Check browser console for JavaScript errors

### Orders Not Showing

- Ensure database table was created during activation
- Check WordPress database permissions

### Emails Not Sending

- Test WordPress email functionality
- Check spam folders
- Consider using an SMTP plugin

## Support

For support and customization:
- **Email**: info@echobroad.com
- **Phone**: +2349071447959
- **WhatsApp**: https://wa.me/2349071447959

## Requirements

- WordPress 5.0+
- PHP 7.4+
- MySQL 5.6+
- Active Paystack account
- SSL certificate (required for live payments)

## Changelog

### Version 1.0.0
- Initial release
- Paystack API integration
- Order management system
- Email notifications
- Admin dashboard
- Payment success/failed pages
- Pre-configured with Live API keys

## License

GPL v2 or later

## Credits

Developed by **EchoBroad Team**
Website: https://echobroad.com
