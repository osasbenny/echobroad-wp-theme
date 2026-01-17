# EchoBroad WordPress Theme & Plugins

Complete WordPress theme replication of [echobroad.com](https://echobroad.com) with Paystack payment integration.

## 📁 Repository Structure

```
echobroad-wp-theme/
├── theme/                          # WordPress Theme Files
│   ├── style.css
│   ├── functions.php
│   ├── header.php
│   ├── footer.php
│   ├── index.php
│   ├── single.php
│   ├── archive.php
│   ├── page.php
│   ├── page-contact.php
│   ├── page-payment-success.php
│   ├── page-payment-failed.php
│   ├── template-parts/
│   ├── js/
│   ├── css/
│   └── images/
│
├── plugins/                        # WordPress Plugins
│   ├── echobroad-paystack-plugin/  # Payment Gateway
│   └── echobroad-contact-plugin/   # Contact Form
│
└── documentation/                  # Setup Guides
    ├── INSTALLATION.md
    ├── PAYMENT-INTEGRATION.md
    └── wp-config-snippet.php
```

## 🚀 Quick Installation

### 1. Upload Theme

**Option A: WordPress Admin**
1. Download/clone this repository
2. Zip the `theme` folder
3. Go to WordPress Admin > Appearance > Themes > Add New > Upload
4. Upload the ZIP and activate

**Option B: FTP**
1. Upload the `theme` folder to `/wp-content/themes/echobroad/`
2. Activate in WordPress Admin > Appearance > Themes

### 2. Upload Plugins

**Paystack Payment Plugin:**
1. Zip the `plugins/echobroad-paystack-plugin` folder
2. Go to WordPress Admin > Plugins > Add New > Upload
3. Upload and activate

**Contact Form Plugin:**
1. Zip the `plugins/echobroad-contact-plugin` folder
2. Go to WordPress Admin > Plugins > Add New > Upload
3. Upload and activate

**Or via FTP:**
- Upload both plugin folders to `/wp-content/plugins/`
- Activate in WordPress Admin > Plugins

### 3. Configure Paystack API Keys

Add to your `wp-config.php` file:

```php
define('ECHOBROAD_PAYSTACK_PUBLIC_KEY', 'your_public_key_here');
define('ECHOBROAD_PAYSTACK_SECRET_KEY', 'your_secret_key_here');
```

See `documentation/wp-config-snippet.php` for details.

## 📦 What's Included

### Theme Features
- ✅ Exact design replication of echobroad.com
- ✅ Responsive mobile-first design
- ✅ Custom post types (Services, Courses, Products, Testimonials)
- ✅ Homepage with all sections
- ✅ FAQ accordion
- ✅ WhatsApp chat integration
- ✅ Smooth animations
- ✅ Social media integration

### Paystack Payment Plugin
- ✅ Automatic "Buy Now" buttons
- ✅ Secure payment processing
- ✅ Order management dashboard
- ✅ Email notifications
- ✅ Transaction verification
- ✅ Test and Live mode

### Contact Form Plugin
- ✅ AJAX form submission
- ✅ Email notifications
- ✅ Database storage
- ✅ Admin interface

## 📖 Documentation

Detailed guides are in the `documentation/` folder:

- **INSTALLATION.md** - Complete theme setup guide
- **PAYMENT-INTEGRATION.md** - Paystack payment setup
- **wp-config-snippet.php** - API key configuration template

## 🎨 Design Specifications

### Color Scheme
- Navy Blue: #001233
- Primary Red: #FF0050
- Primary Yellow: #FFB800
- White: #FFFFFF
- Light Gray: #F5F5F5

## 🔧 Requirements

- WordPress 5.0+
- PHP 7.4+
- MySQL 5.6+
- SSL certificate (for live payments)

## 📞 Support

- **Email**: info@echobroad.com
- **Phone**: +2349071447959
- **Website**: https://echobroad.com

## 📝 License

GPL v2 or later

## 👥 Credits

- **Designed by**: EchoBroad Team
- **Original Website**: https://echobroad.com
- **Repository**: https://github.com/osasbenny/echobroad-wp-theme

---

## 🎯 Quick Start Checklist

- [ ] Upload and activate theme
- [ ] Upload and activate both plugins
- [ ] Add Paystack API keys to wp-config.php
- [ ] Create navigation menu
- [ ] Create payment success/failed pages
- [ ] Set homepage (Settings > Reading)
- [ ] Flush permalinks (Settings > Permalinks > Save)
- [ ] Add content (services, courses, products)
- [ ] Test payment flow
- [ ] Go live!

For detailed instructions, see the documentation folder.
