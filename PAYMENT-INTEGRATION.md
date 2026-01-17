# EchoBroad WordPress Theme - Paystack Payment Integration

## 🎉 Payment Integration Complete!

The EchoBroad WordPress theme now includes a fully functional **Paystack payment gateway** for processing payments on Products and Courses.

## 📦 What's Included

### Custom Paystack Plugin

A lightweight, custom-built payment plugin specifically designed for EchoBroad:

**Location**: `echobroad-paystack-plugin/`

**Features**:
- ✅ Direct Paystack API integration
- ✅ Automatic "Buy Now" buttons on all products and courses
- ✅ Beautiful payment modal with customer form
- ✅ Secure transaction processing
- ✅ Order management system
- ✅ Email notifications (customer + admin)
- ✅ Admin dashboard for viewing orders
- ✅ Payment success/failed pages
- ✅ Mobile responsive design
- ✅ Secure API key storage via wp-config.php

## 🔐 Secure API Key Configuration

Your Paystack API keys should be stored securely in `wp-config.php` (not in the database or repository).

### Step 1: Add API Keys to wp-config.php

Open your WordPress `wp-config.php` file and add these lines **before** the line that says `/* That's all, stop editing! Happy publishing. */`:

```php
// EchoBroad Paystack API Keys
define('ECHOBROAD_PAYSTACK_PUBLIC_KEY', 'pk_live_YOUR_PUBLIC_KEY_HERE');
define('ECHOBROAD_PAYSTACK_SECRET_KEY', 'sk_live_YOUR_SECRET_KEY_HERE');
```

**Note**: Replace the placeholders with your actual Paystack API keys from your Paystack dashboard.

### Alternative: Use Plugin Settings (Less Secure)

If you prefer, you can also enter the keys in:
**WordPress Admin > Paystack > Settings**

However, storing them in wp-config.php is more secure as they won't be in the database.

## 🚀 Installation

### 1. Install the Plugin

**Option A: Via WordPress Admin**
1. Zip the `echobroad-paystack-plugin` folder
2. Go to WordPress Admin > Plugins > Add New > Upload Plugin
3. Upload the ZIP file and click "Install Now"
4. Click "Activate"

**Option B: Via FTP/File Manager**
1. Upload `echobroad-paystack-plugin` folder to `/wp-content/plugins/`
2. Go to WordPress Admin > Plugins
3. Find "EchoBroad Paystack Payment Gateway" and click "Activate"

### 2. Configure API Keys

**Recommended Method (Secure)**:
1. Open `wp-config.php` in your WordPress root directory
2. Add the API key constants (see above)
3. Save the file

**Alternative Method**:
1. Go to **WordPress Admin > Paystack > Settings**
2. Set Mode to "Live"
3. Enter your API keys
4. Click "Save Changes"

### 3. Create Payment Pages

Create two pages in WordPress:

#### Payment Success Page
- **Title**: Payment Success
- **Template**: Payment Success
- **Slug**: `payment-success`

#### Payment Failed Page
- **Title**: Payment Failed
- **Template**: Payment Failed
- **Slug**: `payment-failed`

### 4. Flush Rewrite Rules

1. Go to **Settings > Permalinks**
2. Click "Save Changes" (no changes needed, just save)
3. This activates the payment callback URL

## 💳 How It Works

### For Customers

1. **Browse** products or courses on your site
2. **Click "Buy Now"** button on any product/course
3. **Fill in details** (name, email, phone) in the payment modal
4. **Click "Pay Now"** to open Paystack payment window
5. **Complete payment** using card, bank transfer, or USSD
6. **Redirected** to success page with order confirmation
7. **Receive email** with purchase details and access info

### For Admins

1. **View all orders** at WordPress Admin > Paystack > Orders
2. **Receive email notifications** for every new payment
3. **Track order status** (pending, completed, failed)
4. **Access customer details** for fulfillment

## 📊 Admin Dashboard

### Viewing Orders

Navigate to: **WordPress Admin > Paystack > Orders**

**Order Information Displayed**:
- Order ID
- Customer name and email
- Item purchased
- Amount paid (in Naira)
- Payment status
- Transaction date

### Managing Settings

Navigate to: **WordPress Admin > Paystack > Settings**

**Available Settings**:
- Payment mode (Test/Live)
- Test API keys
- Live API keys

**Note**: If API keys are defined in wp-config.php, they will take priority over settings.

## 📧 Email Notifications

### Customer Emails

**1. Order Confirmation**
- Sent when order is created
- Contains order details and payment instructions

**2. Payment Success**
- Sent when payment is verified
- Contains order confirmation and access details
- Includes transaction ID and reference number

### Admin Notifications

All customer emails are also sent to: **info@echobroad.com**

## 🔒 Security Features

- ✅ API keys stored in wp-config.php (outside web root)
- ✅ AJAX nonce verification for all requests
- ✅ Input sanitization and validation
- ✅ Transaction verification before order completion
- ✅ SQL injection protection with prepared statements
- ✅ XSS protection with proper escaping
- ✅ Keys not stored in repository or database

