<?php
/**
 * Processes the membership application form (membership.php).
 * On success or failure, redirects back to membership.php with a
 * one-time flash message — this file never renders HTML itself.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/data.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: membership.php');
    exit;
}

$required = ['companyName', 'contactName', 'email', 'phone', 'location'];
$errors = [];

foreach ($required as $field) {
    if (trim($_POST[$field] ?? '') === '') {
        $errors[] = $field;
    }
}

$email = trim($_POST['email'] ?? '');
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'email_format';
}

if (!empty($errors)) {
    $_SESSION['old_membership_input'] = $_POST;
    flash_set('error', 'Please fill in all required fields with a valid email address, then resubmit.');
    header('Location: membership.php');
    exit;
}

$existing = find_member_by_email($email);
if ($existing) {
    $status = htmlspecialchars($existing['status']);
    flash_set('error', "An application with this email already exists (status: {$status}). Contact TATOA if you believe this is a mistake.");
    header('Location: membership.php');
    exit;
}

$record = [
    'companyName'   => trim($_POST['companyName']),
    'contactName'   => trim($_POST['contactName']),
    'email'         => $email,
    'phone'         => trim($_POST['phone']),
    'location'      => trim($_POST['location']),
    'transportType' => trim($_POST['transportType'] ?? ''),
    'truckType'     => trim($_POST['truckType'] ?? ''),
    'corridor'      => trim($_POST['corridor'] ?? ''),
    'cargo'         => trim($_POST['cargo'] ?? ''),
    'services'      => trim($_POST['services'] ?? ''),
];

add_member($record);

flash_set('ok', 'Application submitted. Your status is Pending — a TATOA administrator will review it shortly.');
header('Location: membership.php');
exit;
