# S-Prestige Theme — Project Manager & Progress Log

> **Read this file first at the start of every Claude session.**
> It is the single source of truth for what has been done, what remains, and how this
> project is structured. After reading, **reconcile it against the actual theme folder**
> (the "Reconciliation checklist" at the bottom) before doing any work, then update the
> log as you complete milestones. This file lives inside the theme and is committed to git.

---

## 1. What this project is

Convert the static prototype at `/Users/zattoo/Studio/adnan/s-prestige-site` (3 HTML pages)
into a maintainable WordPress **classic theme** for:

- **Company:** S-Prestige International L.L.C-FZ (Adnan International Trade & Export Group)
- **CEO:** Adnan Mousapour
- **Location:** Meydan Grandstand, 6th Floor, Nad Al Sheba, Dubai, UAE
- **Phone:** (+971) 56 922 2006 · **Email:** s.prestige.international@gmail.com

### Goals (locked with the user)
1. **Pixel-perfect** with the prototype → classic theme, NOT block/FSE.
2. **Fully editable in the future** → every string and image is a Customizer theme mod
   (with the original prototype text as the fallback, so zero visual change before editing).
3. **Import without duplication** → an "Import & Sync" admin page imports images as real
   WP attachments with MD5-hash dedup; re-running skips unchanged files. No URLs stored as meta.
4. **Products = 4 category pages** (Steel / Minerals / Petrochemicals / Chemicals) with
   editable chip lists + descriptions. NOT a custom post type (decided with user — can be
   added later without rework).
5. **Contact Form 7**: the user installs CF7 **after** the theme is built and **before**
   importing data. The theme references CF7 by a stored form-ID option (`spr_contact_form_id`)
   and falls back to a styled mailto block when CF7 is not active/configured.

### Deploy model
- Git repo lives **inside the theme folder** (`wp-content/themes/s-prestige/`).
- Remote: `https://github.com/mazaheri/amirmousa.git` — **only the theme is pushed.**
- cPanel host: `git pull` updates code → admin runs **Appearance → Import & Sync** to populate content.
- Local dev is **WordPress Studio** (PHP WASM + SQLite): every `wp` command needs the `studio` prefix.

---

## 2. Methodology references (read if unsure)
- `/Users/zattoo/Studio/adnan/version 5 import demo workflow/CLAUDE.md` — the import/git workflow (primary).
- `/Users/zattoo/Studio/adnan/version 5 import demo workflow/demo-importer-starter.php` — importer template.
- `/Users/zattoo/Studio/adnan/version 4 download image and blog/` — conversion bible (v4–v8) + QUICK_COMMANDS.
- `/Users/zattoo/Studio/adnan/s-prestige-site/` — the source prototype (index/products/about + content-reference.txt).

---

## 3. Architecture map

```
wp-content/themes/s-prestige/
├── style.css                 Theme header + (minimal) overrides
├── functions.php             Setup, enqueue, menus, helper includes
├── header.php                Shared nav (dynamic logo text, menu, CTA)
├── footer.php                Shared footer (dynamic contact, links, social, marquee)
├── front-page.php            Home — verbatim prototype, dynamic strings/images
├── page-products.php         Products — 4 category sections, dynamic
├── page-about.php            About + Services + CEO, dynamic
├── page.php / index.php      Generic fallbacks
├── 404.php                   Not-found
├── inc/
│   ├── helpers.php           spr_text(), spr_img_url(), spr_contact_form() getters
│   ├── customizer.php        ALL editable fields (panels: Hero, About, Products, Services, Contact, Footer, Social)
│   └── demo-importer.php     "Import & Sync" admin page — hash dedup, reset, CF7-aware
├── content/images/           Source images + ship.mp4 (committed to git, imported by Sync)
├── assets/css/theme.css      Consolidated CSS from the 3 prototype pages
├── assets/js/theme.js        FAQ accordion + smooth back-to-top
├── README.md                 Deploy instructions
├── .gitignore
└── PROJECT.md                THIS FILE
```

### Naming conventions (prefix `spr_`)
- Theme mods (text):   `spr_hero_tagline`, `spr_hero_title`, `spr_about_intro`, `spr_ceo_quote`, …
- Theme mods (images): stored as **attachment IDs** → `spr_hero_video_id`, `spr_prod_steel_id`, …
- Options (page IDs):  `spr_products_page_id`, `spr_about_page_id`, `spr_contact_form_id`
- Attachment meta:     `_source_file_path`, `_source_file_hash` (for dedup + reset)

---

## 4. Progress log (newest at top)

### 2026-05-31 — Session 2 (deploy + CF7 + author) — COMPLETE
- [x] Pushed initial theme to `origin/main` (amirmousa.git). Commit `e6f612f`.
- [x] User's CF7 shortcode is `[contact-form-7 id="1d3f601" title="Contact form 1"]`.
      CF7 6.1.6 is ACTIVE; the form is post ID 19, `_hash` = 1d3f60134cffe5… and
      `1d3f601` is the 7-char hash prefix. CF7 accepts hash OR numeric id.
- [x] Fixed importer + helper to store the CF7 id as a **string** (was absint, which
      broke the hash). Field now accepts a hash, a number, or a full pasted shortcode
      (extracts the id). Commit `b56036c`.
