#!/bin/bash
# Create deployment package with vendor included
# Run this on your LOCAL machine, then upload to server

echo "Creating deployment package..."

# Create package directory
PACKAGE_DIR="deployment-package-$(date +%Y%m%d-%H%M%S)"
mkdir -p "$PACKAGE_DIR"

echo "Copying all files (excluding git files)..."
rsync -av --exclude='.git' --exclude='.env' --exclude='node_modules' \
    --exclude='.idea' --exclude='.vscode' \
    --exclude='deployment-package-*' \
    ./ "$PACKAGE_DIR/"

# Copy .env.example and rename to .env
if [ -f ".env.example" ]; then
    cp .env.example "$PACKAGE_DIR/.env"
    echo "Copied .env.example to .env in package"
fi

# Ensure vendor exists (if not, install it)
if [ ! -d "vendor" ]; then
    echo "Installing Composer dependencies locally..."
    composer install --no-dev --optimize-autoloader
fi

# Copy vendor to package
if [ -d "vendor" ]; then
    echo "Including vendor folder in package..."
    cp -r vendor "$PACKAGE_DIR/"
else
    echo "ERROR: vendor folder not found. Run 'composer install' first."
    exit 1
fi

# Ensure cache files exist
mkdir -p "$PACKAGE_DIR/bootstrap/cache"
if [ ! -f "$PACKAGE_DIR/bootstrap/cache/services.php" ]; then
    echo '<?php return array (' > "$PACKAGE_DIR/bootstrap/cache/services.php"
    echo ');' >> "$PACKAGE_DIR/bootstrap/cache/services.php"
fi
if [ ! -f "$PACKAGE_DIR/bootstrap/cache/packages.php" ]; then
    echo '<?php return array (' > "$PACKAGE_DIR/bootstrap/cache/packages.php"
    echo ');' >> "$PACKAGE_DIR/bootstrap/cache/packages.php"
fi

# Create .gitignore in bootstrap/cache that allows the files
echo "*" > "$PACKAGE_DIR/bootstrap/cache/.gitignore"
echo "!.gitignore" >> "$PACKAGE_DIR/bootstrap/cache/.gitignore"
echo "!services.php" >> "$PACKAGE_DIR/bootstrap/cache/.gitignore"
echo "!packages.php" >> "$PACKAGE_DIR/bootstrap/cache/.gitignore"

# Create deployment instructions
cat > "$PACKAGE_DIR/DEPLOYMENT-INSTRUCTIONS.txt" << 'EOF'
DEPLOYMENT INSTRUCTIONS
=======================

1. Upload all files from this package to your server's public_html directory

2. Set file permissions via cPanel File Manager:
   - Right-click 'bootstrap' folder → Change Permissions → 775 → Recurse
   - Right-click 'storage' folder → Change Permissions → 775 → Recurse
   - Navigate to bootstrap/cache:
     * services.php → 664
     * packages.php → 664

3. Edit .env file with your production settings:
   - APP_URL=https://jobmateservices.com
   - DB_HOST=localhost
   - DB_DATABASE=your_database
   - DB_USERNAME=your_username
   - DB_PASSWORD=your_password

4. Verify .htaccess files exist:
   - public/.htaccess should exist
   - Root .htaccess should exist

5. Test your website!

If using FTP:
- Upload everything to public_html/
- Set permissions as described above
EOF

echo ""
echo "========================================="
echo "Package created: $PACKAGE_DIR"
echo "========================================="
echo ""
echo "Next steps:"
echo "1. Review the package contents"
echo "2. Edit $PACKAGE_DIR/.env with your production settings"
echo "3. Zip the package: zip -r $PACKAGE_DIR.zip $PACKAGE_DIR"
echo "4. Upload via FTP or cPanel File Manager"
echo "5. Extract on server"
echo "6. Set permissions (see DEPLOYMENT-INSTRUCTIONS.txt)"
echo ""

