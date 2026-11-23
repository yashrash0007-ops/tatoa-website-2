<?php
$page_title = "Leadership";
include 'includes/header.php';

/**
 * TODO: Replace with real leadership data — e.g. pulled from a database
 * table once the Admin Dashboard (Module 11) can manage this content.
 * Photo paths point to assets/img/leadership/ — drop real photos there
 * using the same filenames, or update the 'photo' key.
 */
$leaders = [
    [
        "name"  => "[Full Name]",
        "role"  => "Chairperson",
        "bio"   => "Placeholder bio — a short summary of background in the road-freight sector and role at TATOA.",
        "photo" => "",
    ],
    [
        "name"  => "[Full Name]",
        "role"  => "Vice Chairperson",
        "bio"   => "Placeholder bio — background and responsibilities within the Association.",
        "photo" => "",
    ],
    [
        "name"  => "[Full Name]",
        "role"  => "Secretary General",
        "bio"   => "Placeholder bio — oversees day-to-day administration and member communication.",
        "photo" => "",
    ],
    [
        "name"  => "[Full Name]",
        "role"  => "Treasurer",
        "bio"   => "Placeholder bio — oversees membership fees, renewals and financial reporting.",
        "photo" => "",
    ],
    [
        "name"  => "[Full Name]",
        "role"  => "Board Member",
        "bio"   => "Placeholder bio — represents a specific region or transport category.",
        "photo" => "",
    ],
    [
        "name"  => "[Full Name]",
        "role"  => "Board Member",
        "bio"   => "Placeholder bio — represents a specific region or transport category.",
        "photo" => "",
    ],
];
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">Governance</span>
  <h1>TATOA leadership.</h1>
  <p class="lede">The Association is guided by an elected leadership team accountable to its membership.</p>
</div>

<div class="notice">
  Names and bios below are placeholders (<code>$leaders</code> array in <code>leadership.php</code>). Replace them
  with the actual TATOA leadership roster — or connect this page to the Admin Dashboard once it's built, so staff
  can update it without touching code.
</div>

<section>
  <div class="grid cols-3">
    <?php foreach ($leaders as $person): ?>
      <div class="leader-card">
        <div class="leader-photo">
          <?php if (!empty($person['photo']) && file_exists($person['photo'])): ?>
            <img src="<?php echo htmlspecialchars($person['photo']); ?>" alt="<?php echo htmlspecialchars($person['name']); ?>">
          <?php else: ?>
            <span class="placeholder-mark">Photo pending</span>
          <?php endif; ?>
        </div>
        <div class="leader-body">
          <div class="role"><?php echo htmlspecialchars($person['role']); ?></div>
          <h3><?php echo htmlspecialchars($person['name']); ?></h3>
          <p><?php echo htmlspecialchars($person['bio']); ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
