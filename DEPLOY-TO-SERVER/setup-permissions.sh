#!/bin/bash
# Setup script for Laravel production server
# Run this on the production server to fix permissions

echo "Setting up Laravel permissions..."

# Set bootstrap/cache permissions (Linux)
chmod -R 775 bootstrap/cache
chown -R www-data:www-data bootstrap/cache

# Set storage permissions
chmod -R 775 storage
chown -R www-data:www-data storage

# Create cache files if they don't exist
touch bootstrap/cache/services.php
touch bootstrap/cache/packages.php
chmod 664 bootstrap/cache/services.php
chmod 664 bootstrap/cache/packages.php

echo "Permissions set successfully!"

