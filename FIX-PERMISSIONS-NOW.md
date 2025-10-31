# 🚨 URGENT: Fix Bootstrap/Cache Permissions

If you've set permissions to 755 and still getting the error, follow these steps:

## ⚠️ The Issue

**755 permissions alone are NOT enough!** The web server user needs WRITE access, not just read/execute.

## ✅ Complete Fix Process

### **Step 1: Check Current Permissions**

In cPanel File Manager:
1. Navigate to `bootstrap` folder
2. Right-click → **"Change Permissions"**
3. Note what permissions are currently set
4. Check if "Owner" is your cPanel username or "www-data"

### **Step 2: Set Correct Permissions**

**For `bootstrap` folder:**
- Permissions: **`775`** (NOT 755!)
- This gives: Owner=Full, Group=Full, Public=Read+Execute
- **CHECK "Recurse into subdirectories"** ✓
- Click **"Change Permissions"**

**For `storage` folder:**
- Permissions: **`775`**
- **CHECK "Recurse into subdirectories"** ✓
- Click **"Change Permissions"**

**For `bootstrap/cache` folder specifically:**
- Navigate to `bootstrap/cache`
- Permissions: **`775`**
- **CHECK "Recurse into subdirectories"** ✓

**For `bootstrap/cache/*.php` files:**
- `services.php`: **`664`** or **`666`**
- `packages.php`: **`664`** or **`666`**

### **Step 3: Check File Ownership**

**This is CRITICAL!** The web server user must OWN the files.

**If using SSH:**
```bash
# Find your web server user (usually 'username' or 'www-data')
whoami

# Change ownership to web server user
chown -R username:username bootstrap/cache
chown -R username:username storage

# Or if using www-data:
chown -R www-data:www-data bootstrap/cache
chown -R www-data:www-data storage
```

**If NOT using SSH (cPanel only):**

1. In File Manager, right-click `bootstrap/cache`
2. Look for **"Change Ownership"** option
3. If available, change owner to your cPanel username
4. Repeat for `storage` folder

**If "Change Ownership" is not available:**
- You may need to contact hosting support to change ownership
- Or use SSH if you have access

### **Step 4: Verify Files Exist**

In `bootstrap/cache/` folder, ensure these files exist:

**File 1: `services.php`**
```
<?php return array (
);
```

**File 2: `packages.php`**
```
<?php return array (
);
```

**If they don't exist:**
1. Click **"+File"** in File Manager
2. Name: `services.php`
3. Location: `bootstrap/cache/`
4. Content: `<?php return array ();`
5. Permissions: `664` or `666`
6. Repeat for `packages.php`

### **Step 5: Test Write Access**

**Via SSH (if available):**
```bash
cd ~/public_html/recruit-company
touch bootstrap/cache/test.txt
rm bootstrap/cache/test.txt
```

If this works, the directory is writable. If it fails, ownership or permissions are wrong.

### **Step 6: Alternative - Use 777 (Temporary)**

**⚠️ WARNING: 777 is less secure, but works for testing**

If 775 doesn't work, try 777 temporarily to verify:
1. `bootstrap/cache`: **`777`**
2. `storage`: **`777`**
3. Test if error goes away
4. **If it works, then change back to 775 and fix ownership instead**

### **Step 7: Clear Cache After Fix**

After fixing permissions:
1. Delete all files in `bootstrap/cache/` EXCEPT:
   - `services.php`
   - `packages.php`
   - `.gitignore`
2. Refresh your browser

---

## 🔍 How to Verify It's Fixed

1. **Check error log:**
   ```bash
   tail -f storage/logs/laravel.log
   ```
   No more "bootstrap/cache directory must be writable" errors

2. **Test website:**
   - Visit `https://jobmateservices.com`
   - Error should be gone or different

3. **Check permissions via SSH:**
   ```bash
   ls -la bootstrap/cache
   ```
   Should show: `drwxrwxr-x` (775) for directory
   Should show: `-rw-rw-r--` (664) for PHP files

---

## 📋 Common Issues & Solutions

| Problem | Solution |
|---------|----------|
| "Permission denied" | Increase to 775 or 777, check ownership |
| Still getting error after 755 | Change to **775** (not 755!) |
| Web server can't write | Check ownership - must be web server user |
| Files get deleted | Wrong permissions - use 664 for files |
| Only works with 777 | Ownership issue - fix ownership, not permissions |

---

## 🎯 Quick Command Summary (SSH)

If you have SSH access, run these commands:

```bash
# Navigate to project
cd ~/public_html/recruit-company

# Set permissions
chmod -R 775 bootstrap/cache
chmod -R 775 storage
chmod 664 bootstrap/cache/*.php

# Fix ownership (replace 'username' with your cPanel username)
chown -R username:username bootstrap/cache
chown -R username:username storage

# Create cache files if missing
echo '<?php return array ();' > bootstrap/cache/services.php
echo '<?php return array ();' > bootstrap/cache/packages.php
chmod 664 bootstrap/cache/*.php

# Clear Laravel caches
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
```

---

## 🆘 If Still Not Working

1. **Contact hosting support** with this message:
   > "I need to change ownership of `bootstrap/cache` and `storage` directories to my web server user (www-data or my cPanel username) for Laravel application. Current permissions are 755 but need write access."

2. **Check PHP error log** in cPanel:
   - Metrics → Errors → Latest Errors
   - Look for different error messages

3. **Try 777 temporarily** to verify it's a permission issue:
   - If 777 works, it confirms it's a permission/ownership problem
   - Then fix ownership and set back to 775

