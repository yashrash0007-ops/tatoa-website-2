<?php
/**
 * Processes event registration (events.php). Requires the submitted
 * email to belong to an active member — the same rule the Directory
 * uses. Once the Member Portal has real login, this is the natural
 * place to swap the email lookup for a session check.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/data.php';
require_once 'includes/events-data.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: events.php');
    exit;
}

$eventId = trim($_POST['eventId'] ?? '');
$email = trim($_POST['email'] ?? '');

$event = get_event($eventId);
if (!$event) {
    flash_set('error', 'That event could not be found.');
    header('Location: events.php');
    exit;
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    flash_set('error', 'Please enter a valid email address to register.');
    header('Location: events.php');
    exit;
}

if (!is_active_member($email)) {
    flash_set('error', 'Only active TATOA members can register for events. If you\'ve applied recently, your application may still be pending approval.');
    header('Location: events.php');
    exit;
}

if (has_registered($eventId, $email)) {
    flash_set('ok', "You're already registered for \"{$event['title']}\".");
    header('Location: events.php');
    exit;
}

$member = find_member_by_email($email);
add_event_registration($eventId, $email, $member['companyName']);

flash_set('ok', "Registered for \"{$event['title']}\"! A confirmation would be sent to {$email}.");
header('Location: events.php');
exit;
