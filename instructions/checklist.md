# Bootstrap 5 PHP Checklist

## Scope
- Upgrade only active PHP files.
- Exclude backup or archival copies such as `_bkp` variants and dated duplicates that are not part of the active path.
- Do not change non-PHP files.

## Completed
- [x] Update shared Bootstrap load path in `common/header.php` to Bootstrap 5 CSS.
- [x] Update shared Bootstrap script in `common/footer.php` to the Bootstrap 5 bundle.
- [x] Replace `data-toggle` with `data-bs-toggle` in the shared dropdown.
- [x] Replace `ml-auto` with `ms-auto` where used in active PHP layout markup.
- [x] Replace `text-left` with `text-start` in `login.php`.
- [x] Replace `float-right` with `float-end` in active PHP pages identified by search.

## Active Pages Status
- [x] All active PHP pages identified in the Bootstrap 4 scan have been upgraded to Bootstrap 5.
- [x] The remaining Bootstrap 4 references are only in excluded backup copies such as `_bkp` pages.

## Reviewed / No Bootstrap 4 References
- [x] `about-page.php` - reviewed and no Bootstrap 4 CSS/JS or utility class references found.

## Verification
- Re-scan PHP files for `bootstrap.min.css`, `bootstrap.min.js`, `data-toggle`, `ml-auto`, `text-left`, and `float-right`.
- Confirm no non-PHP files were modified.
- Run PHP syntax checks on touched files if needed.

## Notes
- Backup or archival copies such as `_bkp` files are excluded from the checklist.
- The current list reflects active PHP files that still show Bootstrap 4 references in the latest scan.
- Pages without Bootstrap 4 references are kept in a reviewed section so the checklist can cover the full PHP set without mixing clean pages into the upgrade list.
