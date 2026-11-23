<?php
/**
 * Processes the contact form (contact.php). Saves to
 * data/contact_messages.json; once the Admin Dashboard is built, staff
 * will read these from there instead of the raw file.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/data.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? 'General inquiry');
$message = trim($_POST['message'] ?? '');

$errors = [];
if ($name === '') $errors[] = 'name';
if ($message === '') $errors[] = 'message';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'email';

if (!empty($errors)) {
    $_SESSION['old_contact_input'] = $_POST;
    flash_set('error', 'Please fill in all required fields with a valid email address, then resend.');
    header('Location: contact.php');
    exit;
}

add_contact_message([
    'name' => $name,
    'email' => $email,
    'subject' => $subject,
    'message' => $message,
]);

flash_set('ok', 'Message sent — TATOA will get back to you by email.');
header('Location: contact.php');
exit;
