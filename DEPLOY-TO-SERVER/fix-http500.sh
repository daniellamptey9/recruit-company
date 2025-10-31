#!/bin/bash
# Comprehensive HTTP 500 Fix Script for Laravel
# Run this on your production server

echo "========================================="
echo "HTTP 500 Error - Diagnostic & Fix Script"
echo "========================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}✓${NC} $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

echo ""
echo "1. Checking PHP Version..."
PHP_VERSION=$(php -v | head -n 1 | cut -d " " -f 2 | cut -c 1-3)
REQUIRED_VERSION="8.1"
if (( $(echo "$PHP_VERSION >= $REQUIRED_VERSION" | bc -l) )); then
    print_status "PHP version $PHP_VERSION is compatible (requires $REQUIRED_VERSION+)"
else
    print_error "PHP version $PHP_VERSION is too old (requires $REQUIRED_VERSION+)"
    echo "Fix: Update PHP via cPanel MultiPHP Manager"
fi

echo ""
echo "2. Checking .env file..."
if [ -f .env ]; then
    print_status ".env file exists"
    
    # Check APP_KEY
    if grep -q "APP_KEY=base64:" .env; then
        print_status "APP_KEY is set"
    else
        print_error "APP_KEY is missing or invalid"
        echo "Fix: Run 'php artisan key:generate'"
    fi
    
    # Check Database connection
    if grep -q "DB_HOST=" .env && grep -q "DB_DATABASE=" .env && grep -q "DB_USERNAME=" .env; then
        print_status "Database configuration exists"
    else
        print_warning "Database configuration might be incomplete"
    fi
else
    print_error ".env file is missing!"
    echo "Fix: Copy .env.example to .env and configure"
fi

echo ""
echo "3. Checking file permissions..."
# Check bootstrap/cache
if [ -w bootstrap/cache ]; then
    print_status "bootstrap/cache is writable"
else
    print_error "bootstrap/cache is NOT writable"
    echo "Fixing permissions..."
    chmod -R 775 bootstrap/cache 2>/dev/null || print_warning "Could not set permissions (may need root)"
fi

# Check storage
if [ -w storage ]; then
    print_status "storage directory is writable"
else
    print_error "storage directory is NOT writable"
    echo "Fixing permissions..."
    chmod -R 775 storage 2>/dev/null || print_warning "Could not set permissions (may need root)"
fi

echo ""
echo "4. Checking required cache files..."
if [ -f bootstrap/cache/services.php ]; then
    print_status "bootstrap/cache/services.php exists"
else
    print_warning "bootstrap/cache/services.php is missing"
    touch bootstrap/cache/services.php
    echo '<?php return array ();' > bootstrap/cache/services.php
    print_status "Created bootstrap/cache/services.php"
fi

if [ -f bootstrap/cache/packages.php ]; then
    print_status "bootstrap/cache/packages.php exists"
else
    print_warning "bootstrap/cache/packages.php is missing"
    touch bootstrap/cache/packages.php
    echo '<?php return array ();' > bootstrap/cache/packages.php
    print_status "Created bootstrap/cache/packages.php"
fi

echo ""
echo "5. Clearing Laravel caches..."
php artisan config:clear 2>/dev/null && print_status "Config cache cleared" || print_error "Failed to clear config cache"
php artisan cache:clear 2>/dev/null && print_status "Application cache cleared" || print_error "Failed to clear cache"
php artisan route:clear 2>/dev/null && print_status "Route cache cleared" || print_error "Failed to clear route cache"
php artisan view:clear 2>/dev/null && print_status "View cache cleared" || print_error "Failed to clear view cache"
php artisan optimize:clear 2>/dev/null && print_status "All optimizations cleared" || print_error "Failed to clear optimizations"

echo ""
echo "6. Running composer install..."
if command -v composer &> /dev/null; then
    composer install --no-dev --optimize-autoloader 2>/dev/null && print_status "Composer dependencies installed" || print_error "Composer install failed"
else
    print_warning "Composer not found - skipping"
fi

echo ""
echo "7. Creating storage link..."
php artisan storage:link 2>/dev/null && print_status "Storage link created" || print_warning "Storage link already exists or failed"

echo ""
echo "8. Checking error logs..."
if [ -f storage/logs/laravel.log ]; then
    LOG_SIZE=$(wc -l < storage/logs/laravel.log)
    if [ $LOG_SIZE -gt 0 ]; then
        print_warning "Laravel log has $LOG_SIZE lines - check for errors:"
        echo "   tail -50 storage/logs/laravel.log"
    else
        print_status "Laravel log is empty (no recent errors)"
    fi
else
    print_warning "Laravel log file doesn't exist yet"
fi

echo ""
echo "========================================="
echo "Diagnostic Complete!"
echo "========================================="
echo ""
echo "Next steps:"
echo "1. Check error logs: tail -f storage/logs/laravel.log"
echo "2. Test database connection: php artisan tinker -> DB::connection()->getPdo();"
echo "3. Verify .htaccess is not corrupted"
echo "4. Check server error logs in cPanel"
echo ""

