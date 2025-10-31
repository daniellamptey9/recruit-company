# Step-by-Step cPanel Fix Guide for HTTP 500 Error

## 🚨 Quick Diagnosis First

Before fixing, let's identify the exact issue:

### Step 1: Check Error Logs in cPanel

1. **Login to cPanel**
2. **Go to "Metrics" → "Errors"** (or search for "Errors" in cPanel)
3. **Click on "Latest Errors"** or "Error Log"
4. **Look for the most recent error** - it will show the exact issue
5. **Note down the error message** - this tells us what to fix

---

## 🔧 Complete Fix Process

### **Step 2: Check PHP Version**

Laravel 10 requires PHP 8.1 or higher.

1. In cPanel, search for **"MultiPHP Manager"** or **"Select PHP Version"**
2. Navigate to your domain folder (usually `public_html` or your domain name)
3. **Check current PHP version** - must be 8.1, 8.2, or 8.3
4. If lower than 8.1:
   - **Click "Change PHP Version"**
   - **Select PHP 8.1 or higher**
   - **Click "Apply"**
   - **Wait for confirmation**

### **Step 3: Fix File Permissions**

**For Directories:**
1. In cPanel, go to **"Files" → "File Manager"**
2. Navigate to your Laravel project folder
3. **Right-click on `bootstrap` folder** → **"Change Permissions"**
4. Set permissions to **`755`** (check: Owner=Read+Write+Execute, Group=Read+Execute, Public=Read+Execute)
5. **Check "Recurse into subdirectories"**
6. Click **"Change Permissions"**
7. Repeat for `storage` folder with permissions **`755`**

**For Files:**
1. Navigate to `bootstrap/cache` folder
2. **Right-click on `services.php`** → **"Change Permissions"** → Set to **`644`**
3. **Right-click on `packages.php`** → **"Change Permissions"** → Set to **`644`**

### **Step 4: Verify Required Files Exist**

In **File Manager**:

1. Check if these files exist:
   - ✅ `.env` (in root directory)
   - ✅ `bootstrap/cache/services.php`
   - ✅ `bootstrap/cache/packages.php`
   - ✅ `public/.htaccess`
   - ✅ `storage/logs/laravel.log` (will be created automatically)

2. **If `bootstrap/cache/services.php` is missing:**
   - Click **"+File"** button
   - Name: `services.php`
   - Location: `bootstrap/cache/`
   - Content: `<?php return array ();`
   - Click **"Create New File"**

3. **If `bootstrap/cache/packages.php` is missing:**
   - Click **"+File"** button
   - Name: `packages.php`
   - Location: `bootstrap/cache/`
   - Content: `<?php return array ();`
   - Click **"Create New File"**

### **Step 5: Configure .env File**

1. In **File Manager**, find `.env` file in root directory
2. **Right-click** → **"Edit"**
3. **Verify these settings:**

```env
APP_NAME="Mine Care Recruitment"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://jobmateservices.com
APP_KEY=base64:YOUR_KEY_HERE

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

4. **Important Checks:**
   - ✅ `APP_KEY` must start with `base64:` and have a long string
   - ✅ `DB_HOST` should be `localhost` (or your database host)
   - ✅ `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` must match your cPanel MySQL database

5. **Click "Save Changes"**

### **Step 6: Check Database Connection**

1. In cPanel, go to **"Databases" → "phpMyAdmin"**
2. **Verify your database exists**
3. **Check database user has proper permissions:**
   - Go to **"Databases" → "MySQL Databases"**
   - Find your database user
   - Ensure user has **"ALL PRIVILEGES"** on your database

### **Step 7: Fix .htaccess File**

**Option A: Verify Root .htaccess**

1. In **File Manager**, find `.htaccess` in root directory
2. **Right-click** → **"Edit"**
3. **Ensure it contains:**
```apache
<IfModule mod_rewrite.c>
    Options +FollowSymlinks
    RewriteEngine On
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ public/index.php [L]
</IfModule>
```

**Option B: Verify public/.htaccess**

1. Navigate to `public` folder
2. Find `.htaccess` file
3. **Right-click** → **"Edit"**
4. **Ensure it contains:**
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>
    RewriteEngine On
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

# PHP Configuration
<IfModule mod_php7.c>
    php_value memory_limit 512M
    php_value max_execution_time 300
    php_value upload_max_filesize 50M
    php_value post_max_size 50M
</IfModule>

<IfModule mod_php.c>
    php_value memory_limit 512M
    php_value max_execution_time 300
    php_value upload_max_filesize 50M
    php_value post_max_size 50M
</IfModule>
```

5. **Click "Save Changes"**

### **Step 8: Increase PHP Limits (Via cPanel)**

1. In cPanel, go to **"Select PHP Version"** or **"MultiPHP Manager"**
2. Click on **"Options"** button
3. **Set these values:**
   - `memory_limit` → **512M**
   - `max_execution_time` → **300**
   - `upload_max_filesize` → **50M**
   - `post_max_size` → **50M**
