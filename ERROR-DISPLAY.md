# Browser Error Display Guide

With `APP_DEBUG=true` in your `.env` file, you should see a detailed error page when visiting your site.

## 🔍 What You'll See in the Browser

Based on your error logs, when you visit `https://jobmateservices.com` in your browser, you should see something like:

### **Error Message:**
```
The C:\xampp\htdocs\recruit-company\bootstrap\cache directory must be present and writable.
```

Or if on production server:
```
The /home/username/public_html/recruit-company/bootstrap/cache directory must be present and writable.
```

### **Error Details (Full Page):**
- **Exception:** `Exception`
- **File:** `vendor/laravel/framework/src/Illuminate/Foundation/ProviderRepository.php:188`
- **Message:** The bootstrap/cache directory must be present and writable
- **Stack Trace:** Full list of files and line numbers leading to the error

### **What to Look For in Browser:**

1. **Open your browser's Developer Tools:**
   - **Chrome/Edge:** Press `F12` or `Ctrl+Shift+I` (Windows) / `Cmd+Option+I` (Mac)
   - **Firefox:** Press `F12` or `Ctrl+Shift+K`
   - **Safari:** Press `Cmd+Option+I`

2. **Check the Console Tab:**
   - Look for any JavaScript errors or network errors
   - Check for HTTP 500 status codes

3. **Check the Network Tab:**
   - Look for the main request (usually to `/` or your domain)
   - Click on it and check the **Response** tab
   - You should see the full error page HTML

4. **View Page Source:**
   - Right-click on page → **"View Page Source"**
   - Search for "bootstrap/cache" to find the error message

---

## 📸 Expected Error Page Format

Laravel's error page (with APP_DEBUG=true) typically shows:

```
┌─────────────────────────────────────────────────────────────┐
│ Whoops, looks like something went wrong.                    │
│                                                             │
│ The bootstrap/cache directory must be present and writable. │
│                                                             │
│ in ProviderRepository.php line 188                          │
│                                                             │
│ Stack Trace:                                                │
│ #0 ProviderRepository.php:163                               │
│ #1 ProviderRepository.php:61                                │
│ #2 Application.php:794                                       │
│ ...                                                          │
└─────────────────────────────────────────────────────────────┘
```

---

## 🔧 If Error Still Not Visible

If you still see a blank page or generic HTTP 500:

### **Option 1: Add Error Display to public/index.php**

Add these lines right after line 6 in `public/index.php`:

```php
define('LARAVEL_START', microtime(true));

// TEMPORARY: Force error display
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
```

**Then refresh your browser** - you should now see the error.

### **Option 2: Check Browser Developer Console**

1. Open Developer Tools (F12)
2. Go to **Console** tab
3. Look for any error messages there
4. Go to **Network** tab
5. Reload the page
6. Click on the main request
7. Check the **Response** tab - you should see the error HTML

### **Option 3: View Raw Response**

1. In Developer Tools, go to **Network** tab
2. Reload the page
3. Find the request to your domain
4. Click on it
5. Go to **Response** tab
6. You should see the full error page with stack trace

---

## 📋 Screenshot What to Share

If you need help, share:

1. **The full error message** (the exact text)
2. **The file and line number** where it occurs
3. **A screenshot** of the error page
4. **The Stack Trace** section (all the file paths and line numbers)

This will help diagnose the exact issue!

---

## ⚠️ Important: Security

**REMOVE APP_DEBUG=true after fixing!**

Once you've identified and fixed the error:
1. Change `APP_DEBUG=false` in `.env`
2. Remove any `ini_set` lines added to `public/index.php`
3. This prevents exposing sensitive information to users

