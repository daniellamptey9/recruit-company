#!/bin/bash
# Run this script AFTER deploying from Git via cPanel
# This will install Composer dependencies

echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

echo "Setting up storage permissions..."
chmod -R 775 storage bootstrap/cache

echo "Creating cache files..."
touch bootstrap/cache/services.php bootstrap/cache/packages.php
chmod 664 bootstrap/cache/*.php

echo "Cache optimization..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment complete!"
echo ""
echo "If you see any errors, make sure:"
echo "1. PHP version is 8.1 or higher"
echo "2. Composer is installed on the server"
echo "3. File permissions are set correctly (775 for directories, 664 for files)"

