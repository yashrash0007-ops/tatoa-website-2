<?php
$page_title = "Home";
include 'includes/header.php';

// Module summary — drawn from Proposal Section 4 (Proposed Solution).
// Swap this array for live data (e.g. from a database) once the admin
// dashboard and other modules are built.
$modules = [
    ["Modern TATOA Website", "A professional, mobile-first site with clear access to TATOA information and services."],
    ["TATOA Member Portal", "Every registered member gets an account and personal dashboard for profile, status, documents and payments."],
    ["TATOA Member Directory", "Searchable by company name, location, transport type, cargo category, truck type and operating corridor."],
    ["Online Membership System", "Apply, upload documents, track status, and pay once approved — all online."],
    ["Membership Renewal & Payments", "Renew online, pay through approved providers, and download receipts."],
    ["Industry News & Regulatory Updates", "A central source for LATRA/TRA notices, tax developments, and border procedures."],
    ["Documents & Resources", "Government notices, circulars, regulations, forms and training materials, in one place."],
    ["Events & Training", "Members view, register for, and get confirmed for TATOA meetings and workshops."],
    ["TATOA Announcements", "Notices published on the platform, optionally distributed by email, SMS and WhatsApp."],
    ["Member Requests & Support", "Categorized requests — membership, documentation, regulatory, training — each with a tracking number."],
    ["Administration Dashboard", "A centralized system for TATOA staff to manage members, content, and communication."],
];

// Placeholder counters — replace with real queries once the member
// database and application workflow (Modules 2–4) are connected.
$stats = [
    ["120+", "Registered members"],
    ["7",    "Operating corridors covered"],
    ["24",   "Regions represented"],
    ["4",    "Active phases of rollout"],
];
?>

<div class="hero">
  <span class="eyebrow">Tanzania Truck Owners Association</span>
  <h1>One digital platform for<br>Tanzania's truck owners.</h1>
  <p class="lede">TATOA brings membership services, member profiles, industry information, regulatory updates, documents and events together in one place — built for truck owners and the wider road-freight ecosystem.</p>
  <div class="hero-ctas">
    <a class="btn primary" href="about.php">About TATOA</a>
    <a class="btn ghost" href="leadership.php">Meet our leadership</a>
  </div>

  <div class="stat-row">
    <?php foreach ($stats as $s): ?>
      <div class="stat">
        <div class="num"><?php echo htmlspecialchars($s[0]); ?></div>
        <div class="lbl"><?php echo htmlspecialchars($s[1]); ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<section>
  <div class="section-head">
    <h2>What the platform brings together</h2>
    <span class="tag">Proposal section 4 &middot; Proposed Solution</span>
  </div>
  <div class="modlist">
    <?php foreach ($modules as $i => $m): ?>
      <div class="modrow">
        <div class="modnum"><?php echo str_pad($i + 1, 2, "0", STR_PAD_LEFT); ?></div>
        <div>
          <h4><?php echo htmlspecialchars($m[0]); ?></h4>
          <p><?php echo htmlspecialchars($m[1]); ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section>
  <div class="section-head">
    <h2>Why it matters</h2>
  </div>
  <div class="grid cols-3">
    <div class="card"><div class="corner"></div><h3>Increase engagement</h3><p>Members gain one place to access TATOA services and information.</p></div>
    <div class="card"><div class="corner"></div><h3>Improve communication</h3><p>Industry information reaches members faster and more consistently.</p></div>
    <div class="card"><div class="corner"></div><h3>Reduce admin work</h3><p>Online applications, renewals and requests cut repetitive manual processes.</p></div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
