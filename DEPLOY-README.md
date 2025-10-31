# 🚀 Deploy from Git via cPanel

## Step-by-Step Instructions

### 1. Deploy from Git in cPanel
1. Log into cPanel
2. Go to **Git Version Control** or **Git™ Version Control**
3. Clone or pull your repository to `/home/jobmates/public_html/`
4. Make sure all files are deployed

### 2. Install Composer Dependencies

After deploying from Git, you **MUST** install Composer dependencies because the `vendor` folder is not in Git.

#### Option A: Via SSH/Terminal (Fastest)

1. In cPanel, go to **Terminal** (or use SSH)
2. Run these commands:

```bash
cd ~/public_html
composer install --no-dev --optimize-autoloader
chmod -R 775 storage bootstrap/cache
touch bootstrap/cache/services.php bootstrap/cache/packages.php
chmod 664 bootstrap/cache/*.php
php artisan config:cache
```

#### Option B: Via cPanel File Manager (No SSH)

If you don't have SSH/Terminal access:

1. **Option 1: Use cPanel's Terminal** (if available)
   - Look for "Terminal" in cPanel
   - Run: `composer install --no-dev --optimize-autoloader`

2. **Option 2: Upload vendor folder manually**
   - On your local computer, run: `composer install --no-dev --optimize-autoloader`
   - Zip the `vendor` folder
   - Upload via cPanel File Manager
   - Extract in `/home/jobmates/public_html/vendor/`

### 3. Set Permissions

In cPanel File Manager:
- `bootstrap` folder → 775 (recurse)
- `storage` folder → 775 (recurse)
- `bootstrap/cache/*.php` → 664

### 4. Configure .env

Edit `.env` file with your production settings:
- `DB_HOST=localhost`
- `DB_DATABASE=your_database`
- `DB_USERNAME=your_username`
- `DB_PASSWORD=your_password`
- `APP_DEBUG=false`

### 5. Test

Visit: `https://jobmateservices.com`

---

## ⚠️ Important Notes

- The `vendor` folder is **NOT** in Git (correctly ignored)
- You **MUST** run `composer install` after every Git deployment
- This is normal Laravel practice

---

## 🔧 Troubleshooting

**Error: vendor/autoload.php not found**
→ Run `composer install --no-dev --optimize-autoloader`

**Error: Permission denied**
→ Set permissions to 775 for directories, 664 for files

**Error: Command not found: composer**
→ Install Composer first or use cPanel's Composer tool

