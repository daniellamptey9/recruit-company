🚀 DEPLOYMENT INSTRUCTIONS - UPLOAD THIS FOLDER TO YOUR SERVER
================================================================

This folder contains EVERYTHING you need, including the vendor folder!

STEP 1: Upload to Server
-------------------------
1. Zip this entire "DEPLOY-TO-SERVER" folder
2. Upload via FTP or cPanel File Manager to: /home/jobmates/public_html/
3. Extract the zip file
4. Move all contents to public_html/ (or wherever your domain points)

STEP 2: Set Permissions via cPanel File Manager
------------------------------------------------
1. Navigate to bootstrap folder → Right-click → Change Permissions
   - Set to: 775
   - Check: "Recurse into subdirectories"
   - Click: "Change Permissions"

2. Navigate to storage folder → Right-click → Change Permissions
   - Set to: 775
   - Check: "Recurse into subdirectories"
   - Click: "Change Permissions"

3. Navigate to bootstrap/cache folder:
   - services.php → Right-click → Change Permissions → 664
   - packages.php → Right-click → Change Permissions → 664

STEP 3: Configure .env File
----------------------------
1. Edit .env file (in File Manager)
2. Set these values:
   APP_URL=https://jobmateservices.com
   DB_HOST=localhost
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   APP_DEBUG=false (change to false after testing)

STEP 4: Test
-------------
Visit https://jobmateservices.com

If you see errors, check:
- File permissions (must be 775 for directories)
- .env file has correct database credentials
- PHP version is 8.1 or higher

================================================================

