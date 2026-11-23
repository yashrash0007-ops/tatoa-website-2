<?php
$page_title = "Member Directory";
include 'includes/header.php';
require_once 'includes/data.php';

$q = trim($_GET['q'] ?? '');
$corridor = trim($_GET['corridor'] ?? '');

$members = array_filter(read_members(), function ($m) {
    return $m['status'] === 'active';
});

if ($q !== '') {
    $needle = strtolower($q);
    $members = array_filter($members, function ($m) use ($needle) {
        $hay = strtolower($m['companyName'] . ' ' . $m['location'] . ' ' . ($m['cargo'] ?? '') . ' ' . $m['transportType']);
        return str_contains($hay, $needle);
    });
}

if ($corridor !== '') {
    $members = array_filter($members, function ($m) use ($corridor) {
        return $m['corridor'] === $corridor;
    });
}

$members = array_values($members);
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">Find a member</span>
  <h1>Member directory.</h1>
  <p class="lede">Search TATOA's active members by company, location, cargo type or operating corridor.</p>
</div>

<section>
  <form class="filterbar" method="get" action="directory.php">
    <input type="text" name="q" placeholder="Search company, location, cargo..." value="<?php echo htmlspecialchars($q); ?>" style="flex:2; min-width:220px;">
    <select name="corridor">
      <option value="">All corridors</option>
      <?php foreach (CORRIDORS as $c): ?>
        <option value="<?php echo htmlspecialchars($c); ?>" <?php echo ($corridor === $c) ? 'selected' : ''; ?>><?php echo htmlspecialchars($c); ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Search</button>
    <?php if ($q !== '' || $corridor !== ''): ?>
      <a class="clear" href="directory.php">Clear filters</a>
    <?php endif; ?>
  </form>

  <div class="result-count"><?php echo count($members); ?> member<?php echo count($members) === 1 ? '' : 's'; ?> found</div>

  <div class="grid cols-3">
    <?php if (empty($members)): ?>
      <div class="empty">No members match this search yet.</div>
    <?php else: ?>
      <?php foreach ($members as $m): ?>
        <div class="card">
          <div class="corner"></div>
          <span class="badge active">Active</span>
          <h3 style="margin-top:8px;"><?php echo htmlspecialchars($m['companyName']); ?></h3>
          <p><?php echo htmlspecialchars($m['location']); ?> &middot; <?php echo htmlspecialchars($m['transportType']); ?></p>
          <div class="pillrow"><span class="pill"><?php echo htmlspecialchars($m['corridor']); ?></span></div>
          <p style="font-size:13px;"><?php echo htmlspecialchars($m['services'] ?? ''); ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
