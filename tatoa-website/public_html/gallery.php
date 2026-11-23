<?php
$page_title = "Gallery";
include 'includes/header.php';

/**
 * TODO: Replace with real photos. Drop image files into
 * assets/img/gallery/ using the 'photo' filename below (or update it),
 * and they'll display automatically — until then, each tile shows a
 * placeholder mark.
 */
$gallery_items = [
    ["category" => "AGM 2025",              "title" => "Annual General Meeting",       "photo" => ""],
    ["category" => "Training",              "title" => "Fleet Safety Workshop",         "photo" => ""],
    ["category" => "Corridor Visit",        "title" => "TAZARA Corridor Site Visit",    "photo" => ""],
    ["category" => "Membership",            "title" => "New Member Onboarding Day",     "photo" => ""],
    ["category" => "Regional Meeting",      "title" => "Mbeya Chapter Gathering",       "photo" => ""],
    ["category" => "Industry Event",        "title" => "Regional Logistics Forum",      "photo" => ""],
];
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">In pictures</span>
  <h1>Gallery.</h1>
  <p class="lede">Photos from TATOA meetings, training sessions and member events.</p>
</div>

<div class="notice">
  Placeholder gallery for demonstration — real photos will replace these tiles once supplied (see the
  <code>$gallery_items</code> array in <code>gallery.php</code>).
</div>

<section>
  <div class="grid cols-3">
    <?php foreach ($gallery_items as $item): ?>
      <div class="gallery-tile">
        <div class="gallery-photo">
          <?php if (!empty($item['photo']) && file_exists($item['photo'])): ?>
            <img src="<?php echo htmlspecialchars($item['photo']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
          <?php else: ?>
            <span class="placeholder-mark">Photo pending<br><?php echo htmlspecialchars($item['category']); ?></span>
          <?php endif; ?>
        </div>
        <div class="gallery-caption">
          <div class="cat"><?php echo htmlspecialchars($item['category']); ?></div>
          <h4><?php echo htmlspecialchars($item['title']); ?></h4>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
