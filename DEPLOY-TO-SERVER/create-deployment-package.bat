@echo off
REM Create deployment package with vendor included
REM Run this on your LOCAL Windows machine

echo Creating deployment package...

REM Create package directory
for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value') do set datetime=%%I
set PACKAGE_DIR=deployment-package-%datetime:~0,8%-%datetime:~8,6%

mkdir "%PACKAGE_DIR%" 2>nul

echo Copying all files...
xcopy /E /I /H /Y /EXCLUDE:exclude-list.txt . "%PACKAGE_DIR%" >nul 2>&1

REM Create exclude list
echo .git > exclude-list.txt
echo node_modules >> exclude-list.txt
echo .idea >> exclude-list.txt
echo .vscode >> exclude-list.txt
echo deployment-package- >> exclude-list.txt

REM Copy .env.example as .env
if exist ".env.example" (
    copy ".env.example" "%PACKAGE_DIR%\.env" >nul
    echo Copied .env.example to .env in package
)

REM Check if vendor exists
if not exist "vendor" (
    echo Installing Composer dependencies locally...
    composer install --no-dev --optimize-autoloader
)

REM Copy vendor
if exist "vendor" (
    echo Including vendor folder in package...
    xcopy /E /I /H /Y vendor "%PACKAGE_DIR%\vendor\" >nul 2>&1
) else (
    echo ERROR: vendor folder not found. Run 'composer install' first.
    exit /b 1
)

REM Ensure cache files exist
if not exist "%PACKAGE_DIR%\bootstrap\cache" mkdir "%PACKAGE_DIR%\bootstrap\cache"
if not exist "%PACKAGE_DIR%\bootstrap\cache\services.php" (
    echo ^<?php return array (^) > "%PACKAGE_DIR%\bootstrap\cache\services.php"
    echo ); >> "%PACKAGE_DIR%\bootstrap\cache\services.php"
)
if not exist "%PACKAGE_DIR%\bootstrap\cache\packages.php" (
    echo ^<?php return array (^) > "%PACKAGE_DIR%\bootstrap\cache\packages.php"
    echo ); >> "%PACKAGE_DIR%\bootstrap\cache\packages.php"
)

echo.
echo =========================================
echo Package created: %PACKAGE_DIR%
echo =========================================
echo.
echo Next steps:
echo 1. Review the package contents
echo 2. Edit %PACKAGE_DIR%\.env with your production settings
echo 3. Zip the package folder
echo 4. Upload via FTP or cPanel File Manager
echo 5. Extract on server
echo.

del exclude-list.txt 2>nul

