<?php
$page_title = "Services";
include 'includes/header.php';

// Services TATOA provides to members, drawn from the proposal's
// Executive Summary and Expected Benefits sections.
$services = [
    ["Representation & Advocacy", "TATOA represents truck owners and operators to government, regulators and industry stakeholders across the road-freight sector."],
    ["Membership Management", "Online applications, renewals and status tracking, so members spend less time on paperwork."],
    ["Member Directory & Networking", "A searchable directory so members can find and connect with each other by corridor, cargo type and location."],
    ["Industry Information & Regulatory Updates", "Centralized access to LATRA/TRA notices, tax developments, customs and border procedures."],
    ["Documents & Resources", "Circulars, regulations, forms, templates and training materials available in one place."],
    ["Events & Training", "Annual meetings, workshops and stakeholder forums, with online registration and confirmation."],
    ["Member Requests & Support", "Categorized requests — membership, documentation, regulatory, training, complaints — each with a tracking number."],
];
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">What we offer</span>
  <h1>Services for TATOA members.</h1>
  <p class="lede">Beyond representing truck owners, TATOA provides a growing set of digital services designed to make membership more useful day to day.</p>
</div>

<section>
  <div class="grid cols-2">
    <?php foreach ($services as $s): ?>
      <div class="card">
        <div class="corner"></div>
        <h3><?php echo htmlspecialchars($s[0]); ?></h3>
        <p><?php echo htmlspecialchars($s[1]); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section>
  <div class="section-head">
    <h2>Not yet a member?</h2>
  </div>
  <p style="max-width:600px; color:var(--steel);">Most of these services are available once your membership application is approved.</p>
  <a class="btn primary" href="membership.php">Apply for membership</a>
  <a class="btn ghost" href="directory.php" style="margin-left:10px;">Browse the member directory</a>
</section>

<?php include 'includes/footer.php'; ?>
