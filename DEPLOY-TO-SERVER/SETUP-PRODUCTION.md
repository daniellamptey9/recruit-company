# Production Server Setup Instructions - HTTP 500 Error Fix

## Comprehensive HTTP 500 Diagnostic & Fix Guide

This document covers all common causes and fixes for HTTP 500 errors in Laravel.

### Quick Fix Script

Run the automated fix script:
```bash
chmod +x fix-http500.sh
./fix-http500.sh
```

---

## Common Causes & Solutions

### 1. **Corrupted or Misconfigured .htaccess File**

**Symptoms:** Site returns 500 immediately, no error details.

**Fix:**
- Rename `.htaccess` to `.htaccess_backup` temporarily
- Reload site - if it works, the issue is in .htaccess
- Restore from backup or use the provided .htaccess files in this repo

**Location:** 
- Root: `.htaccess` (for project root)
- Public: `public/.htaccess` (Laravel front controller)

### 2. **PHP Version Mismatch**

**Requirements:** PHP 8.1+ for Laravel 10

**Check:** `php -v`

**Fix (cPanel):**
1. Go to **Select PHP Version** / **MultiPHP Manager**
2. Ensure PHP 8.1 or higher is selected
3. Save and restart Apache

### 3. **File Permission Errors**

**Symptoms:** "Permission denied" in logs, bootstrap/cache errors.

**Fix:**

**Linux/Apache:**
```bash
# Set proper permissions
chmod -R 755 bootstrap/cache
chmod -R 755 storage
chown -R www-data:www-data bootstrap/cache
chown -R www-data:www-data storage

# Files should be 644, directories 755
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
```

**Windows/IIS:**
1. Right-click `bootstrap/cache` → Properties → Security
2. Add `IIS_IUSRS` user
3. Give "Modify" or "Full control" permissions
4. Repeat for `storage` directory

### 4. **PHP Memory or Execution Limits**

**Symptoms:** Scripts timeout, "memory exhausted" errors.

**Fix - Add to `public/.htaccess`:**
```apache
php_value memory_limit 512M
php_value max_execution_time 300
php_value upload_max_filesize 50M
php_value post_max_size 50M
```

**Or via cPanel:**
- Select PHP Version → Options → increase memory_limit and max_execution_time

### 5. **Missing or Corrupted Framework Files**

**Symptoms:** "Class not found", "File not found" errors.

**Fix:**
```bash
# Install dependencies
composer install --no-dev --optimize-autoloader

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# Regenerate optimized files
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. **Database Connection Issues**

**Symptoms:** Database errors in logs, connection timeouts.

**Check `.env`:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**Test Connection:**
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

**Fix:**
- Verify credentials in cPanel phpMyAdmin
- Check if database exists
- Ensure user has proper permissions

### 7. **Missing APP_KEY**

**Symptoms:** Encryption errors, session issues.

**Fix:**
```bash
php artisan key:generate --force
```

Verify in `.env`: `APP_KEY=base64:...`

### 8. **Bootstrap/Cache Directory Issues**

**Symptoms:** "bootstrap/cache directory must be present and writable"

**Fix:**
```bash
# Ensure directory exists
mkdir -p bootstrap/cache

# Create required files
touch bootstrap/cache/services.php
touch bootstrap/cache/packages.php
echo '<?php return array ();' > bootstrap/cache/services.php
echo '<?php return array ();' > bootstrap/cache/packages.php

# Set permissions
chmod 775 bootstrap/cache
chmod 664 bootstrap/cache/*.php
```

### 9. **Corrupted Cache or Config**

**Symptoms:** Changes not reflecting, old config values.

**Fix:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# If still issues, delete cached files manually
rm -rf bootstrap/cache/*.php
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/views/*
```

### 10. **Syntax or Fatal Errors**

**Enable Error Display (temporary for debugging):**

Add to `public/index.php` before line 47:
```php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
```

**Check Logs:**
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Server error logs (cPanel)
# Usually in: public_html/error_log or /logs/error_log
```

**Remove error display after fixing** (security risk in production!)

---

## Diagnostic Checklist

| Check | Command/Tool | Status |
|-------|--------------|--------|
| PHP Version | `php -v` | Should be 8.1+ |
| .env exists | `ls -la .env` | Should exist |
| APP_KEY set | `grep APP_KEY .env` | Should start with `base64:` |
| Permissions | `ls -la bootstrap/cache` | Should be writable |
| Cache files | `ls bootstrap/cache/*.php` | services.php, packages.php |
| Database | `php artisan tinker` | Should connect |
| Logs | `tail storage/logs/laravel.log` | Check for errors |

---

## Step-by-Step Fix Process

1. **Run the fix script:**
   ```bash
   chmod +x fix-http500.sh
   ./fix-http500.sh
   ```

2. **Check error logs:**
   ```bash
   tail -50 storage/logs/laravel.log
   ```

3. **If still failing, check server logs:**
   - cPanel → Errors → Latest Errors
   - Or: `public_html/error_log`

4. **Temporarily enable error display** (remove after fix):
   - Edit `public/index.php`
   - Add error reporting lines
   - Reload site to see actual error

5. **Verify all requirements:**
   - PHP 8.1+
   - Required extensions enabled
   - Database accessible
   - File permissions correct

---

## Still Having Issues?

1. **Check Laravel logs:** `storage/logs/laravel.log`
2. **Check server logs:** cPanel error logs
3. **Enable debug mode:** Set `APP_DEBUG=true` in `.env` (temporary!)
4. **Contact hosting support** with error log details

### For Windows/IIS Server:
1. Right-click on `bootstrap/cache` folder
2. Go to Properties > Security
3. Click "Edit" and add IIS_IUSRS
4. Give it "Full control" or at least "Modify" permissions
5. Apply to all subfolders and files

### For Linux/Apache Server:
```bash
chmod -R 775 bootstrap/cache
chown -R www-data:www-data bootstrap/cache
chmod -R 775 storage
chown -R www-data:www-data storage
```

### Required Files:
The following files must exist and be writable:
- `bootstrap/cache/services.php`
- `bootstrap/cache/packages.php`

These files have been added to git and should exist after deployment.

### After setting permissions, run:
```bash
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
```

