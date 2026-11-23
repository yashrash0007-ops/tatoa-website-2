<?php
$page_title = "Publications";
include 'includes/header.php';
require_once 'includes/data.php';
require_once 'includes/documents-data.php';
require_once 'includes/document-card.php';

$flash = flash_get();
$publications = array_values(array_filter(get_documents(), fn($d) => $d['category'] === 'publication'));
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">Official publications</span>
  <h1>Publications.</h1>
  <p class="lede">Newsletters and reports TATOA publishes for members and the wider industry.</p>
</div>

<?php if ($flash): ?>
  <div class="notice <?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['message']); ?></div>
<?php endif; ?>

<section>
  <div class="grid cols-2">
    <?php foreach ($publications as $doc) render_document_card($doc, 'publications.php'); ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
