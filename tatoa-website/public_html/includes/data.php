<?php
/**
 * Data access layer for the TATOA Digital Platform.
 *
 * Storage: flat JSON files in data/, which lives OUTSIDE public_html/ —
 * one level above your web server's document root — so it is never
 * reachable by a direct URL regardless of server config. Point your
 * web server's document root at public_html/, not at the project
 * folder itself.
 *
 * Storage is intentionally simple (JSON files) so Membership, the
 * Directory, Events and gated documents all work today without a
 * database server. When you're ready to move to MySQL, only the
 * functions in this file need to change.
 */

define('DATA_DIR', dirname(__DIR__, 2) . '/data');
define('MEMBERS_FILE', DATA_DIR . '/members.json');
define('EVENT_REG_FILE', DATA_DIR . '/event_registrations.json');
define('CONTACT_FILE', DATA_DIR . '/contact_messages.json');
define('PRIVATE_DOCS_DIR', DATA_DIR . '/private-documents');

// ---------- shared reference lists (used by both the application form
// and the directory filters, so they always match) ----------
const TRANSPORT_TYPES = [
    "General Cargo",
    "Fuel & Tanker",
    "Bulk / Mining",
    "Container / Port Transit",
    "Livestock",
    "Passenger & Cargo Mixed",
];

const CORRIDORS = [
    "Dar es Salaam – Zambia (TAZARA)",
    "Dar es Salaam – Rwanda/Burundi",
    "Dar es Salaam – DRC (Central Corridor)",
    "Dar es Salaam – Malawi",
    "Tanga – Arusha – Namanga",
    "Mtwara Corridor",
    "Domestic / Regional (within Tanzania)",
];

// ---------- storage bootstrap ----------
function ensure_data_dir(): void {
    if (!is_dir(DATA_DIR)) {
        mkdir(DATA_DIR, 0755, true);
    }
}

function ensure_data_store(): void {
    ensure_data_dir();
    if (!file_exists(MEMBERS_FILE)) {
        // Seed with a few sample members so the Directory isn't empty
        // on first run. Safe to delete these later from the JSON file
        // or (once built) the Admin Dashboard.
        $seed = [
            [
                "id" => "member_seed1",
                "companyName" => "Kilimanjaro Freight Ltd",
                "contactName" => "Amani Mushi",
                "email" => "amani@kilifreight.co.tz",
                "phone" => "+255 754 000111",
                "location" => "Arusha",
                "transportType" => "General Cargo",
                "truckType" => "18 x flatbed 30t",
                "corridor" => "Tanga – Arusha – Namanga",
                "cargo" => "Agricultural produce, general goods",
                "services" => "Regional and cross-border cargo hauling with own clearing team.",
                "status" => "active",
                "joinedDate" => date('Y-m-d'),
            ],
            [
                "id" => "member_seed2",
                "companyName" => "Nyerere Bulk Transporters",
                "contactName" => "Grace Mwakalinga",
                "email" => "grace@nyereretrans.co.tz",
                "phone" => "+255 754 000222",
                "location" => "Dar es Salaam",
                "transportType" => "Bulk / Mining",
                "truckType" => "25 x tipper 20t",
                "corridor" => "Dar es Salaam – DRC (Central Corridor)",
                "cargo" => "Minerals, construction aggregates",
                "services" => "Bulk mineral haulage to DRC and Zambia.",
                "status" => "active",
                "joinedDate" => date('Y-m-d'),
            ],
            [
                "id" => "member_seed3",
                "companyName" => "Ruvuma Cargo Movers",
                "contactName" => "Fatma Said",
                "email" => "fatma@ruvumacargo.co.tz",
                "phone" => "+255 754 000444",
                "location" => "Mtwara",
                "transportType" => "Container / Port Transit",
                "truckType" => "8 x container chassis",
                "corridor" => "Mtwara Corridor",
                "cargo" => "Containerized port cargo",
                "services" => "Port-to-inland container transport.",
                "status" => "pending",
                "joinedDate" => date('Y-m-d'),
            ],
        ];
        write_members($seed);
    }
}

// ---------- generic JSON-list storage (used for members, event
// registrations, and contact messages — same file-lock pattern each time) ----------
function read_json_list(string $file): array {
    ensure_data_dir();
    if (!file_exists($file)) return [];
    $raw = file_get_contents($file);
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function write_json_list(string $file, array $list): bool {
    ensure_data_dir();
    $fp = fopen($file, 'c+');
    if (!$fp) return false;
    $ok = false;
    if (flock($fp, LOCK_EX)) {
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fflush($fp);
        flock($fp, LOCK_UN);
        $ok = true;
    }
    fclose($fp);
    return $ok;
}

function read_members(): array {
    ensure_data_store();
    return read_json_list(MEMBERS_FILE);
}

function write_members(array $members): bool {
    return write_json_list(MEMBERS_FILE, $members);
}

function find_member_by_email(string $email): ?array {
    foreach (read_members() as $m) {
        if (strcasecmp($m['email'], $email) === 0) return $m;
    }
    return null;
}

function add_member(array $record): array {
    $members = read_members();
    $record['id'] = 'member_' . bin2hex(random_bytes(5));
    $record['status'] = 'pending';
    $record['joinedDate'] = date('Y-m-d');
    $members[] = $record;
    write_members($members);
    return $record;
}

// ---------- active-member check (used to gate event registration and
// members-only documents until the Member Portal has real login) ----------
function is_active_member(string $email): bool {
    $m = find_member_by_email($email);
    return $m !== null && $m['status'] === 'active';
}

// ---------- event registrations ----------
function read_event_registrations(): array {
    return read_json_list(EVENT_REG_FILE);
}

function has_registered(string $eventId, string $email): bool {
    foreach (read_event_registrations() as $r) {
        if ($r['eventId'] === $eventId && strcasecmp($r['email'], $email) === 0) return true;
    }
    return false;
}

function count_registrations(string $eventId): int {
    return count(array_filter(read_event_registrations(), fn($r) => $r['eventId'] === $eventId));
}

function add_event_registration(string $eventId, string $email, string $companyName): array {
    $regs = read_event_registrations();
    $rec = [
        'id' => 'reg_' . bin2hex(random_bytes(5)),
        'eventId' => $eventId,
        'email' => $email,
        'companyName' => $companyName,
        'date' => date('Y-m-d H:i:s'),
    ];
    $regs[] = $rec;
    write_json_list(EVENT_REG_FILE, $regs);
    return $rec;
}

// ---------- contact messages ----------
function read_contact_messages(): array {
    return read_json_list(CONTACT_FILE);
}

function add_contact_message(array $record): array {
    $msgs = read_contact_messages();
    $record['id'] = 'msg_' . bin2hex(random_bytes(5));
    $record['date'] = date('Y-m-d H:i:s');
    $msgs[] = $record;
    write_json_list(CONTACT_FILE, $msgs);
    return $record;
}

// ---------- one-time flash messages (survive a redirect after form submit) ----------
function flash_set(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function flash_get(): ?array {
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $f;
    }
    return null;
}
