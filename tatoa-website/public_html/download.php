<?php
/**
 * Streams a members-only document (Resources or Publications) after
 * verifying the submitted email belongs to an active member. Public
 * documents never route through this file — they link straight to
 * assets/documents/public/.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/data.php';
require_once 'includes/documents-data.php';

$key = trim($_POST['key'] ?? '');
$email = trim($_POST['email'] ?? '');
$returnTo = ($_POST['returnTo'] ?? '') === 'publications.php' ? 'publications.php' : 'resources.php';

$doc = get_document($key);

if (!$doc || $doc['access'] !== 'members') {
    flash_set('error', 'That document is not available for gated download.');
    header("Location: {$returnTo}");
    exit;
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    flash_set('error', 'Please enter a valid email address to access this document.');
    header("Location: {$returnTo}");
    exit;
}

if (!is_active_member($email)) {
    flash_set('error', 'This document is available to active TATOA members only.');
    header("Location: {$returnTo}");
    exit;
}

$path = PRIVATE_DOCS_DIR . '/' . $doc['file'];
if (!file_exists($path)) {
    flash_set('error', 'That document could not be found on the server.');
    header("Location: {$returnTo}");
    exit;
}

// Stream the file rather than redirecting to it — it lives outside
// the web root's reach (data/.htaccess denies direct access), so this
// script is the only path to it.
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="' . basename($doc['file']) . '"');
header('Content-Length: ' . filesize($path));
readfile($path);
exit;
