# Kitchen Configurator — Feature Gap & Blackbox Test Report

**Date**: 2025-05-03  
**Repo**: `https://github.com/danangprass/kitchen-laravel-configurator`  
**Tech Stack**: Laravel 13, Filament v5, Livewire v4, Tailwind CSS, SQLite, DOMPDF

---

## 1. Executive Summary

The Laravel app successfully replicates UNOX's core **5-step configurator** with category browsing, product selection, accessory filtering, PDF export, and an admin panel. However, significant gaps remain when compared to the real `unox.com` experience — most notably the **Product Comparator**, **Consumption Calculator**, **Dealer Locator**, and **advanced product filtering**. Additionally, blackbox testing uncovered critical data-quality issues: **100% of products and accessories have NULL prices**, rendering the estimate feature useless.

---

## 2. Current App Features (Verified Working)

| Feature | Status | Notes |
|---------|--------|-------|
| 5-step configurator wizard | ✅ | Choose oven/s → Arrangement → Column accessories → Other accessories → Summary |
| Category / subcategory browsing | ✅ | Hierarchical navigation with correct product counts |
| Product multi-select | ✅ | Toggle selection with visual state |
| Accessory compatibility filtering | ✅ | Real-time filtering based on selected ovens |
| PDF export | ✅ | Generates valid PDF with configuration details |
| Admin Panel (Filament) | ✅ | CRUD for categories, products, accessories, images |
| Authentication | ✅ | Login required for admin panel |
| Back buttons (recently fixed) | ✅ | Step navigation works correctly |
| Slate theme | ✅ | Frontend and admin panel both use slate |

---

## 3. Bugs Found During Blackbox Testing

All bugs have been converted to GitHub Issues:  
`https://github.com/danangprass/kitchen-laravel-configurator/issues`

| # | Issue | Severity | Status |
|---|-------|----------|--------|
| #1 | All 287 products & 444 accessories have NULL `price` | 🔴 Critical | Open |
| #2 | Blade references non-existent `code` column (should be `sku`) | 🟡 Medium | Open |
| #3 | No product / accessory images uploaded | 🟡 Medium | Open |
| #4 | `downloadPdf()` is dead code in Livewire component | 🟢 Low | Open |
| #5 | PDF route duplicates price-calculation logic | 🟢 Low | Open |
| #6 | Missing `.env.example` in repository | 🟢 Low | Open |
| #7 | Default admin credentials exposed in README | 🟢 Low | Open |

### 3.1 Critical Data Issue — NULL Prices

- **Impact**: `getTotalPriceProperty()` always returns `null`, so the Step 5 "Total Estimate" block always shows `$0.00`.
- **Root Cause**: The scraped data source (`unox.com`) does not expose pricing on the public website.
- **Fix Options**:
  1. Bulk-import prices from a price-list CSV
  2. Manually enter prices via the admin panel
  3. Temporarily hide the price display until data is available

### 3.2 Missing Images

- `product_images` table: **0 rows**
- `accessory_images` table: **0 rows**
- Product cards and PDF export show no visuals. Images exist in `storage/app/unox_data/` as scraped JSON but were never seeded into the database.

### 3.3 Code Quality Issues

- `$accessory->code` in the configurator blade references a non-existent column. The table has `sku`.
- The `/configurator/pdf` route closure duplicates the price-calculation logic already present in the Livewire component.
- The `Configurator::downloadPdf()` method is never invoked (the route uses its own closure).

---

## 4. unox.com Feature Comparison

### 4.1 Features EXISTING on unox.com but MISSING from the Laravel App

#### 🔴 High Priority

| Feature | unox.com URL | Description | Laravel Status |
|---------|-------------|-------------|----------------|
| **Product Comparator** | `/comparator/` | Side-by-side comparison of up to 3 ovens with "Show only differences" toggle across specs, energy, dimensions, certifications | ❌ Missing |
| **Consumption & Emissions Calculator** | `/consumption-calculator/` | 4-step wizard calculating kWh/day and CO₂ kg/day based on oven + usage assumptions | ❌ Missing |
| **Advanced Product Filtering** | `/ovens/` | Filters by industry, ENERGY STAR®, tray types (GN 1/1, GN 2/1, 600x400), power supply, number of trays, versions, door opening, product lines | ❌ Missing |

#### 🟡 Medium Priority

| Feature | unox.com URL | Description | Laravel Status |
|---------|-------------|-------------|----------------|
| **Dealer Locator** | `/company/service-locator/?find=dealer` | Map-based finder with filters (type, service level, UNOX location type) | ❌ Missing |
| **Service Locator** | `/company/service-locator/?find=service` | Same infrastructure as Dealer Locator for service centers | ❌ Missing |
| **Individual Cooking Experience (ICE)** | `/individual-cooking-experience/` | Lead-gen form to book a **free on-site oven trial** at the customer's venue | ❌ Missing |
| **Video Content** | Line pages (e.g. `/lines/cheftop-x/`) | "WATCH THE VIDEO" CTAs with embedded product videos | ❌ Missing |
| **Contact / Inquiry Forms** | Multiple | Sales, Service, Cooking Support forms routing to different emails | ❌ Missing |
| **Site-wide Search** | Header | Search with suggestions across products, accessories, lines, support | ❌ Missing |
| **Energy Badges on Product Cards** | `/ovens/` | Every card shows kWh/day and CO₂ kg/day | ❌ Missing |

#### 🟢 Low Priority / Content

