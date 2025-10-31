@echo off
REM Production Server Installation & Fix Script for Windows/SSH
REM Run this script on your production server via SSH

echo =========================================
echo Laravel Production Server Fix Script
echo =========================================
echo.

cd /d %~dp0

echo Step 1: Installing Composer Dependencies...
where composer >nul 2>&1
if %errorlevel% == 0 (
    echo Composer found
    composer install --no-dev --optimize-autoloader --no-interaction
    if exist "vendor\autoload.php" (
        echo [OK] Composer dependencies installed successfully
    ) else (
        echo [ERROR] vendor\autoload.php not found after installation
        exit /b 1
    )
) else (
    echo [ERROR] Composer not found!
    echo Please install Composer first or contact hosting support
    exit /b 1
)
echo.

echo Step 2: Creating Required Cache Files...
if not exist "bootstrap\cache" mkdir "bootstrap\cache"
if not exist "bootstrap\cache\services.php" (
    echo ^<?php return array (^) > "bootstrap\cache\services.php"
    echo ); >> "bootstrap\cache\services.php"
    echo [OK] Created bootstrap\cache\services.php
) else (
    echo [OK] bootstrap\cache\services.php already exists
)

if not exist "bootstrap\cache\packages.php" (
    echo ^<?php return array (^) > "bootstrap\cache\packages.php"
    echo ); >> "bootstrap\cache\packages.php"
    echo [OK] Created bootstrap\cache\packages.php
) else (
    echo [OK] bootstrap\cache\packages.php already exists
)
echo.

echo Step 3: Verifying .env Configuration...
if not exist ".env" (
    echo [ERROR] .env file not found!
    if exist ".env.example" (
        echo [WARNING] Copying .env.example to .env
        copy ".env.example" ".env"
        echo Please edit .env and set your configuration
    )
) else (
    echo [OK] .env file exists
)
echo.

echo Step 4: Clearing Laravel Caches...
php artisan config:clear 2>nul && echo [OK] Config cache cleared || echo [WARNING] Could not clear config cache
php artisan cache:clear 2>nul && echo [OK] Application cache cleared || echo [WARNING] Could not clear cache
php artisan route:clear 2>nul && echo [OK] Route cache cleared || echo [WARNING] Could not clear route cache
php artisan view:clear 2>nul && echo [OK] View cache cleared || echo [WARNING] Could not clear view cache
php artisan optimize:clear 2>nul && echo [OK] All optimizations cleared || echo [WARNING] Could not clear optimizations
echo.

echo Step 5: Creating Storage Link...
php artisan storage:link 2>nul && echo [OK] Storage link created || echo [WARNING] Storage link already exists or failed
echo.

echo =========================================
echo Installation Complete!
echo =========================================
echo.
echo Next steps:
echo 1. Verify .env file has correct database credentials
echo 2. Set file permissions: bootstrap\cache and storage to 775
echo 3. Test your website
echo.

