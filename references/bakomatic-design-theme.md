# Bakomatic Design Theme Reference

> **Source**: [bakomatic.com](https://bakomatic.com)
> **Analyzed**: May 2025
> **Description**: Premium industrial bakery equipment brand — dark + gold luxury, generous rounding, data-driven credibility, bilingual (EN/ID).

---

## 1. Tech Stack

| Layer | Choice |
|---|---|
| CMS | WordPress |
| Theme | Blocksy (Premium) |
| Page Builder | Elementor |
| Forms | Fluent Forms |
| SEO | Yoast SEO Premium |
| Hosting | WordPress.com / WP Engine (likely) |

---

## 2. Color Palette

### Core Tokens

| Token | Hex | OKLCH | Role |
|---|---|---|---|
| `--gold-500` | `#FFBF00` | `oklch(82.8% 0.189 84.4)` | Primary accent, CTAs, highlights |
| `--gold-600` | `#E5AD03` | — | Button hover, link default |
| `--gold-link` | `#E0A903` | — | Default link color |
| `--midnight-500` | `#080C0E` | — | Headings, dark surfaces, header/footer BG |
| `--charcoal-500` | `#515455` | — | Body text |
| `--steel-500` | `#E1E8ED` | — | Borders, dividers |
| `--ice-500` | `#F2F5F7` | — | Section backgrounds |
| `--warm-white-500` | `#FAFBFC` | — | Page background |
| `--white` | `#FFFFFF` | — | Cards, form fields |

### Full Palette Scales

#### Gold
| Shade | Hex |
|---|---|
| 50 | `#FFF8E1` |
| 100 | `#FFECB3` |
| 200 | `#FFE082` |
| 300 | `#FFD54F` |
| 400 | `#FFCA28` |
| **500** | **`#FFBF00`** |
| 600 | `#E5AD03` |
| 700 | `#C09402` |
| 800 | `#9A7A02` |
| 900 | `#735F01` |
| 950 | `#4D4101` |

#### Midnight (Near-Black)
| Shade | Hex |
|---|---|
| 50 | `#E6E7E8` |
| 100 | `#B1B3B6` |
| 200 | `#8B8E92` |
| 300 | `#565B60` |
| 400 | `#353B41` |
| **500** | **`#080C0E`** |
| 600 | `#070B0D` |
| 700 | `#06080A` |
| 800 | `#040608` |
| 900 | `#030506` |

#### Charcoal (Body Text)
| Shade | Hex |
|---|---|
| 50 | `#EEEFEF` |
| 100 | `#C9CCCC` |
| 200 | `#AFB3B4` |
| 300 | `#8A8F91` |
| 400 | `#73797B` |
| **500** | **`#515455`** |
| 600 | `#4A4C4D` |
| 700 | `#3A3C3C` |
| 800 | `#2D2E2F` |
| 900 | `#222324` |

#### Steel (Borders)
| Shade | Hex |
|---|---|
| 50 | `#F4F6F7` |
| 100 | `#F0F3F5` |
| 200 | `#ECF0F3` |
| 300 | `#DCE5EA` |
| 400 | `#C5D1D9` |
| **500** | **`#E1E8ED`** |
| 600 | `#A3B5C1` |
| 700 | `#7F93A0` |
| 800 | `#627382` |
| 900 | `#4B5A68` |

#### Ice (Section Backgrounds)
| Shade | Hex |
|---|---|
| 50 | `#F8F9FA` |
| 100 | `#F5F7F8` |
| 200 | `#F3F5F7` |
| 300 | `#EEF2F4` |
| 400 | `#E8EDF0` |
| **500** | **`#F2F5F7`** |
| 600 | `#C4CDD3` |
| 700 | `#96A3AB` |
| 800 | `#6E7C84` |
| 900 | `#546068` |

#### Warm White (Page Background)
| Shade | Hex |
|---|---|
| 50 | `#FFFFFF` |
| 100 | `#FEFEFE` |
| 200 | `#FEFEFE` |
| 300 | `#FDFCFB` |
| 400 | `#FCFBF9` |
| **500** | **`#FAFBFC`** |
| 600 | `#C8C9CA` |
| 700 | `#969797` |
| 800 | `#646565` |
| 900 | `#323333` |

---

## 3. Typography

### Font Stack

| Role | Font Family | Weight | Source |
|---|---|---|---|
| **Headings H1–H6** | **Funnel Display** | 700 (Bold) | [Google Fonts](https://fonts.google.com/specimen/Funnel+Display) |
| **Body, UI** | **Instrument Sans** | 400, 500, 600 | [Google Fonts](https://fonts.google.com/specimen/Instrument+Sans) |
| Code | Monospace system stack | 400 | System |

### Type Scale

| Element | Size | Line Height | Notes |
|---|---|---|---|
| **H1** | `40px` (2.5rem) | 1.5 | Hero: can go up to 70px on blog singles |
| **H2** | `35px` (2.1875rem) | 1.5 | |
| **H3** | `30px` (1.875rem) | 1.5 | |
| **H4** | `25px` (1.5625rem) | 1.5 | |
| **H5** | `20px` (1.25rem) | 1.5 | |
| **H6** | `16px` (1rem) | 1.5 | |
| **Body** | `17px` (1.0625rem) | 1.65 | |
| **Button** | `16px` (1rem) | — | Weight: 500 |
| **Small / Meta** | `12px` (0.75rem) | 1.3 | Uppercase, weight 600 |

### Font Loading

```html
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=funnel-display:400,500,600,700,800|instrument-sans:400,500,600,700" rel="stylesheet" />
```

---

## 4. Spacing & Layout

| Token | Value | Usage |
|---|---|---|
| `--theme-content-vertical-spacing` | `60px` (3.75rem) | Section padding (`py-16 lg:py-24`) |
| `--theme-container-edge-spacing` | `90vw` | Narrow container |
| `--theme-normal-container-max-width` | `1290px` (80.625rem) | Content width |
| `--theme-narrow-container-max-width` | `750px` | Narrow content |
| `--theme-wide-offset` | `130px` | Wide alignment offset |
| `--header-height` | `105px` | Desktop header |
| `--header-sticky-height` | `75px` | Sticky header height |

### Grid Systems

- **Blog archive**: 3 columns
- **Footer**: 4 columns → 2 col tablet → 1 col mobile
- **Product cards**: 3 columns → 2 col → 1 col
- **Stat counters**: 4 columns → 2 col → 2 col

---

## 5. Border Radius

| Token | Value | Usage |
|---|---|---|
| `--radius-card` | `30px` (1.875rem) | Cards, images, media containers, offcanvas panel |
| `--radius-button` / `--radius-pill` | `100px` (6.25rem) | Buttons, menu item hover, filter chips, pagination |
| `--radius-form` | `30px` (1.875rem) | Form fields, text inputs |

**Rule**: Everything is either `30px` (cards/forms) or `100px` (buttons/chips). No in-between. No sharp corners.

---

## 6. UI Components

### Buttons

#### Primary (Dark → Gold hover)
```
Background: #080C0E (midnight-500)
Text: #FFFFFF
Hover Background: #E5AD03 (gold-600)
Border: none
Radius: 100px
Padding: 15px 30px
Min Height: 40px
Font: 16px, 500 weight
```

#### CTA (Gold)
```
Background: #FFBF00 (gold-500)
Text: #080C0E (midnight-500)
Hover Background: #E5AD03 (gold-600)
Shadow: 0 shadow-gold-500/25
```

#### Outline (on dark)
```
Background: transparent
Border: 2px solid rgba(255,255,255,0.2)
Text: #FFFFFF
Hover Border: #FFBF00
Hover Text: #FFBF00
```

### Form Fields

```
Height: 55px
Border Radius: 30px
Border: 2px solid #E1E8ED (steel-500)
Focus Border: #FFBF00 (gold-500)
Focus Ring: 2px solid gold-500/20
Background: #FFFFFF
Padding: 0 1.25rem
Font: 16px
Placeholder Color: charcoal-300
```

### Cards

```
Background: #FFFFFF
Border Radius: 30px
Border: 1px solid steel-500 (sometimes steel-500/30 or steel-500/50)
Padding: 1.5rem–2rem
Hover: translateY(-2px), larger shadow
Shadow (hover): 0 20px 25px -5px rgba(0,0,0,0.1)
```

### Glass Panel (Offcanvas)

```
Background: rgba(7, 11, 13, 0.8) — glassmorphism
Backdrop Filter: blur(12px)
Border Radius: 30px
Panel Width: 500px
Panel Offset: 30px
Box Shadow: 0 0 70px rgba(0,0,0,0.35)
```

### Header

```
Type: Sticky, Type-1
Height: 75px (sticky) / 105px (default)
Background: #080C0E (midnight-500), 95% opacity + backdrop-blur
Transparent State: #121B1F
Border Bottom: 1px solid rgba(255,255,255,0.05)
Menu Items Spacing: 45px
Menu Items Gap: 5px
Menu Items Font: 17px, 500 weight, capitalize
Menu Items Radius: 100px (on hover)
Dropdown: #FFFFFF background, 30px border-radius, 0 10px 20px rgba(41,51,61,0.1) shadow
```

### Newsletter Block

```
Background: #FFFFFF
Border Radius: 30px
Box Shadow: 0 50px 90px rgba(210, 213, 218, 0.4)
Button: gold-500 → gold-600 hover
```

### Filter Chips (Blog)

```
Border Radius: 100px
Padding: 0.5rem 1.25rem
Font: 12px, 600 weight, uppercase
Default: steel-500 background, midnight-500 text
Active/Hover: midnight-500 background, #FFFFFF text
```

---

## 7. Links

| State | Color | Behavior |
|---|---|---|
| Default | `#E0A903` | Standard |
| Hover | `#FFBF00` | Warmer, brighter |
| Active | — | — |

Links are typically underlined (or underline-on-hover). On dark backgrounds, white/70 with white hover.

---

## 8. Selection

```
Background: #676767
Text: #FFFFFF
```

---

## 9. Blog & Content

| Setting | Value |
|---|---|
| Grid Columns | 3 (repeat) |
| Card Title | 20px, line-height 1.3 |
| Card Meta | 12px, 600 weight, uppercase |
| Card Image Radius | 30px |
| Card Element Spacing | 30px |
| Single Post Title | 70px, line-height 1.2, white on dark overlay |
| Related Posts Grid | 3 columns |
| Related Post Title | 16px |
| Pagination Radius | 100px |
| Filter Type | Buttons, left-aligned |

---

## 10. Responsive Behavior

| Breakpoint | Behavior |
|---|---|
| Mobile (< 640px) | Single column, offcanvas menu, stacked footer |
| Tablet (640–1024px) | 2-column grids |
| Desktop (> 1024px) | Full 3–4 column layouts, visible nav |

Offcanvas panel: 500px width, 30px offset from edges, 30px border-radius.

---

## 11. Iconography

- **Icons**: SVG-based (likely Elementor or Blocksy icon library)
- **Style**: Outline, 1.5–2px stroke
- **Color**: Inherits from context — gold on dark, charcoal on light, white/60 in footer
- **Sizing**: 16px (UI), 20–24px (feature), 28px (hero badges)

---

## 12. Animations & Motion

| Element | Effect |
|---|---|
| Header Sticky | 0.2s animation, 30px offset trigger |
| Buttons | 0.2–0.3s color/bg transition |
| Cards | 0.3s translateY + shadow on hover |
| Links | 0.2s color transition |
| Offcanvas | Slide-in from right |
| Page Load | Blocksy fade-in (likely) |
| Stats Counters | Animated count-up (Elementor counter widget, 2000ms duration) |

---

## 13. Design Philosophy

### Dark + Gold Luxury
The `#080C0E`/`#FFBF00` pairing evokes premium industrial equipment brands. Dark surfaces dominate (header, footer, hero, CTA banners), punctuated by warm gold accents. This is **not** a cheerful bakery aesthetic — it's precision engineering for professionals.

### Generous Rounding
Nothing is sharp. `30px` is the default radius for cards, forms, images, panels. `100px` pill shapes for buttons and chips. This softens the industrial feel into something approachable and modern.

### Bilingual Narrative
English headlines + Indonesian body copy targets the Indonesian professional market. Headlines are punchy and aspirational ("Mastering Every Bake", "Global Expertise in Every Detail").

### Data-Driven Credibility
Numbers appear prominently — capacity specs, accuracy percentages, production counts. The site uses animated counters to make technical specs feel dynamic rather than dry.

### Minimalist Content Density
Large hero images, generous whitespace (60px section padding), no clutter. Each product card focuses on a single value proposition. The layout breathes.

### Long-Term Investment Framing
Copy emphasizes durability, consistency, and ROI — "every oven is a long-term investment for your business."

---

## 14. CSS Custom Properties (Full List)

```css
:root {
    /* Palette */
    --theme-palette-color-1: #FFBF00;
    --theme-palette-color-2: #E5AD03;
    --theme-palette-color-3: #515455;
    --theme-palette-color-4: #080C0E;
    --theme-palette-color-5: #E1E8ED;
    --theme-palette-color-6: #F2F5F7;
    --theme-palette-color-7: #FAFBFC;
    --theme-palette-color-8: #FFFFFF;
    --theme-palette-color-9: #E0E0E0;

    /* Typography */
    --theme-font-family: system default stack;
    --theme-font-weight: 400;
    --theme-font-size: 17px;
    --theme-line-height: 1.65;
    --theme-headings-color: #080C0E;
    --theme-text-color: #515455;

    /* Buttons */
    --theme-button-font-weight: 500;
    --theme-button-font-size: 16px;
    --theme-button-min-height: 40px;
    --theme-button-border-radius: 100px;
    --theme-button-padding: 15px 30px;
    --theme-button-text-initial-color: #FFFFFF;
    --theme-button-text-hover-color: #FFFFFF;
    --theme-button-background-initial-color: #080C0E;
    --theme-button-background-hover-color: #E5AD03;
    --theme-button-shadow: none;

    /* Forms */
    --theme-form-field-height: 55px;
    --theme-form-field-border-radius: 30px;
    --theme-form-field-border-initial-color: #E1E8ED;
    --theme-form-field-border-focus-color: #FFBF00;
    --theme-form-field-border-width: 2px;

    /* Links */
    --theme-link-initial-color: #E0A903;
    --theme-link-hover-color: #FFBF00;

    /* Selection */
    --theme-selection-text-color: #FFFFFF;
    --theme-selection-background-color: #676767;

    /* Layout */
    --theme-normal-container-max-width: 1290px;
    --theme-content-vertical-spacing: 60px;
    --theme-container-edge-spacing: 90vw;

    /* Borders */
    --theme-border-color: #E1E8ED;
    --theme-border-radius: 30px;
}
```

---

## 15. Quick Reference Card

```
┌─────────────────────────────────────────────────────────┐
│  BAKOMATIC DESIGN SYSTEM                                │
├─────────────────────────────────────────────────────────┤
│  Primary:      #FFBF00 (Gold)                           │
│  Dark:         #080C0E (Near-Black)                     │
│  Text:         #515455 (Charcoal)                       │
│  BG:           #FAFBFC (Warm White)                     │
│  Border:       #E1E8ED (Steel)                          │
│  Section BG:   #F2F5F7 (Ice)                            │
├─────────────────────────────────────────────────────────┤
│  Headings:     Funnel Display, 700, H1:40px→H6:16px    │
│  Body:         Instrument Sans, 400, 17px, LH 1.65     │
├─────────────────────────────────────────────────────────┤
│  Card Radius:  30px                                     │
│  Button Radius: 100px (pill)                            │
│  Form Radius:  30px, 55px height                        │
├─────────────────────────────────────────────────────────┤
│  Buttons:      Dark BG → Gold hover                     │
│  CTA:          Gold BG → Darker gold hover              │
│  Links:        #E0A903 → #FFBF00 hover                  │
│  Selection:    #676767 bg, white text                   │
└─────────────────────────────────────────────────────────┘
```

---

*Generated from scraping bakomatic.com, analyzing Blocksy CSS custom properties, and inspecting the live WordPress + Elementor implementation.*