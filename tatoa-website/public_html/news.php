<?php
$page_title = "News";
include 'includes/header.php';

/**
 * Sample/placeholder content for demonstration. Once the Admin
 * Dashboard (Module 11) is built, TATOA staff will publish these
 * directly instead of editing this array.
 */
$news_items = [
    ["category" => "TATOA Announcement", "date" => "2026-08-20", "title" => "New online membership applications now open", "body" => "Sample notice: TATOA is piloting online membership applications ahead of the full digital platform launch."],
    ["category" => "Bulletin",           "date" => "2026-08-05", "title" => "TATOA quarterly bulletin", "body" => "Placeholder bulletin covering association news, new members and upcoming meetings."],
    ["category" => "Meeting Recap",      "date" => "2026-07-18", "title" => "Regional chapter meeting — Mbeya", "body" => "Sample recap of a regional members' meeting discussing corridor conditions and dues."],
    ["category" => "Membership News",    "date" => "2026-07-02", "title" => "Directory now searchable by corridor", "body" => "Sample update: the Member Directory can now be filtered by operating corridor and cargo type."],
];

$category = trim($_GET['category'] ?? '');
$categories = array_values(array_unique(array_column($news_items, 'category')));

$filtered = $category === '' ? $news_items : array_values(array_filter($news_items, fn($n) => $n['category'] === $category));
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">TATOA news</span>
  <h1>News &amp; announcements.</h1>
  <p class="lede">Association news, bulletins and meeting recaps in one feed.</p>
</div>

<div class="notice">Sample announcements for demonstration — the live platform will show real TATOA news as it's published.</div>

<section>
  <form class="filterbar" method="get" action="news.php">
    <select name="category">
      <option value="">All categories</option>
      <?php foreach ($categories as $c): ?>
        <option value="<?php echo htmlspecialchars($c); ?>" <?php echo ($category === $c) ? 'selected' : ''; ?>><?php echo htmlspecialchars($c); ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Filter</button>
    <?php if ($category !== ''): ?><a class="clear" href="news.php">Clear</a><?php endif; ?>
  </form>

  <div class="grid cols-2">
    <?php if (empty($filtered)): ?>
      <div class="empty">No news items in this category yet.</div>
    <?php else: ?>
      <?php foreach ($filtered as $n): ?>
        <div class="card">
          <div class="corner"></div>
          <div class="pillrow"><span class="pill"><?php echo htmlspecialchars($n['category']); ?></span> <span class="pill mono"><?php echo htmlspecialchars($n['date']); ?></span></div>
          <h3><?php echo htmlspecialchars($n['title']); ?></h3>
          <p><?php echo htmlspecialchars($n['body']); ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
