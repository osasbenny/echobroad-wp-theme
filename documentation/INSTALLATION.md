# EchoBroad WordPress Theme - Installation Guide

## Quick Start

This WordPress theme replicates the complete EchoBroad Agency website with all functionality, styling, and features.

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- MySQL 5.6 or higher

## Installation Steps

### 1. Download the Theme

Clone or download the theme from GitHub:
```bash
git clone https://github.com/osasbenny/echobroad-wp-theme.git
```

### 2. Upload to WordPress

**Option A: Via WordPress Admin**
1. Compress the theme folder as a ZIP file
2. Go to WordPress Admin > Appearance > Themes
3. Click "Add New" > "Upload Theme"
4. Choose the ZIP file and click "Install Now"
5. Click "Activate"

**Option B: Via FTP/File Manager**
1. Upload the `echobroad-wp-theme` folder to `/wp-content/themes/`
2. Go to WordPress Admin > Appearance > Themes
3. Find "EchoBroad" and click "Activate"

### 3. Install the Contact Form Plugin

1. Copy the `echobroad-contact-plugin` folder to `/wp-content/plugins/`
2. Go to WordPress Admin > Plugins
3. Find "EchoBroad Contact Form" and click "Activate"

### 4. Configure Theme Settings

#### Upload Logo
1. Go to Appearance > Customize > Site Identity
2. Upload your logo image (recommended size: 200x60px)

#### Set Up Navigation Menu
1. Go to Appearance > Menus
2. Create a new menu with these items:
   - Home
   - About Us
   - Our Services
   - E-Store
   - Courses
   - Blog
   - Contact
3. Assign to "Primary Menu" location

#### Configure Contact Information
1. Go to Appearance > Customize > Contact Information
2. Enter:
   - Email: info@echobroad.com
   - Phone: +2348071447959
   - Address: 39 East West Road, Rumuodara, Port Harcourt

#### Add Social Media Links
1. Go to Appearance > Customize > Social Media Links
2. Add URLs for:
   - Facebook
   - Instagram
   - LinkedIn
   - YouTube

### 5. Create Required Pages

#### Homepage
1. Create a new page titled "Home"
2. Leave content empty (uses template-parts/content-home.php)
3. Go to Settings > Reading
4. Set "Your homepage displays" to "A static page"
5. Select "Home" as the homepage

#### Blog Page
1. Create a new page titled "Blog"
2. Go to Settings > Reading
3. Select "Blog" as the posts page

#### Contact Page
1. Create a new page titled "Contact"
2. In Page Attributes, select Template: "Contact Page"
3. Publish

#### Other Pages
Create these pages with your content:
- About Us
- Services (optional, or use archive)
- Courses (optional, or use archive)
- Products (optional, or use archive)

### 6. Add Content

#### Services
1. Go to Services > Add New
2. Add title, description, and featured image
3. Publish (repeat for all services)

#### Courses
1. Go to Courses > Add New
2. Add title and description
3. Fill in Course Details:
   - Price (in Naira)
   - Level (e.g., "Beginner to Advanced")
   - Duration (e.g., "6 weeks")
4. Publish

#### Products
1. Go to Products > Add New
2. Add title and description
3. Fill in Product Details:
   - Price (in Naira)
   - Icon Class (Font Awesome class, e.g., "fa-shopping-bag")
4. Publish

#### Testimonials
1. Go to Testimonials > Add New
2. Add testimonial text as content
3. Fill in Testimonial Details:
   - Author Name
   - Position/Title
   - Rating (1-5 stars)
4. Publish

#### Blog Posts
1. Go to Posts > Add New
2. Add title, content, and featured image
3. Assign categories
4. Publish

### 7. Customize Brand Logos

Replace placeholder brand logos in `/images/` folder:
- brand-1.png through brand-10.png
- Recommended size: 150x80px
- Use PNG format with transparent background

## Features Included

### Theme Features
- Fully responsive design
- Custom post types (Services, Courses, Products, Testimonials)
- Custom meta boxes for pricing and details
- FAQ accordion functionality
- Smooth scroll animations
- Mobile-friendly navigation
- Scroll-to-top button
- Social media integration

### Contact Form Features
- AJAX form submission
- Email notifications
- Database storage of submissions
- Admin interface to view submissions
- Spam protection with nonce verification

## Color Scheme

The theme uses these exact colors from the original site:
- Navy Blue: #001233
- Primary Red: #FF0050
- Primary Yellow: #FFB800
- White: #FFFFFF
- Light Gray: #F5F5F5

## Shortcodes

### Contact Form
Display the contact form anywhere:
```
[echobroad_contact_form]
```

## Troubleshooting

### Menu Not Showing
- Ensure you've created a menu and assigned it to "Primary Menu" location

### Contact Form Not Working
- Ensure the EchoBroad Contact Form plugin is activated
- Check that your server can send emails (test with other plugins)

### Styling Issues
- Clear browser cache
- Clear WordPress cache (if using a caching plugin)
- Ensure no other plugins are conflicting with styles

### Missing Icons
- The theme uses Font Awesome 6.4.0 CDN
- Ensure your server allows external CSS files

## Support

For theme support and customization:
- Email: info@echobroad.com
- Website: https://echobroad.com
- GitHub: https://github.com/osasbenny/echobroad-wp-theme

## Credits

- Theme Design: EchoBroad Team
- Original Website: https://echobroad.com
- Developed by: EchoBroad Team
- Repository: https://github.com/osasbenny/echobroad-wp-theme

## License

This theme is licensed under the GNU General Public License v2 or later.

## Changelog

### Version 1.0.0 (January 2026)
- Initial release
- Complete website replication
- All sections and functionality implemented
- Contact form plugin included
- Responsive design
- Custom post types
- Admin customization options
