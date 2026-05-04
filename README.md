# Kitchen Configurator

A multi-step product configurator built with Laravel 13, Livewire 4, and Filament 5. Guides users through selecting kitchen equipment, arranging configurations, choosing accessories, and exporting a professional PDF summary.

## Tech Stack

| Technology | Version |
|---|---|
| PHP | 8.3+ |
| Laravel | 13.x |
| Filament | v5 |
| Livewire | v4 |
| Tailwind CSS | v4 (CDN) |
| SQLite | — |
| DOMPDF | barryvdh/laravel-dompdf |

## Features

### Frontend Configurator (`/configurator`)
- **5-step wizard**: Choose equipment → Arrangement → Column accessories → Other accessories → Summary
- Category and subcategory browsing with product counts
- Multi-select products with quantity controls
- Real-time accessory filtering based on product compatibility
- Price estimate calculation
- PDF export with cover page, specs tables, and totals

### Admin Panel (`/admin`)
- Full CRUD for categories, products, accessories, and images
- Hierarchical category management
- Product-image relation managers
- Authentication and access control

## Prerequisites

- PHP 8.3 or higher
- Composer
- SQLite PHP extension enabled

## Installation

1. Clone the repository:
   ````bash
   git clone git@github.com:danangprass/kitchen-laravel-configurator.git
   cd kitchen-laravel-configurator
   ````

2. Install PHP dependencies:
   ````bash
   composer install
   ````

3. Copy the environment file:
   ````bash
   cp .env.example .env
   ````

4. Generate the application key:
   ````bash
   php artisan key:generate
   ````

5. Run database migrations and seeders:
   ````bash
   php artisan migrate --seed
   ````

6. Start the development server:
   ````bash
   php artisan serve
   ````

7. Open your browser and navigate to:
   - Configurator: `http://localhost/configurator`
   - Admin Panel: `http://localhost/admin`

## Default Admin Credentials

- **Email**: `admin@unox.com`
- **Password**: `password`

> Change these credentials before deploying to production.

## License

This project is open-sourced software licensed under the MIT license.