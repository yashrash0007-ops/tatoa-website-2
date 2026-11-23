<?php
/**
 * Shared header/nav for all TATOA Digital Platform pages.
 * Include at the top of every page: <?php include 'includes/header.php'; ?>
 * Set $page_title before including, e.g. $page_title = "About TATOA";
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // needed for one-time flash messages (e.g. after form submits)
}

$current = basename($_SERVER['PHP_SELF']);
if (!isset($page_title)) { $page_title = "TATOA Digital Platform"; }

// Nav items live here so adding a new module page later is a one-line change.
$nav_items = [
    'index.php'            => 'Home',
    'about.php'             => 'About TATOA',
    'leadership.php'        => 'Leadership',
    'membership.php'        => 'Membership',
    'directory.php'         => 'Member Directory',
    'services.php'          => 'Services',
    'news.php'              => 'News',
    'industry-updates.php'  => 'Industry Updates',
    'events.php'            => 'Events',
    'resources.php'         => 'Resources',
    'publications.php'      => 'Publications',
    'gallery.php'           => 'Gallery',
    'contact.php'           => 'Contact',
    // Future modules plug in below as they're built:
    // 'portal.php'      => 'Member Portal',
    // 'admin.php'       => 'Admin',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($page_title); ?> | TATOA Digital Platform</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="top">
  <div class="top-inner">
    <a href="index.php" class="brand"><span class="mark"></span> TATOA <span class="sub">DIGITAL</span></a>
    <nav class="mainnav">
      <?php foreach ($nav_items as $file => $label): ?>
        <a href="<?php echo $file; ?>" class="<?php echo ($current === $file) ? 'active' : ''; ?>"><?php echo $label; ?></a>
      <?php endforeach; ?>
    </nav>
  </div>
  <div class="routeline"></div>
</header>

<main class="gggg">
