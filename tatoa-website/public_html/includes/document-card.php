<?php
/**
 * Renders one document as a .card — a public document with a direct
 * download link, or a members-only document with an inline email-gate
 * form that posts to download.php.
 *
 * $returnPage: which page to flash-redirect back to on failure
 * ('resources.php' or 'publications.php').
 */
function render_document_card(array $doc, string $returnPage): void {
    $isPublic = $doc['access'] === 'public';
    ?>
    <div class="card">
        <div class="corner"></div>
        <span class="badge <?php echo $isPublic ? 'active' : 'members'; ?>"><?php echo $isPublic ? 'Public' : 'Members only'; ?></span>
        <h3 style="margin-top:8px;"><?php echo htmlspecialchars($doc['title']); ?></h3>
        <p><?php echo htmlspecialchars($doc['desc']); ?></p>

        <?php if ($isPublic): ?>
            <a class="btn small ghost" style="margin-top:10px;"
               href="assets/documents/public/<?php echo htmlspecialchars($doc['file']); ?>"
               download>Download</a>
        <?php else: ?>
            <form class="inline-mini" action="download.php" method="post">
                <input type="hidden" name="key" value="<?php echo htmlspecialchars($doc['key']); ?>">
                <input type="hidden" name="returnTo" value="<?php echo htmlspecialchars($returnPage); ?>">
                <div class="field">
                    <label>Member email</label>
                    <input required type="email" name="email" placeholder="you@company.co.tz">
                </div>
                <button type="submit">Unlock &amp; download</button>
            </form>
            <p class="lock-note">Available to active TATOA members. <a href="membership.php">Not a member yet?</a></p>
        <?php endif; ?>
    </div>
    <?php
}