- [x] Saved id `1d3f601` to option `spr_contact_form_id` on the LOCAL site → real CF7
      form now renders in the contact section, styled via `.spr-cf7`.
- [x] Set theme author → **Pourya Mazaheri**, Author URI + Theme URI = valasolution.com,
      LinkedIn (linkedin.com/in/pourya-mazaheri-fard-2b4299390) in Description + README.
      Commit `ffa8650`.
- [x] Hid CF7 errors: `spr_contact_form()` renders the shortcode, outputs it ONLY if it
      contains a real `<form>`; if the form is missing/broken (CF7 prints "Error: Contact
      form not found.") it falls back to the styled mailto block. Verified both paths.
      Commit `1a0884b`.
- [x] All 4 commits pushed; `main` in sync with `origin/main`; working tree clean.

**STATE AT SESSION CLOSE (2026-05-31):**
- Remote `origin/main` @ `1a0884b` — fully deployed/pushed.
- LOCAL Studio site: theme active, content imported, CF7 form `1d3f601` wired up & rendering.
- Option `spr_contact_form_id` = `1d3f601` (LOCAL only — DB value, NOT in git).

**NEXT SESSION should:**
1. (Deploy) On cPanel: `git pull origin main` in the theme dir → Appearance → Import & Sync
   → Sync All (first time). Then create the CF7 form THERE and set its (different) hash id
   under Import & Sync → Contact Form 7. Production form id ≠ local `1d3f601`.
2. (Optional) Visually spot-check pixel fidelity vs the prototype, especially the CF7
   contact form's two-column field layout.
3. Future edits: change in Customizer (content) or edit code → commit → push → pull on cPanel.

---

### 2026-05-31 — Session 1 (initial build) — COMPLETE
- [x] Read all methodology docs (v4 bible, v5 import workflow, demo-importer-starter).
- [x] Read all 3 prototype pages + content-reference.txt + README.
- [x] Confirmed with user: fully-dynamic copy; products = 4 category pages (no CPT).
- [x] Created theme skeleton dirs; copied 5 images + ship.mp4 into `content/images/`.
- [x] Wrote PROJECT.md (this file).
- [x] Built ALL theme files: style.css, functions.php, header/footer, front-page,
      page-products, page-about, page, index, 404, inc/helpers, inc/customizer,
      inc/demo-importer, assets/css/theme.css, assets/js/theme.js, README, .gitignore.
- [x] Activated theme in Studio. All 12 PHP files pass syntax (token_get_all TOKEN_PARSE).
- [x] Ran Import & Sync (Sync All): Home/Products/About pages created (IDs 5/6/7),
      front page set to Home, templates assigned, Primary nav menu built.
- [x] Imported 6 attachments (4 product imgs + sea img + ship.mp4) → theme-mod IDs 12–17.
      All text theme mods applied from defaults.
- [x] Verified all 3 pages return HTTP 200, no fatal errors, correct content per page.
- [x] Verified idempotency: 2× image re-import keeps exactly 6 attachments (hash dedup works).
- [x] Verified CF7 fallback button renders (CF7 not yet installed — by design).
- [x] git initialized in theme dir; remote = amirmousa.git. NOT pushed (awaiting user go-ahead).

**NEXT SESSION should:**
1. User installs Contact Form 7, creates a form, enters its ID under Appearance → Import & Sync.
2. Optionally browse the live site visually for any pixel tweaks vs the prototype.
3. When user approves, `git push origin main` to amirmousa.git for cPanel pull.

---

## 5. Reconciliation checklist (verify against the real folder each session)

Run from the theme dir and tick what physically exists:

- [ ] `style.css` present with valid theme header
- [ ] `functions.php` enqueues `assets/css/theme.css` + `assets/js/theme.js`
- [ ] `inc/helpers.php`, `inc/customizer.php`, `inc/demo-importer.php` present
- [ ] `header.php` + `footer.php` present
- [ ] `front-page.php`, `page-products.php`, `page-about.php`, `index.php`, `404.php` present
- [ ] `assets/css/theme.css` + `assets/js/theme.js` present
- [ ] `content/images/` has the 5 jpgs + ship.mp4
- [ ] Theme activated: `studio wp theme list --status=active --format=csv`
- [ ] Pages created + front page set: `studio wp option get page_on_front`
- [ ] Import & Sync run at least once (images are real attachments)
- [ ] git initialized in theme dir, remote = amirmousa.git

**Quick state dump:**
```bash
cd wp-content/themes/s-prestige
find . -maxdepth 2 -type f | sort
studio wp theme list --format=csv
studio wp eval 'var_dump(get_theme_mods());' | head -40
git -C . remote -v
```

---

## 6. Known gotchas (from v5 methodology)
- Use **`'full'`** image size when displaying register-upload images (named sizes may not exist).
- Store **attachment IDs**, never URLs, as meta/mods (except where a raw URL is needed for CSS bg).
- Tag every imported attachment with `_source_file_path` so Reset can clean up — no orphans.
- Re-import must be idempotent (hash check) — never duplicate attachments.
- SQLite: no FULLTEXT, no DB_* constants. `studio wp eval`, not `wp shell`.
