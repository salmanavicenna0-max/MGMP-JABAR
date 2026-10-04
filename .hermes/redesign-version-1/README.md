# Redesign Version 1 — Header MGMP PKK

**Date:** 2026-06-28
**Status:** Approved by user (tested via `/test-header`)

## Files

| File | Description |
|------|-------------|
| `app.blade.php` | Layout baru dengan header "Quiet Security" |
| `preview.blade.php` | Standalone preview page (test-header route) |

## Changes from Original

1. **Removed top bar** (slanted blue + contact info + social media)
2. **Logo + text** — "DINAS PENDIDIKAN JAWA BARAT / MGMP PKK" di samping logo
3. **Flat nav** — no dropdowns, pill-style active state
4. **Avatar system** — inisial fallback jika tidak ada foto profil
5. **Scroll shrink** — logo mengecil, nav links tidak gerak
6. **Backdrop blur** — semi-transparent header
7. **Touch device** — hover utilities auto-disable
8. **Reduced motion** — respects `prefers-reduced-motion`

## To Apply

Replace `resources/views/layouts/app.blade.php` with `app.blade.php` from this folder.

## Route

```php
// Add to routes/web.php for preview
Route::get('/test-header', function () { return view('test.preview'); })->name('test.header');
```
