<?php
/**
 * EchoBroad Paystack API Keys Configuration
 * 
 * Add these lines to your wp-config.php file (before "That's all, stop editing!" line)
 * This keeps your API keys secure and out of the repository.
 */

// Paystack Live API Keys
// Replace these with your actual Paystack API keys
define('ECHOBROAD_PAYSTACK_PUBLIC_KEY', 'pk_live_YOUR_PUBLIC_KEY_HERE');
define('ECHOBROAD_PAYSTACK_SECRET_KEY', 'sk_live_YOUR_SECRET_KEY_HERE');

// Optional: Set payment mode (defaults to 'live' if not set)
// define('ECHOBROAD_PAYSTACK_MODE', 'live'); // or 'test'