4. **Click "Save"**

### **Step 9: Check Document Root**

Your cPanel domain must point to the `public` folder of Laravel.

1. In cPanel, go to **"Domains"** → **"Addon Domains"** (or **"Subdomains"**)
2. Find `jobmateservices.com`
3. **Check "Document Root"** - it should point to:
   - ✅ `public_html/recruit-company/public` (if in subdirectory)
   - OR `public_html/public` (if in root)
4. **If incorrect:**
   - **Edit the domain**
   - Change **"Document Root"** to point to Laravel's `public` folder
   - **Save**

**Alternative:** If you can't change document root, use root `.htaccess` (already configured above).

### **Step 10: Enable Error Display (Temporary for Debugging)**

1. In **File Manager**, go to `public` folder
2. Find `index.php`
3. **Right-click** → **"Edit"**
4. **Add these lines AFTER line 6** (after `define('LARAVEL_START', microtime(true));`):

```php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
```

5. **Save** and **reload your website**
6. **You should now see the actual error** instead of HTTP 500
7. **Note down the error message**
8. **REMOVE these lines after fixing** (security risk!)

### **Step 11: Clear All Caches via SSH**

**If you have SSH access:**

1. In cPanel, go to **"Advanced" → "Terminal"** (or use SSH client)
2. **Navigate to your Laravel directory:**
   ```bash
   cd public_html/recruit-company
   # OR
   cd ~/public_html
   ```
3. **Run these commands:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   php artisan optimize:clear
   ```

**If you DON'T have SSH access:**

Delete cache files manually via File Manager:
1. Navigate to `storage/framework/cache/data/`
2. **Delete all files** in this folder (not the folder itself)
3. Navigate to `storage/framework/views/`
4. **Delete all files** in this folder (not the folder itself)
5. Navigate to `bootstrap/cache/`
6. **Delete `config.php`, `routes-v7.php`, `services.php`, `packages.php`** if they exist
7. **Recreate `services.php` and `packages.php`** with content: `<?php return array ();`

### **Step 12: Install Composer Dependencies**

**Via SSH:**
```bash
cd ~/public_html/recruit-company
composer install --no-dev --optimize-autoloader
```

**Via cPanel (if Composer available):**
1. Go to **"Software" → "Setup Node.js App"** or search for **"Composer"**
2. Navigate to your project directory
3. Run: `composer install --no-dev --optimize-autoloader`

### **Step 13: Create Storage Link**

**Via SSH:**
```bash
php artisan storage:link
```

**Manual (if no SSH):**
1. In **File Manager**, navigate to `public` folder
2. Click **"+File"** or **"Create Symbolic Link"**
3. **Link name:** `storage`
4. **Link target:** `../storage/app/public`
5. **Create the link**

---

## 📋 Diagnostic Checklist

Go through each item and verify:

- [ ] PHP version is 8.1 or higher
- [ ] `.env` file exists and has correct values
- [ ] `APP_KEY` is set and starts with `base64:`
- [ ] `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` are correct
- [ ] `bootstrap/cache` folder has permissions **755**
- [ ] `bootstrap/cache/services.php` exists with permissions **644**
- [ ] `bootstrap/cache/packages.php` exists with permissions **644**
- [ ] `storage` folder has permissions **755**
- [ ] `.htaccess` files exist and are correct
- [ ] Document root points to Laravel's `public` folder
- [ ] PHP memory_limit is at least **512M**
- [ ] Database connection works (test via phpMyAdmin)
- [ ] Error logs show no critical errors

---

## 🔍 If Still Not Working

### Check Error Logs:

1. **cPanel Error Log:**
   - **Metrics → Errors → Latest Errors**
   - Look for entries related to your domain

2. **Laravel Log:**
   - **File Manager → storage/logs/laravel.log**
   - **Right-click → "View"** or **"Edit"**
   - Scroll to bottom for latest errors

3. **PHP Error Log:**
   - Usually at `public_html/error_log` or `logs/error_log`

### Common Error Messages & Fixes:

| Error Message | Fix |
|--------------|-----|
| "bootstrap/cache directory must be present and writable" | Fix permissions to 755 (Step 3) |
| "Class not found" | Run `composer install` (Step 12) |
| "Database connection failed" | Check .env database credentials (Step 5) |
| "APP_KEY is missing" | Generate new key in .env (Step 5) |
| "Permission denied" | Fix file permissions (Step 3) |
| "Memory exhausted" | Increase memory_limit (Step 8) |
| "Syntax error" | Check file for errors, view error log |

---

## 🆘 Contact Hosting Support

If none of the above works, contact your hosting support with:

1. **Domain name:** jobmateservices.com
2. **Error message from error log**
3. **PHP version:** (from Step 2)
4. **Steps you've already tried**

---

## ✅ After Fixing

**REMOVE temporary error display** (Step 10) for security:
- Edit `public/index.php`
- Remove the three `ini_set` lines added
- Save

**Test your site** to ensure everything works!

