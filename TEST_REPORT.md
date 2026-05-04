# Kitchen Configurator — Blackbox Test Report

**Date**: 2024-05-03  
**Tester**: Automated blackbox audit  
**Environment**: macOS, PHP 8.3.24, SQLite, Laravel 13, Filament v5, Livewire v4  
**Repo**: `https://github.com/danangprass/kitchen-laravel-configurator`

---

## 1. Test Scope

| Feature | Status |
|---------|--------|
| Frontend Configurator (5-step wizard) | ✅ Tested |
| Category / Subcategory browsing | ✅ Tested |
| Product selection & multi-select | ✅ Tested |
| Accessory filtering & selection | ✅ Tested |
| PDF Export | ✅ Tested |
| Admin Panel (Filament) | ✅ Tested |
| Database Integrity | ✅ Tested |
| Route Availability | ✅ Tested |

---

## 2. Endpoint Smoke Tests

All endpoints returned expected HTTP status codes.

| Endpoint | Method | Status | Notes |
|----------|--------|--------|-------|
| `/` | GET | 200 | Welcome page loads |
| `/configurator` | GET | 200 | Livewire component renders |
| `/configurator/pdf` | GET | 200 | PDF generation works (see §4) |
| `/admin` | GET | 302 | Redirects to login when unauthenticated |
| `/admin/login` | GET | 200 | Filament login form renders |

---

## 3. Database Integrity

### 3.1 Record Counts

| Table | Count | Notes |
|-------|-------|-------|
| `categories` | 12 | 5 parents, 7 children |
| `products` | 287 | All linked to valid categories |
| `accessories` | 444 | All linked via pivot table |
| `product_accessories` | 12,707 | Pivot records |
| `product_images` | 0 | **None uploaded** |
| `accessory_images` | 0 | **None uploaded** |

### 3.2 Data Quality Issues

| Issue | Severity | Details |
|-------|----------|---------|
| **All 287 products have NULL price** | 🔴 High | `price` column is nullable; `getTotalPriceProperty()` returns `null` for every configuration |
| **0 product images** | 🟡 Medium | `product_images` table is empty; product detail cards show no visuals |
| **0 accessory images** | 🟡 Medium | `accessory_images` table is empty |
| No orphan products | 🟢 Low | All products have valid `category_id` |
| No orphan categories | 🟢 Low | Parent/child hierarchy is intact |

---

## 4. PDF Export Test

| Scenario | Result | Size | Verdict |
|----------|--------|------|---------|
| Empty configuration (no params) | HTTP 200 | ~880 KB | Generates a template with empty sections |
| With product ID `1` | HTTP 200 | ~1,034 KB | **Generates a valid PDF with real content** |

**Verdict**: PDF generation works correctly when supplied with real data. The DOMPDF output is valid.

---

## 5. Frontend Configurator — Step-by-Step Review

### Step 1: Choose Oven/s
- ✅ Category grid renders (5 parent categories)
- ✅ Subcategory list renders with **correct product counts** (fixed in commit `6f8794b`)
- ✅ Product cards render with specs (trays, power, dimensions)
- ✅ Multi-select toggle works
- ✅ "Next: Arrangement" button disabled until at least one product selected

### Step 2: Arrangement
- ✅ Selected ovens displayed in review cards
- ✅ Remove button present on each card
- ✅ Back / Next navigation works

### Step 3: Column Accessories
- ✅ Compatible accessories filter based on selected products
- ✅ Position badges (`upper` / `bottom`) display
- ✅ Toggle selection works

### Step 4: Other Accessories
- ✅ Same as Step 3 for `other` / `null` position accessories

### Step 5: Summary
- ✅ Total estimate block renders (always `$0.00` because all prices are NULL)
- ✅ Export to PDF button present
- ✅ Restart button present

---

## 6. Admin Panel (Filament)

