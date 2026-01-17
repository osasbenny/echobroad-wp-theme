# EchoBroad Contact Form Plugin

A custom WordPress plugin for handling contact form submissions with email notifications and database storage.

## Features

- AJAX-powered contact form
- Email notifications to site admin
- Database storage of all submissions
- Admin interface to view submissions
- Security with nonce verification
- Input validation and sanitization

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcode `[echobroad_contact_form]` to display the form

## Usage

Add the shortcode to any page or post:
```
[echobroad_contact_form]
```

## Admin Interface

View all contact form submissions in WordPress admin:
- Navigate to "Contact Forms" in the admin menu
- View all submissions with date, name, email, phone, subject, and message

## Database

The plugin creates a custom table `wp_echobroad_contacts` to store all submissions.

## Support

For support, contact the EchoBroad Team at info@echobroad.com
