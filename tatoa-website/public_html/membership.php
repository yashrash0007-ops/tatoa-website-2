<?php
$page_title = "Membership";
include 'includes/header.php';
require_once 'includes/data.php';

$flash = flash_get();

// Repopulate the form after a validation error, so the applicant
// doesn't have to retype everything.
$old = $_SESSION['old_membership_input'] ?? [];
unset($_SESSION['old_membership_input']);
function val($old, $key) { return htmlspecialchars($old[$key] ?? ''); }
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">Join TATOA</span>
  <h1>Become a TATOA member.</h1>
  <p class="lede">Complete your company profile below. Applications are reviewed by TATOA administrators — you'll move from <strong>Pending</strong> to <strong>Active</strong> once approved, and your profile will appear in the Member Directory.</p>
</div>

<?php if ($flash): ?>
  <div class="notice <?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['message']); ?></div>
<?php endif; ?>

<section>
  <div class="section-head">
    <h2>Membership application</h2>
    <span class="tag">Module 4 &middot; Online Membership System</span>
  </div>

  <form action="process-membership.php" method="post" style="max-width:720px;">
    <div class="formgrid">
      <div class="field">
        <label>Company name *</label>
        <input required name="companyName" value="<?php echo val($old, 'companyName'); ?>">
      </div>
      <div class="field">
        <label>Contact person *</label>
        <input required name="contactName" value="<?php echo val($old, 'contactName'); ?>">
      </div>
      <div class="field">
        <label>Email *</label>
        <input required type="email" name="email" value="<?php echo val($old, 'email'); ?>">
      </div>
      <div class="field">
        <label>Phone *</label>
        <input required name="phone" value="<?php echo val($old, 'phone'); ?>">
      </div>
      <div class="field">
        <label>Location (region/town) *</label>
        <input required name="location" value="<?php echo val($old, 'location'); ?>">
      </div>
      <div class="field">
        <label>Transport type</label>
        <select name="transportType">
          <?php foreach (TRANSPORT_TYPES as $t): ?>
            <option <?php echo (($old['transportType'] ?? '') === $t) ? 'selected' : ''; ?>><?php echo htmlspecialchars($t); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="field">
        <label>Truck type / fleet</label>
        <input name="truckType" placeholder="e.g. 10 x 30-tonne flatbed" value="<?php echo val($old, 'truckType'); ?>">
      </div>
      <div class="field">
        <label>Operating corridor</label>
        <select name="corridor">
          <?php foreach (CORRIDORS as $c): ?>
            <option <?php echo (($old['corridor'] ?? '') === $c) ? 'selected' : ''; ?>><?php echo htmlspecialchars($c); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="field">
        <label>Cargo category</label>
        <input name="cargo" placeholder="e.g. agricultural produce, fuel, minerals" value="<?php echo val($old, 'cargo'); ?>">
      </div>
    </div>
    <div class="field">
      <label>Services offered</label>
      <textarea name="services" placeholder="Brief description of transport services offered to shippers/clients"><?php echo val($old, 'services'); ?></textarea>
    </div>
    <p class="required-note">* required fields</p>
    <button class="btn primary" type="submit">Submit application</button>
  </form>
</section>

<section>
  <div class="section-head">
    <h2>Membership fees &amp; renewal</h2>
    <span class="tag">Module 5 &middot; coming with the Member Portal</span>
  </div>
  <div class="grid cols-3">
    <div class="card"><div class="corner"></div><h3>Annual dues</h3><p>Renewable each year once your Member Portal account is live.</p></div>
    <div class="card"><div class="corner"></div><h3>Payment methods</h3><p>Handled by approved payment providers — card details are never stored on the platform itself.</p></div>
    <div class="card"><div class="corner"></div><h3>Payment history</h3><p>Every renewal and receipt will stay on your profile once the portal is connected.</p></div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
