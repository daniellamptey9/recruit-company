# 🚨 FIX: Missing vendor/autoload.php

## Error:
```
Failed to open stream: No such file or directory
vendor/autoload.php
```

## 🔍 Root Cause

The `vendor` directory is missing! This happens when:
- Composer dependencies haven't been installed
- The `vendor` folder wasn't uploaded/deployed
- `.gitignore` excluded `vendor` from git (which is correct, but needs to be installed)

## ✅ Solution: Install Composer Dependencies

### **Option 1: Via SSH (Recommended)**

1. **SSH into your server:**
   ```bash
   ssh username@your-server.com
   # Or use cPanel Terminal if available
   ```

2. **Navigate to your project:**
   ```bash
   cd ~/public_html
   # OR if in subdirectory:
   cd ~/public_html/recruit-company
   ```

3. **Install dependencies:**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

   This will:
   - Install all Laravel dependencies
   - Create the `vendor` folder
   - Generate `vendor/autoload.php`
   - Optimize autoloader for production

4. **Wait for installation to complete** (may take 2-5 minutes)

5. **Verify it worked:**
   ```bash
   ls -la vendor/autoload.php
   ```
   Should show the file exists

6. **Refresh your browser** - error should be gone!

---

### **Option 2: Via cPanel File Manager**

If you **DON'T have SSH access**, you need to upload the vendor folder manually:

**⚠️ Warning:** The vendor folder is large (100+ MB). This method is slow but works.

#### Step 1: Download vendor folder locally

On your local machine:
1. Navigate to your Laravel project
2. Run: `composer install --no-dev --optimize-autoloader`
3. Zip the `vendor` folder: `vendor.zip`

#### Step 2: Upload to server

1. In cPanel → **File Manager**
2. Navigate to your project root (same level as `composer.json`)
3. Click **"Upload"**
4. Upload `vendor.zip`
5. Right-click `vendor.zip` → **"Extract"**
6. Wait for extraction (may take several minutes)
7. Delete `vendor.zip` after extraction

#### Step 3: Set permissions

1. Right-click `vendor` folder → **"Change Permissions"**
2. Set to **`755`**
3. Check **"Recurse into subdirectories"** ✓
4. Click **"Change Permissions"**

#### Step 4: Verify

Check if `vendor/autoload.php` exists:
1. Navigate to `vendor` folder
2. Look for `autoload.php` file
3. If exists, refresh your browser

---

### **Option 3: Via cPanel Composer (If Available)**

Some hosts provide Composer in cPanel:

1. In cPanel, search for **"Composer"** or **"PHP Composer"**
2. Navigate to your project directory
3. Run: `composer install --no-dev --optimize-autoloader`
4. Wait for completion

---

### **Option 4: Request Hosting Support**

If none of the above work, contact hosting support with:

> "I need to install Composer dependencies for my Laravel application. The `vendor` folder is missing. Please help me either:
> 1. Run `composer install --no-dev --optimize-autoloader` in `/home/jobmates/public_html/`
> 2. Or provide SSH access so I can install it myself."

---

## 🔍 Verify Installation

After installation, check:

1. **File exists:**
   ```bash
   ls -la vendor/autoload.php
   ```
   Should show the file

2. **Folder structure:**
   ```
   vendor/
   ├── autoload.php
   ├── composer/
   ├── laravel/
   └── ...
   ```

3. **Test website:**
   - Refresh browser
   - Should see a different error or the site working

---

## 📋 Quick Checklist

After installing vendor:

- [ ] `vendor/autoload.php` exists
- [ ] `vendor` folder has 755 permissions
- [ ] Website shows progress (different error or works)
- [ ] No more "vendor/autoload.php" missing errors

---

## ⚠️ Important Notes

1. **`.gitignore` correctly excludes `vendor`:**
   - Don't commit vendor to git (too large)
   - Install via Composer on server instead

2. **After deploying:**
   - Always run `composer install` on production
   - Or include vendor in deployment (not recommended)

3. **File size:**
   - Vendor folder is ~100-200 MB
   - Be patient during upload/installation

---

## 🎯 Next Steps After Fix

Once vendor is installed, you may see:
- ✅ Site works!
- OR different error (progress!)
- Common next errors:
  - Database connection issues
  - Missing .env configuration
  - Permission issues (bootstrap/cache)

Keep troubleshooting based on the new error message!

