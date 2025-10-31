# Production Server Setup Instructions

## Fix HTTP 500 Error - Permissions Issue

If you're getting HTTP 500 errors, the bootstrap/cache directory needs to be writable by the web server.

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

