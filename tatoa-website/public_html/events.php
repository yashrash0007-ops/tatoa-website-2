<?php
$page_title = "Events";
include 'includes/header.php';
require_once 'includes/data.php';
require_once 'includes/events-data.php';

$flash = flash_get();
$events = get_events();
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">Meetings &amp; training</span>
  <h1>Events &amp; training.</h1>
  <p class="lede">TATOA publishes annual meetings, workshops and training sessions here. Active members can register online and receive confirmation.</p>
</div>

<?php if ($flash): ?>
  <div class="notice <?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['message']); ?></div>
<?php endif; ?>

<section>
  <div class="grid cols-3">
    <?php foreach ($events as $ev):
      $count = count_registrations($ev['id']);
    ?>
      <div class="card">
        <div class="corner"></div>
        <div class="pillrow">
          <span class="pill mono"><?php echo htmlspecialchars($ev['date']); ?></span>
          <span class="pill"><?php echo htmlspecialchars($ev['location']); ?></span>
        </div>
        <h3><?php echo htmlspecialchars($ev['title']); ?></h3>
        <p><?php echo htmlspecialchars($ev['description']); ?></p>
        <p class="lock-note"><?php echo $count; ?> member<?php echo $count === 1 ? '' : 's'; ?> registered</p>

        <form class="inline-mini" action="process-event-registration.php" method="post">
          <input type="hidden" name="eventId" value="<?php echo htmlspecialchars($ev['id']); ?>">
          <div class="field">
            <label>Member email</label>
            <input required type="email" name="email" placeholder="you@company.co.tz">
          </div>
          <button type="submit">Register</button>
        </form>
        <p class="lock-note">Registration is open to active TATOA members. <a href="membership.php">Not a member yet?</a></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
