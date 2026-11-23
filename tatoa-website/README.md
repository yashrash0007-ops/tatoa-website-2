# TATOA Digital Platform — deployment notes

## Folder structure — read this before deploying

```
tatoa-website/
├── data/              ← NEVER point your web server here
│   ├── members.json (auto-created on first run)
│   ├── event_registrations.json (auto-created)
│   ├── contact_messages.json (auto-created)
│   └── private-documents/   (members-only files — served only via download.php)
└── public_html/       ← POINT YOUR WEB SERVER'S DOCUMENT ROOT HERE
    ├── index.php, about.php, membership.php, ...
    ├── includes/
    └── assets/
```

**Set your web server's document root (or your hosting account's "public" folder) to
`public_html/`, not to the `tatoa-website/` folder itself.** `data/` must remain a
sibling of `public_html/`, outside anything the web server serves.

This is deliberate: an earlier version of this project kept `data/` inside the
web-served folder and relied on a `.htaccess` file to block direct access to it.
That only works if the web server actually honors `.htaccess` — Ubuntu's default
Apache config (`AllowOverride None`) does **not**, and PHP's built-in dev server
ignores `.htaccess` entirely. With the current structure, member records and
members-only documents are unreachable by any direct URL regardless of server
config, because they simply aren't inside the served directory tree. The
`data/.htaccess` file is kept as a second layer of defense, not the only one.

If your hosting account only gives you one folder to upload into and calls it
your "web root" (common on shared hosting/cPanel), upload `public_html/`'s
*contents* there, and upload `data/` one level above it — most shared hosts
give you a private area outside the web root for exactly this.

## What's already working

- **Membership** — application form validates input, rejects duplicate emails,
  stores new applications as `Pending` in `data/members.json`.
- **Member Directory** — searchable by text and corridor; only shows members
  with status `Active`.
- **Events** — registration is gated: only members with status `Active` can
  register (checked by email lookup against `data/members.json`).
- **Resources / Publications** — public documents download directly from
  `public_html/assets/documents/public/`. Members-only documents live in
  `data/private-documents/` and only reach the browser through `download.php`,
  which re-checks active-member status on every request.
- **Contact** — messages save to `data/contact_messages.json`.

## Known placeholders to replace

- `public_html/leadership.php` — `$leaders` array has placeholder names/bios.
- `public_html/gallery.php` — `$gallery_items` array has no real photos yet;
  drop images into `public_html/assets/img/gallery/` and update the `photo` key.
- `public_html/assets/documents/public/*.txt` and
  `data/private-documents/*.txt` — sample placeholder documents; swap in real
  ones (any file type works, not just `.txt` — update the `file` key in
  `public_html/includes/documents-data.php` to match).
- `public_html/contact.php` — `[TATOA Head Office Address]` etc. are placeholders.
- `public_html/news.php` and `public_html/industry-updates.php` — sample news
  items, clearly labeled as such on the page.

## Not yet built

- **Member Portal** (Module 2) — members currently identify themselves by
  email on each form (events, gated documents). A real login/session system
  is the natural next step and would replace those email checks.
- **Admin Dashboard** (Module 11) — approving/rejecting applications,
  managing content, and reading contact messages all currently require
  editing `data/*.json` directly.

## Moving off JSON files to a real database

Every page calls functions in `public_html/includes/data.php`
(`read_members()`, `add_member()`, `add_event_registration()`, etc.) — none of
them touch the JSON files directly. Swapping to MySQL later means rewriting
the insides of those functions only; no page code needs to change.
