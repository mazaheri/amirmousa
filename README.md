# S-Prestige International — WordPress Theme

Bespoke classic theme for **S-Prestige International L.L.C-FZ** (Adnan International
Trade & Export Group). Converted pixel-for-pixel from the static prototype, with every
string and image made editable via the WordPress **Customizer** and a built-in
**Import & Sync** admin page.

**Author:** Pourya Mazaheri — [valasolution.com](https://valasolution.com) · [LinkedIn](https://www.linkedin.com/in/pourya-mazaheri-fard-2b4299390)

> This repository is **theme-only** — it is the contents of `wp-content/themes/s-prestige/`.
> On the server it lives at that path; `git pull` updates the code, then the admin runs
> **Appearance → Import & Sync** to populate content.

---

## What's editable

- **All copy** — hero, Why-Us stats, product descriptions & chip lists, shipping promo,
  About intro & stats, services, CEO message, contact details, footer, social links,
  marquee text → **Appearance → Customize → S-Prestige Content**.
- **All images & the hero video** → same panel, or the media controls in each section.
- **Navigation** → **Appearance → Menus** (Primary location). A sensible default menu is
  created by Import & Sync; edit it freely.
- **Contact form** → Contact Form 7. See below.

Nothing is hardcoded that the client would reasonably want to change. Every value falls
back to the original prototype text, so the site looks identical before any editing.

---

## First-time setup (local or production)

1. Place this folder at `wp-content/themes/s-prestige/`.
2. Activate **S-Prestige International** under **Appearance → Themes**.
3. Go to **Appearance → Import & Sync → Sync All**. This:
   - creates the Home (front page), Products, About pages and assigns their templates,
   - builds the Primary navigation menu,
   - imports the 4 product images, the shipping image, and the hero video as media
     attachments (hash-deduped — safe to re-run),
   - fills in all default copy.
4. (Optional but recommended) Install **Contact Form 7**, create a form, then enter its
   ID under **Appearance → Import & Sync → Contact Form 7**. Until you do, the contact
   section shows a styled “Email us” button — never a blank space.

### Suggested Contact Form 7 form

Reuse the prototype field styling by adding `class:form-input` to fields:

```
<div class="form-row">
  <div class="field"><label>Full name *</label>[text* your-name class:form-input placeholder "Your name"]</div>
  <div class="field"><label>Company</label>[text company class:form-input placeholder "Company name"]</div>
</div>
<div class="form-row">
  <div class="field"><label>Email *</label>[email* your-email class:form-input placeholder "you@company.com"]</div>
  <div class="field"><label>Phone</label>[tel phone class:form-input placeholder "+971 ..."]</div>
</div>
<div class="field"><label>Product of interest</label>[select product class:form-input "Steel" "Minerals" "Petrochemicals" "Chemicals" "Logistics / Shipping"]</div>
<div class="field"><label>Message *</label>[textarea* your-message class:form-input placeholder "Tell us the grade, quantity, and destination…"]</div>
[submit class:contact-submit "Send message"]
```

The theme also auto-styles default CF7 markup via `.spr-cf7`, so a plain form looks right too.

---

## Updating an existing site

| Change | Steps |
|--------|-------|
| Code (templates, CSS, JS) | `git pull` — done. |
| Text/copy | Edit in **Customize → S-Prestige Content**. (Or commit new defaults and use Import & Sync → Site Text on a blank value.) |
| Swap an image | **Customize** the relevant image control, **or** replace the file in `content/images/`, commit, `git pull`, then **Import & Sync → Images** (hash dedup re-imports only changed files). |
| New nav item | **Appearance → Menus**. |

---

## Deploy (git → cPanel)

This theme is tracked in its own git repo. Remote:
`https://github.com/mazaheri/amirmousa.git`

```bash
# from inside wp-content/themes/s-prestige/
git add -A
git commit -m "Update theme"
git push origin main
```

On the cPanel host, the theme directory is a clone of the same repo:

```bash
cd ~/public_html/wp-content/themes/s-prestige
git pull origin main
# then WP Admin → Appearance → Import & Sync (first deploy only, or after content changes)
```

---

## Local development (WordPress Studio)

This site runs in WordPress Studio (PHP WASM + SQLite). All `wp` commands need the
`studio` prefix:

```bash
studio site status
studio wp theme activate s-prestige
studio wp eval 'var_dump(get_theme_mods());'
```

---

## File map

```
s-prestige/
├── style.css              Theme header
├── functions.php          Setup, asset enqueue, includes
├── header.php             Shared sticky nav (inner pages)
├── footer.php             Shared marquee + footer
├── front-page.php         Home (video hero + all sections)
├── page-products.php      Products (4 categories)
├── page-about.php         About + Services + CEO
├── page.php / index.php   Generic + blog fallbacks
├── 404.php
├── inc/
│   ├── helpers.php         spr_text() / spr_img_url() / spr_contact_form() + nav
│   ├── customizer.php      All editable fields
│   └── demo-importer.php   Import & Sync admin page
├── content/images/        Source images + ship.mp4 (committed; imported by Sync)
├── assets/css/theme.css    Consolidated styles
├── assets/js/theme.js      FAQ accordion + back-to-top
└── PROJECT.md              Project-manager log (read at session start)
```

See `PROJECT.md` for the full progress log and architecture notes.
```
