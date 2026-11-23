<?php
$page_title = "Contact";
include 'includes/header.php';
require_once 'includes/data.php';

$flash = flash_get();
$old = $_SESSION['old_contact_input'] ?? [];
unset($_SESSION['old_contact_input']);
function cval($old, $key) { return htmlspecialchars($old[$key] ?? ''); }
?>

<div class="hero" style="padding-top:48px;">
  <span class="eyebrow">Get in touch</span>
  <h1>Contact TATOA.</h1>
  <p class="lede">Questions about membership, the platform, or general inquiries — send a message and TATOA will respond by email.</p>
</div>

<?php if ($flash): ?>
  <div class="notice <?php echo htmlspecialchars($flash['type']); ?>"><?php echo htmlspecialchars($flash['message']); ?></div>
<?php endif; ?>

<section>
  <div class="contact-grid">
    <form action="process-contact.php" method="post">
      <div class="field">
        <label>Name *</label>
        <input required name="name" value="<?php echo cval($old, 'name'); ?>">
      </div>
      <div class="field">
        <label>Email *</label>
        <input required type="email" name="email" value="<?php echo cval($old, 'email'); ?>">
      </div>
      <div class="field">
        <label>Subject</label>
        <select name="subject">
          <?php $subjects = ["General inquiry", "Membership", "Documentation", "Regulatory inquiry", "Training", "Complaint"];
          foreach ($subjects as $s): ?>
            <option <?php echo (($old['subject'] ?? '') === $s) ? 'selected' : ''; ?>><?php echo htmlspecialchars($s); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="field">
        <label>Message *</label>
        <textarea required name="message"><?php echo cval($old, 'message'); ?></textarea>
      </div>
      <p class="required-note">* required fields</p>
      <button class="btn primary" type="submit">Send message</button>
    </form>

    <div class="contact-info">
      <div class="kv"><span class="k">Address</span><span class="v">[TATOA Head Office Address], Dar es Salaam, Tanzania</span></div>
      <div class="kv"><span class="k">Phone</span><span class="v">[TATOA Phone Number]</span></div>
      <div class="kv"><span class="k">Email</span><span class="v">[TATOA Email Address]</span></div>
      <div class="kv"><span class="k">Office hours</span><span class="v">[e.g. Mon–Fri, 8:30–16:30]</span></div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
