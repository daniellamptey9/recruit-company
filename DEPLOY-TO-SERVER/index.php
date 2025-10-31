<?php
// Fallback front controller if the web root points to the project root instead of public/
// Prefer pointing your DocumentRoot to the public/ directory for better security.

// If public/index.php exists, require it; otherwise, show a helpful message
$publicIndex = __DIR__ . '/public/index.php';
if (file_exists($publicIndex)) {
    require $publicIndex;
    exit;
}

http_response_code(500);
echo 'Application misconfigured: public/index.php not found.';
exit;

