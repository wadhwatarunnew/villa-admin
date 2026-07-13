# villadashboard Bootstrap Upgrade Plan

## Scope

This plan covers only files under `villadashboard/`.

Public site files outside `villadashboard/` are excluded from this upgrade.

## Phase 1: Freeze and baseline

- Backup current dashboard files.
- Keep the current behavior working before changing any CSS or JS.
- Avoid touching backup or archive files unless they are actively used.

## Phase 2: Shared layout first

Update shared dashboard includes so all pages inherit the new assets:

- `villadashboard/common/header.php`
- `villadashboard/common/footer.php`

Tasks:

- Replace Bootstrap 4 assets with Bootstrap 5 assets.
- Keep jQuery only if custom dashboard scripts still depend on it.

## Phase 3: Global class and attribute migration

Apply safe replacements across dashboard pages:

- `data-toggle` -> `data-bs-toggle`
- `data-target` -> `data-bs-target`
- `ml-*` -> `ms-*`
- `mr-*` -> `me-*`
- `col-xs-*` -> `col-*` where needed

## Phase 4: Component fixes

Fix Bootstrap 5 breaking patterns page by page:

- `input-group-prepend` and `input-group-append`
- `custom-file` markup
- dropdown markup
- old utility classes and spacing helpers

## Phase 5: Page rollout order

Recommended rollout order:

1. `villadashboard/login.php`
2. `villadashboard/index.php`
3. `villadashboard/profile.php`
4. `villadashboard/about-page.php`
5. `villadashboard/home-page.php`
6. `villadashboard/contact-page.php`
7. Listing and form pages for blog, project, gallery, youtube, review, resort, and nav sections

## Phase 6: Validation

Test after each batch:

- desktop and mobile layout
- dropdowns and toggles
- forms and validation styles
- AJAX widgets and counters
- modals and file upload areas

## Excluded for now

- AJAX handlers
- delete handlers
- transfer scripts
- session and DB helper files
- backup and `_bkp` pages

## Notes

- `villadashboard` currently uses Bootstrap 4.4.1.
- Bootstrap 5 migration is possible, but it should be done incrementally.
- Start with shared layout files before moving to individual pages.