| Resource | Nav Visible | CRUD Functional | Notes |
|----------|-------------|-----------------|-------|
| Categories | ✅ Yes | ✅ Yes | Parent/child relation managers work |
| Products | ✅ Yes | ✅ Yes | Image relation manager available |
| Accessories | ❌ **Hidden** | ✅ Yes (via direct URL) | `$shouldRegisterNavigation = false` |
| Product Images | ❌ **Hidden** | ✅ Yes (via direct URL) | `$shouldRegisterNavigation = false` |
| Accessory Images | ✅ Yes | ✅ Yes | Visible in sidebar |

**Theme**: Primary color changed to Slate ✅

---

## 7. Bugs & Issues Found

### 🔴 High Severity

| # | Issue | Location | Impact |
|---|-------|----------|--------|
| 1 | **All product prices are NULL** | `products.price` | Total estimate always `$0.00`; PDF shows no pricing |
| 2 | **All accessory prices are NULL** | `accessories.price` | Same as above |

> **Root Cause**: The scraped data source (`unox.com`) does not expose pricing. Prices must be added manually via the admin panel or imported from another source.

### 🟡 Medium Severity

| # | Issue | Location | Impact |
|---|-------|----------|--------|
| 3 | **Blade references non-existent `code` column** | `resources/views/livewire/configurator.blade.php` | Accessory cards show empty text for "code" |
| 4 | **No product/accessory images uploaded** | `product_images`, `accessory_images` tables | Visual cards have no images; placeholders render |
| 5 | **`downloadPdf()` in Livewire component is dead code** | `app/Livewire/Configurator.php:327` | Method is never called; route uses its own closure |
| 6 | **PDF route duplicates price calculation logic** | `routes/web.php:16-71` | Same summing logic exists in `Configurator.php:getTotalPriceProperty()` |

### 🟢 Low Severity / Code Quality

| # | Issue | Location | Impact |
|---|-------|----------|--------|
| 7 | **Admin credentials hardcoded in README** | `README.md` | Security note added, but should be changed |
| 8 | **Email domain still `@unox.com`** | `database/seeders/UserSeeder` (if exists) | Not rebranded to Kitchen |

---

## 8. Recently Fixed Issues (Verified Working)

| Issue | Fix Commit | Status |
|-------|-----------|--------|
| Back buttons not working | `6f8794b` | ✅ Fixed |
| Subcategory product count always 0 | `6f8794b` | ✅ Fixed |
| Blue theme not switched to slate | `6f8794b` | ✅ Fixed |
| UNOX branding not changed to Kitchen | `6f8794b` | ✅ Fixed |

---

## 9. Recommendations

1. **Add Pricing Data**
   - Bulk-import prices or manually enter them via the admin panel.
   - Alternatively, remove the price display from the configurator until pricing is available.

2. **Fix `$accessory->code` Reference**
   - In `configurator.blade.php`, change `$accessory->code` to `$accessory->sku` (or add a `code` column to the migration).

3. **Upload Images**
   - Use the admin panel to upload product and accessory images, or seed them from the scraped JSON data in `storage/app/unox_data/`.

4. **Refactor PDF Logic**
   - Move the PDF route closure logic into the `Configurator::downloadPdf()` method and update the route to call the Livewire action directly, eliminating duplication.

5. **Security Hardening**
   - Change default admin credentials before production deployment.
   - Enable `APP_DEBUG=false` in `.env` for production.

6. **Add `.env.example`**
   - The repo lacks a committed `.env.example`, making setup harder for new developers.

---

## 10. Test Artifacts

| Artifact | Path |
|----------|------|
| PDF (empty config) | `/tmp/test.pdf` (880 KB) |
| PDF (with product) | `/tmp/test_with_data.pdf` (1,034 KB) |
| Server logs | `/tmp/laravel-server.log` |

---

**Overall Verdict**: The application is structurally sound and all major features function correctly. The most critical blocker is the **absence of pricing data**, which renders the estimate and PDF pricing sections useless. Once prices are populated and the `$accessory->code` reference is corrected, the configurator will be production-ready.