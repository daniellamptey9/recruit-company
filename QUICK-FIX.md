# 🚀 Quick Fix - Run This Script on Your Server

## Run This Command on Your Production Server

**Via SSH or cPanel Terminal:**

```bash
cd ~/public_html
# OR if in subdirectory:
cd ~/public_html/recruit-company

# Make script executable
chmod +x install-production.sh

# Run the fix script
./install-production.sh
```

**That's it!** The script will:
1. ✅ Install Composer dependencies (creates vendor folder)
2. ✅ Create required cache files
3. ✅ Set file permissions
4. ✅ Verify .env configuration
5. ✅ Clear all caches
6. ✅ Create storage link

---

## If You Don't Have SSH Access

### Option 1: Ask Hosting Support

Send them this message:

> "Please run this command in `/home/jobmates/public_html/`:
> ```bash
> composer install --no-dev --optimize-autoloader
> chmod -R 775 bootstrap/cache storage
> ```
> This will install Laravel dependencies and fix permissions."

### Option 2: Use cPanel Terminal

1. In cPanel, go to **"Advanced" → "Terminal"**
2. Run:
   ```bash
   cd ~/public_html
   composer install --no-dev --optimize-autoloader
   chmod -R 775 bootstrap/cache storage
   ```

### Option 3: Manual Installation

1. **Install Composer locally** (if not already)
2. **Run:** `composer install --no-dev --optimize-autoloader`
3. **Zip the vendor folder:** `zip -r vendor.zip vendor`
4. **Upload to server** via cPanel File Manager
5. **Extract** in project root

---

## After Running the Script

Refresh your browser - the errors should be fixed!

If you still see errors, the script will tell you what's wrong.

