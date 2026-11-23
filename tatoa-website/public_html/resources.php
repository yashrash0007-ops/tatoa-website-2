<?php
$page_title = "Resources";
include 'includes/header.php';
require_once 'includes/data.php';
require_once 'includes/documents-data.php';
require_once 'includes/document-card.php';

$flash = flash_get();
$resources = array_values(array_filter(get_documents(), fn($d) => $d['category'] === 'resource'));
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">Documents</span>
  <h1>Resources.</h1>
  <p class="lede">Government notices, circulars, regulations, forms and training materials. Public documents download directly; members-only documents unlock with your member email.</p>
</div>

<?php if ($flash): ?>
  <div class="notice <?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['message']); ?></div>
<?php endif; ?>

<section>
  <div class="grid cols-2">
    <?php foreach ($resources as $doc) render_document_card($doc, 'resources.php'); ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
