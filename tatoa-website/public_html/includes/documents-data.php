<?php
/**
 * Document catalog shared by resources.php and publications.php.
 * category: 'resource' | 'publication'
 * access:   'public'   -> served directly from assets/documents/public/
 *           'members'  -> served only via download.php after email
 *                          verification, from data/private-documents/
 *                          (already blocked from direct web access by
 *                          data/.htaccess)
 *
 * These are sample placeholder files for demonstration. Replace the
 * files in assets/documents/public/ and data/private-documents/ with
 * real TATOA documents, keeping the same filenames or updating them here.
 */
function get_documents(): array {
    return [
        [
            "key" => "membership-guide",
            "category" => "resource",
            "title" => "TATOA Membership Application Guide",
            "access" => "public",
            "file" => "membership-application-guide.txt",
            "desc" => "How to complete your application and required documents.",
        ],
        [
            "key" => "axle-load-reference",
            "category" => "resource",
            "title" => "Axle Load Regulations (Reference)",
            "access" => "public",
            "file" => "axle-load-reference.txt",
            "desc" => "Sample reference summary of axle-load limits by road class — verify against official LATRA publications before relying on it.",
        ],
        [
            "key" => "renewal-circular",
            "category" => "resource",
            "title" => "Membership Renewal Circular",
            "access" => "members",
            "file" => "membership-renewal-circular.txt",
            "desc" => "Annual renewal instructions and fee schedule.",
        ],
        [
            "key" => "agm-minutes",
            "category" => "resource",
            "title" => "AGM Minutes — Previous Meeting",
            "access" => "members",
            "file" => "agm-minutes-sample.txt",
            "desc" => "Minutes and resolutions from the last annual meeting.",
        ],
        [
            "key" => "quarterly-newsletter",
            "category" => "publication",
            "title" => "TATOA Quarterly Newsletter",
            "access" => "public",
            "file" => "quarterly-newsletter-sample.txt",
            "desc" => "Sample issue covering association news, new members and upcoming meetings.",
        ],
        [
            "key" => "annual-report",
            "category" => "publication",
            "title" => "Annual Report (Summary)",
            "access" => "public",
            "file" => "annual-report-summary-sample.txt",
            "desc" => "Sample public summary of the Association's yearly activities.",
        ],
        [
            "key" => "financial-report",
            "category" => "publication",
            "title" => "Detailed Financial Report",
            "access" => "members",
            "file" => "financial-report-sample.txt",
            "desc" => "Full financial statement, available to active members only.",
        ],
    ];
}

function get_document(string $key): ?array {
    foreach (get_documents() as $d) {
        if ($d['key'] === $key) return $d;
    }
    return null;
}