| Feature | unox.com URL | Description | Laravel Status |
|---------|-------------|-------------|----------------|
| **Testimonials / Case Studies** | `/testimonials/` | Customer success stories and chef profiles | ❌ Missing |
| **Blog / News** | `/unox-blog/` | External blog with articles | ❌ Missing |
| **FAQ Page** | `/faq/` | Dedicated FAQ section | ❌ Missing |
| **Newsletter Subscription** | Footer | GDPR-compliant newsletter signup | ❌ Missing |
| **Cookie / GDPR Banner** | Global | Explicit cookie consent with privacy policy links | ❌ Missing |
| **Global Country/Language Selector** | Header | Multi-region, multi-language (20+ languages, 70+ countries) | ❌ Missing |

### 4.2 External Integrations / Ecosystem (unox.com only)

| Feature | Description | Laravel Status |
|---------|-------------|----------------|
| **Data Driven Cooking (DDC)** | External SaaS portal (`ddc.unox.com`) for oven data analytics and remote monitoring | ❌ Missing |
| **Partner Hub / Service Area** | External B2B portal (`partnerhub.unox.com`) for technicians and dealers | ❌ Missing |
| **Warranty Registration Portal** | LONG.Life warranty extension with serial code validation and invoice upload | ❌ Missing |
| **Digital.ID App** | Mobile app for oven control and recipe management | ❌ Missing |

### 4.3 Features the Laravel App Has That unox.com Might Not Explicitly Match

| Laravel Feature | Note |
|-----------------|------|
| **PDF Export of Configurations** | Not advertised as a standalone public feature on the consumer site. The configurator exists but PDF export capability is not highlighted. This could be a **unique value-add**. |
| **Filament Admin Panel** | UNOX likely has a custom CMS; your Filament CRUD is an internal advantage with relation managers, bulk actions, and fine-grained access. |

---

## 5. Recommendations by Priority

### Phase 1 — Fix Critical Blockers (Before any public use)

| # | Task | Effort |
|---|------|--------|
| 1 | **Populate pricing data** for all 287 products and 444 accessories | Medium |
| 2 | **Fix `$accessory->code` → `$accessory->sku`** in the configurator blade | Very Low |
| 3 | **Seed product & accessory images** from scraped JSON or admin uploads | Medium |
| 4 | **Hide the price display** from Step 5 / PDF if pricing is not yet available | Very Low |

### Phase 2 — High-Value Feature Parity (1–2 weeks)

| # | Task | Effort |
|---|------|--------|
| 5 | **Product Comparator** — allow selecting up to 3 products and compare specs side-by-side with "Show only differences" | High |
| 6 | **Consumption Calculator** — 4-step wizard for kWh/day and CO₂ emissions | High |
| 7 | **Advanced Product Filters** — tray type, power supply, ENERGY STAR®, number of trays, line family, door opening | Medium |
| 8 | **Energy Badges on Product Cards** — display kWh/day and CO₂ on every product card | Low |

### Phase 3 — Engagement & Support Features (2–3 weeks)

| # | Task | Effort |
|---|------|--------|
| 9 | **Dealer / Service Locator** — map-based finder with Google Maps or Leaflet | Medium |
| 10 | **Individual Cooking Experience Booking Form** — lead capture for free oven trial | Low |
| 11 | **Video Content** — embed product line videos on detail pages | Low |
| 12 | **Contact Forms** — Sales, Service, Cooking Support with email routing | Low |
| 13 | **Site-wide Search** — simple search across products, accessories, and categories | Medium |

### Phase 4 — Polish & Compliance (Ongoing)

| # | Task | Effort |
|---|------|--------|
| 14 | **Testimonials / Case Studies** — Filament-managed with customer quotes and photos | Low |
| 15 | **FAQ Page** — simple FAQ CRUD in Filament + frontend page | Low |
| 16 | **Newsletter / GDPR Banner** — cookie consent and newsletter signup | Low |
| 17 | **Refactor PDF logic** — eliminate duplication between route and Livewire component | Low |

---

## 6. Page Mapping

| unox.com Page | Laravel Route | Status |
|---------------|-------------|--------|
| `/configurator/` | `/configurator` | ✅ Exists |
| `/comparator/` | `/compare` | ❌ Missing |
| `/consumption-calculator/` | `/calculator` | ❌ Missing |
| `/company/service-locator/` | `/dealers` | ❌ Missing |
| `/individual-cooking-experience/` | `/book-trial` | ❌ Missing |
| `/testimonials/` | `/testimonials` | ❌ Missing |
| `/faq/` | `/faq` | ❌ Missing |
| `/ovens/` (product listing) | `/products` | ⚠️ Partial — needs filters |
| `/lines/cheftop-x/` (line detail) | `/lines/{slug}` | ⚠️ Partial — needs video, energy data |
| `/unox-blog/` | `/blog` | ❌ Missing |

---

## 7. Overall Verdict

**Strengths**: The Laravel app is architecturally solid. The configurator flow, admin panel, and PDF export are production-grade. Filament provides excellent CRUD ergonomics.

**Blockers**: The absence of pricing data makes the estimate and PDF pricing sections non-functional. The `code` vs `sku` mismatch and missing images degrade the user experience.

**Gaps vs. unox.com**: The biggest missing features are the **Product Comparator**, **Consumption Calculator**, and **Dealer Locator**. Adding these would bring the app close to parity with the real UNOX experience.

**GitHub Issues**: All 7 bugs and improvements have been filed at `https://github.com/danangprass/kitchen-laravel-configurator/issues`.

---