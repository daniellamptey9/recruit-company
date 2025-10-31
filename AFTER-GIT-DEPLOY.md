# ✅ What to Do AFTER Deploying from Git

## The Problem
The `vendor` folder is **NOT in Git** (correct - this is normal Laravel practice).  
After deploying from Git, you need to install Composer dependencies.

## Solution: Run Composer Install

### Step 1: Deploy from Git (in cPanel)
1. Go to **Git Version Control** in cPanel
2. Pull/Clone your repository to `/home/jobmates/public_html/`

### Step 2: Install Dependencies

**Option A: Via cPanel Terminal (Recommended)**
1. Go to **Terminal** in cPanel
2. Run:
```bash
cd ~/public_html
composer install --no-dev --optimize-autoloader
```

**Option B: Via SSH**
```bash
cd ~/public_html
composer install --no-dev --optimize-autoloader
```

**Option C: If Composer is not available**
- Upload the `vendor` folder manually via File Manager (see Option 2 below)

### Step 3: Set Permissions (in cPanel File Manager)
- `bootstrap` folder → **775** (recurse)
- `storage` folder → **775** (recurse)
- `bootstrap/cache/*.php` → **664**

### Step 4: Configure .env
- Edit `.env` with your production database credentials

### Step 5: Test
Visit: `https://jobmateservices.com`

---

## 🔄 Every Time You Deploy from Git

**You MUST run `composer install` after every Git deployment!**

This is normal - the `vendor` folder changes and is not tracked in Git.

---

## Quick Command (Copy & Paste)

```bash
cd ~/public_html && composer install --no-dev --optimize-autoloader && chmod -R 775 storage bootstrap/cache && chmod 664 bootstrap/cache/*.php
```

