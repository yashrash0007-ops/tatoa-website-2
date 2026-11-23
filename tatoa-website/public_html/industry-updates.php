<?php
$page_title = "Industry Updates";
include 'includes/header.php';

/**
 * Sample/placeholder content for demonstration. Once connected to
 * real sources, this is where LATRA/TRA notices, tax and customs
 * updates would be published or pulled in.
 */
$updates = [
    ["category" => "Government & Regulatory",      "date" => "2026-08-22", "title" => "LATRA axle-load enforcement schedule (sample)", "body" => "Placeholder notice: updated weighbridge enforcement schedule for the coming quarter across major corridors."],
    ["category" => "TRA / LATRA",                  "date" => "2026-08-15", "title" => "TRA transit tax guidance (sample)", "body" => "Placeholder for TRA's latest guidance on transit goods and cross-border tax procedures."],
    ["category" => "Road & Transport Regulations",  "date" => "2026-08-10", "title" => "Draft update to vehicle inspection rules (sample)", "body" => "Placeholder summary of a proposed change to periodic vehicle inspection requirements."],
    ["category" => "Tax Developments",              "date" => "2026-08-03", "title" => "Fuel levy adjustment (sample)", "body" => "Placeholder note on a proposed adjustment to the fuel levy affecting operating costs."],
    ["category" => "Customs & Border Procedures",    "date" => "2026-07-28", "title" => "One-stop border post update — Rusumo, Tunduma, Horohoro (sample)", "body" => "Placeholder update on document requirements at key border posts."],
    ["category" => "Regional Transport",             "date" => "2026-07-20", "title" => "Central Corridor traffic advisory (sample)", "body" => "Placeholder advisory on road conditions along the Central Corridor to DRC."],
    ["category" => "Freight & Logistics News",       "date" => "2026-07-12", "title" => "Port throughput report (sample)", "body" => "Placeholder summary of recent freight volumes moving through Dar es Salaam port."],
];

$category = trim($_GET['category'] ?? '');
$categories = array_values(array_unique(array_column($updates, 'category')));

$filtered = $category === '' ? $updates : array_values(array_filter($updates, fn($u) => $u['category'] === $category));
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">Stay informed</span>
  <h1>Industry &amp; regulatory updates.</h1>
  <p class="lede">A central source for government, LATRA/TRA, tax, customs and corridor information relevant to truck owners.</p>
</div>

<div class="notice">Sample updates for demonstration — the live platform would carry real TRA/LATRA notices and regulatory bulletins as TATOA publishes or sources them.</div>

<section>
  <form class="filterbar" method="get" action="industry-updates.php">
    <select name="category">
      <option value="">All categories</option>
      <?php foreach ($categories as $c): ?>
        <option value="<?php echo htmlspecialchars($c); ?>" <?php echo ($category === $c) ? 'selected' : ''; ?>><?php echo htmlspecialchars($c); ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Filter</button>
    <?php if ($category !== ''): ?><a class="clear" href="industry-updates.php">Clear</a><?php endif; ?>
  </form>

  <div class="grid cols-2">
    <?php if (empty($filtered)): ?>
      <div class="empty">No updates in this category yet.</div>
    <?php else: ?>
      <?php foreach ($filtered as $u): ?>
        <div class="card">
          <div class="corner"></div>
          <div class="pillrow"><span class="pill"><?php echo htmlspecialchars($u['category']); ?></span> <span class="pill mono"><?php echo htmlspecialchars($u['date']); ?></span></div>
          <h3><?php echo htmlspecialchars($u['title']); ?></h3>
          <p><?php echo htmlspecialchars($u['body']); ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