## 🎨 Customization

### Payment Button Styling

The "Buy Now" button inherits your theme's `.cta-button` styles.

### Payment Modal

Customize the modal appearance in:
- `echobroad-paystack-plugin/assets/css/paystack.css`

### Email Templates

Modify email content in:
- `echobroad-paystack-plugin/includes/class-order-manager.php`
- Functions: `send_order_email()` and `send_payment_success_email()`

## 🧪 Testing

### Test Mode

To test payments without real transactions:

1. Add test keys to wp-config.php:
```php
define('ECHOBROAD_PAYSTACK_PUBLIC_KEY', 'pk_test_YOUR_TEST_KEY');
define('ECHOBROAD_PAYSTACK_SECRET_KEY', 'sk_test_YOUR_TEST_KEY');
```

2. Or set in **Paystack > Settings**:
   - Change mode to "Test"
   - Add your test API keys from Paystack dashboard

3. Use Paystack test cards

### Test Cards

Use these cards in test mode:

**Successful Payment**:
- Card: 4084084084084081
- CVV: Any 3 digits
- Expiry: Any future date
- PIN: 0000

**Insufficient Funds**:
- Card: 4084080000000408

**Declined Transaction**:
- Card: 4084084084084081
- CVV: 408

## 💡 Usage Examples

### Adding Products

1. Go to **Products > Add New**
2. Add title and description
3. Set featured image
4. In "Product Details" meta box, add:
   - **Price**: 7500 (without comma or currency symbol)
   - **Icon Class**: fa-shopping-bag
5. Publish

The "Buy Now" button will automatically appear with the price.

### Adding Courses

1. Go to **Courses > Add New**
2. Add title and description
3. In "Course Details" meta box, add:
   - **Price**: 35000
   - **Level**: Beginner to Advanced
   - **Duration**: 6 weeks
4. Publish

The "Buy Now" button will automatically appear with the price.

## 🔧 Technical Details

### API Key Priority

The plugin checks for API keys in this order:
1. **wp-config.php constants** (highest priority)
2. **Plugin settings** (fallback)

### Database Table

**Table Name**: `wp_echobroad_orders`

**Columns**:
- id (auto-increment)
- order_id (unique)
- reference (Paystack reference)
- customer_name
- customer_email
- customer_phone
- item_id
- item_type (product/course)
- item_name
- amount
- status (pending/completed/failed)
- transaction_id
- created_at
- updated_at

### API Endpoints

**Initialize Payment**:
- Action: `echobroad_initialize_payment`
- Method: POST (AJAX)

**Verify Payment**:
- Action: `echobroad_verify_payment`
- Method: POST (AJAX)

**Payment Callback**:
- URL: `https://yourdomain.com/payment-callback/`
- Handles Paystack redirect after payment

## 📋 Requirements

- WordPress 5.0+
- PHP 7.4+
- MySQL 5.6+
- SSL certificate (required for live payments)
- Active Paystack account

## 🆘 Troubleshooting

### Payment Modal Not Opening

**Solution**: Clear browser cache and check browser console for errors

### "No API Key" Error

**Solution**: 
- Verify API keys are added to wp-config.php
- Or add them in Paystack > Settings
- Check for typos in constant names

### Buy Button Not Showing

**Solution**: 
- Ensure plugin is activated
- Verify post type is "product" or "course"
- Check that price meta field is set

### Orders Not Saving

**Solution**:
- Check database table was created
- Verify WordPress database permissions
- Check PHP error logs

### Emails Not Sending

**Solution**:
- Test WordPress email with other plugins
- Install SMTP plugin for reliable email delivery
- Check spam folders

### Payment Verification Failed

**Solution**:
- Verify API keys are correct
- Check payment mode matches keys (Test/Live)
- Ensure SSL is active for live payments

## 📞 Support

For payment integration support:

- **Email**: info@echobroad.com
- **Phone**: +2349071447959
- **WhatsApp**: https://wa.me/2349071447959

## 🎯 Quick Setup Checklist

1. ✅ Install and activate the plugin
2. ✅ Add API keys to wp-config.php
3. ✅ Create payment success/failed pages
4. ✅ Flush permalinks (Settings > Permalinks > Save)
5. ✅ Add products and courses with prices
6. ✅ Test payment flow
7. ✅ Configure email delivery (optional SMTP)
8. ✅ Go live!

## 🌟 Features Summary

| Feature | Status |
|---------|--------|
| Paystack Integration | ✅ Complete |
| Secure Key Storage | ✅ wp-config.php |
| Auto Buy Buttons | ✅ Complete |
| Payment Modal | ✅ Complete |
| Order Management | ✅ Complete |
| Email Notifications | ✅ Complete |
| Admin Dashboard | ✅ Complete |
| Success/Failed Pages | ✅ Complete |
| Mobile Responsive | ✅ Complete |
| Security | ✅ Enterprise-grade |

Your EchoBroad WordPress theme is now fully payment-enabled with secure API key management! 🎉
