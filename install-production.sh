#!/bin/bash
# Production Server Installation & Fix Script
# Run this script on your production server to fix all issues

set -e  # Exit on error

echo "========================================="
echo "Laravel Production Server Fix Script"
echo "========================================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

print_status() {
    echo -e "${GREEN}✓${NC} $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

# Get current directory
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd "$SCRIPT_DIR"

echo "Working directory: $SCRIPT_DIR"
echo ""

# Step 1: Install Composer Dependencies
echo "Step 1: Installing Composer Dependencies..."
if command -v composer &> /dev/null; then
    print_status "Composer found"
    composer install --no-dev --optimize-autoloader --no-interaction
    if [ -f "vendor/autoload.php" ]; then
        print_status "Composer dependencies installed successfully"
    else
        print_error "vendor/autoload.php not found after installation"
        exit 1
    fi
else
    print_error "Composer not found!"
    echo "Please install Composer first or contact hosting support"
    exit 1
fi
echo ""

# Step 2: Create Required Cache Files
echo "Step 2: Creating Required Cache Files..."
mkdir -p bootstrap/cache
if [ ! -f "bootstrap/cache/services.php" ]; then
    echo '<?php return array (' > bootstrap/cache/services.php
    echo ');' >> bootstrap/cache/services.php
    print_status "Created bootstrap/cache/services.php"
else
    print_status "bootstrap/cache/services.php already exists"
fi

if [ ! -f "bootstrap/cache/packages.php" ]; then
    echo '<?php return array (' > bootstrap/cache/packages.php
    echo ');' >> bootstrap/cache/packages.php
    print_status "Created bootstrap/cache/packages.php"
else
    print_status "bootstrap/cache/packages.php already exists"
fi
echo ""

# Step 3: Set File Permissions
echo "Step 3: Setting File Permissions..."
chmod -R 775 bootstrap/cache 2>/dev/null || print_warning "Could not set bootstrap/cache permissions (may need root)"
chmod -R 775 storage 2>/dev/null || print_warning "Could not set storage permissions (may need root)"
chmod 664 bootstrap/cache/*.php 2>/dev/null || print_warning "Could not set file permissions"
chmod 755 bootstrap/cache 2>/dev/null || print_warning "Could not set directory permissions"
chmod 755 storage 2>/dev/null || print_warning "Could not set directory permissions"

# Try to fix ownership (if we know the user)
if [ -n "$USER" ]; then
    chown -R $USER:$USER bootstrap/cache 2>/dev/null || print_warning "Could not change ownership (may need root)"
    chown -R $USER:$USER storage 2>/dev/null || print_warning "Could not change ownership (may need root)"
fi

print_status "Permissions set (use 775 for directories, 664 for files)"
echo ""

# Step 4: Verify .env File
echo "Step 4: Verifying .env Configuration..."
if [ ! -f ".env" ]; then
    print_error ".env file not found!"
    if [ -f ".env.example" ]; then
        print_warning "Copying .env.example to .env"
        cp .env.example .env
        echo "Please edit .env and set your configuration"
    else
        print_error "No .env.example found either!"
    fi
else
    print_status ".env file exists"
    
    # Check APP_KEY
    if grep -q "APP_KEY=$" .env || ! grep -q "APP_KEY=base64:" .env; then
        print_warning "APP_KEY is missing or empty"
        echo "Generating new APP_KEY..."
        php artisan key:generate --force 2>/dev/null || print_warning "Could not generate APP_KEY (bootstrap/cache may need write access first)"
    else
        print_status "APP_KEY is set"
    fi
fi
echo ""

# Step 5: Clear All Caches
echo "Step 5: Clearing Laravel Caches..."
php artisan config:clear 2>/dev/null && print_status "Config cache cleared" || print_warning "Could not clear config cache"
php artisan cache:clear 2>/dev/null && print_status "Application cache cleared" || print_warning "Could not clear cache"
php artisan route:clear 2>/dev/null && print_status "Route cache cleared" || print_warning "Could not clear route cache"
php artisan view:clear 2>/dev/null && print_status "View cache cleared" || print_warning "Could not clear view cache"
php artisan optimize:clear 2>/dev/null && print_status "All optimizations cleared" || print_warning "Could not clear optimizations"
echo ""

# Step 6: Create Storage Link
echo "Step 6: Creating Storage Link..."
php artisan storage:link 2>/dev/null && print_status "Storage link created" || print_warning "Storage link already exists or failed"
echo ""

# Step 7: Verify Installation
echo "Step 7: Verifying Installation..."
echo ""
echo "Checking required files:"
[ -f "vendor/autoload.php" ] && print_status "vendor/autoload.php exists" || print_error "vendor/autoload.php MISSING"
[ -f "bootstrap/cache/services.php" ] && print_status "bootstrap/cache/services.php exists" || print_error "bootstrap/cache/services.php MISSING"
[ -f "bootstrap/cache/packages.php" ] && print_status "bootstrap/cache/packages.php exists" || print_error "bootstrap/cache/packages.php MISSING"
[ -f ".env" ] && print_status ".env exists" || print_error ".env MISSING"
[ -f "public/index.php" ] && print_status "public/index.php exists" || print_error "public/index.php MISSING"
[ -d "storage" ] && print_status "storage directory exists" || print_error "storage directory MISSING"
[ -d "bootstrap/cache" ] && print_status "bootstrap/cache directory exists" || print_error "bootstrap/cache directory MISSING"
echo ""

# Step 8: Final Check
echo "Step 8: Testing Write Access..."
if [ -w "bootstrap/cache" ]; then
    print_status "bootstrap/cache is writable"
else
    print_error "bootstrap/cache is NOT writable"
    echo "   → Try: chmod 775 bootstrap/cache"
    echo "   → Or: chmod 777 bootstrap/cache (less secure)"
fi

if [ -w "storage" ]; then
    print_status "storage is writable"
else
    print_error "storage is NOT writable"
    echo "   → Try: chmod 775 storage"
    echo "   → Or: chmod 777 storage (less secure)"
fi
echo ""

echo "========================================="
echo "Installation Complete!"
echo "========================================="
echo ""
echo "Next steps:"
echo "1. Verify .env file has correct database credentials"
echo "2. Test your website: https://jobmateservices.com"
echo "3. Check error logs if still having issues: storage/logs/laravel.log"
echo ""
echo "If you still get errors:"
echo "- Check file permissions: bootstrap/cache and storage must be 775"
echo "- Verify ownership: web server user must own the files"
echo "- Check PHP version: must be 8.1 or higher"
echo ""

