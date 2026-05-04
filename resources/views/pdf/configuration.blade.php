@php
function resolveImageUrl($url) {
    if (empty($url)) {
        return null;
    }
    if (str_starts_with($url, '/unox/') || str_starts_with($url, '/')) {
        return 'https://unox.com' . $url;
    }
    return $url;
}
function renderImage($url, $class, $alt = '') {
    $resolved = resolveImageUrl($url);
    if ($resolved) {
        echo '<img src="' . $resolved . '" class="' . $class . '" alt="' . $alt . '">';
    } else {
        echo '<div class="' . $class . ' placeholder-image"><span>' . ($alt ?: 'No Image') . '</span></div>';
    }
}
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your configuration - Kitchen</title>
    <style>
        @page {
            margin: 15mm 20mm;
        }
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10pt;
            color: #1a1a1a;
            line-height: 1.4;
        }
        .page {
            padding: 10mm 5mm;
            position: relative;
            page-break-after: always;
        }
        .page:last-child {
            page-break-after: auto;
        }
        .header {
            border-bottom: 2px solid #0073e1;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18pt;
            color: #0073e1;
            margin: 0;
            font-weight: bold;
        }
        .header .sub {
            font-size: 9pt;
            color: #666;
            margin-top: 4px;
        }
        .cover-title {
            font-size: 28pt;
            color: #0073e1;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .cover-line {
            font-size: 16pt;
            color: #333;
            margin-bottom: 20px;
        }
        .cover-meta {
            font-size: 9pt;
            color: #666;
            margin-bottom: 30px;
        }
        .disclaimer-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 12px;
            font-size: 8pt;
            color: #666;
            margin-bottom: 20px;
        }
        .disclaimer-box strong {
            color: #333;
        }
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            color: #0073e1;
            margin: 25px 0 15px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e5e7eb;
        }
        .product-card {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .product-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 12px;
        }
        .product-image {
            width: 180px;
            height: 135px;
            object-fit: contain;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
        }
        .placeholder-image {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f3f4f6;
            color: #9ca3af;
            font-size: 10pt;
            text-align: center;
        }
        .placeholder-image span {
            display: block;
        }
        .product-info h2 {
            font-size: 13pt;
            color: #0073e1;
            margin: 0 0 4px;
        }
        .product-info .code {
            font-size: 9pt;
            color: #666;
            margin-bottom: 8px;
        }
        .product-info .description {
            font-size: 9pt;
            color: #444;
            line-height: 1.4;
        }
        .specs-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-top: 10px;
        }
        .specs-table th,
        .specs-table td {
            padding: 5px 8px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .specs-table th {
            background: #f3f4f6;
            font-weight: bold;
            color: #444;
            width: 35%;
        }
        .specs-table td {
            color: #333;
        }
        .accessory-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
            page-break-inside: avoid;
        }
        .accessory-image {
            width: 80px;
            height: 60px;
            object-fit: contain;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            flex-shrink: 0;
        }
        .accessory-info h3 {
            font-size: 10pt;
            color: #333;
            margin: 0 0 3px;
        }
        .accessory-info .code {
            font-size: 8pt;
            color: #666;
        }
        .accessory-info .qty {
            font-size: 9pt;
            color: #0073e1;
            font-weight: bold;
            margin-top: 4px;
        }
        .accessory-info .description {
            font-size: 8pt;
            color: #666;
            margin-top: 3px;
        }
        .accessory-info .specs {
            font-size: 8pt;
            color: #888;
            margin-top: 3px;
        }
        .footer {
            position: fixed;
            bottom: 15mm;
            left: 25mm;
            right: 25mm;
            font-size: 8pt;
            color: #888;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            display: flex;
            justify-content: space-between;
        }
        .promo-box {
            background: #f0f7ff;
            border: 1px solid #0073e1;
            padding: 15px;
            margin-top: 30px;
        }
        .promo-box h3 {
            font-size: 11pt;
            color: #0073e1;
            margin: 0 0 8px;
        }
        .promo-box p {
            font-size: 9pt;
            color: #444;
            margin: 0;
        }
        .energy-badge {
            display: inline-block;
            background: #ecfdf5;
            color: #059669;
            font-size: 8pt;
            padding: 2px 8px;
            border-radius: 4px;
            margin-top: 6px;
        }
        .total-box {
            background: #0073e1;
            color: white;
            padding: 15px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-box .label {
            font-size: 11pt;
        }
        .total-box .amount {
            font-size: 16pt;
            font-weight: bold;
        }
    </style>
</head>
<body>

    {{-- Cover Page --}}
    <div class="page">
        <div class="cover-title">Your configuration</div>
        @if($selectedProducts->isNotEmpty())
            <div class="cover-line">
                Your {{ strip_tags($selectedProducts->first()->line ?? $selectedProducts->first()->name) }}
            </div>
        @endif

        <div class="cover-meta">
            Document creation date: {{ now()->format('d.m.Y') }}<br>
            {{ $selectedProducts->count() + $selectedColumnAccessoriesList->count() + $selectedOtherAccessoriesList->count() }} Products
        </div>

        <div class="disclaimer-box">
            <strong>Note</strong><br>
            *Images and photographs in the configurator may not reflect the actual appearance of the finished product. The factory reserves the right to make changes to product prices, colors, materials, construction and equipment without prior notice. To find out the exact specifications of each item you can contact Kitchen Customer Service.<br><br>
            This document is provided for informational purposes only and does not constitute a final order confirmation. The generated document is subject to review and confirmation by the Kitchen back office team. Kindly contact the back office responsible for your reference market or your sales representative in order to proceed with the order.
        </div>

        <div class="promo-box">
            <h3>Individual Cooking Experience</h3>
            <p>Go beyond the classic demo and try the oven for yourself. It's free! One of our experienced Kitchen Active Marketing Chefs will be by your side to answer your questions and help you make the right choice for your business. Book your Individual Cooking Experience now!</p>
        </div>

        <div style="margin-top: 40px; font-size: 8pt; color: #888;">
            <strong>Kitchen S.p.a.</strong><br>
            Make a sustainable choice: do not print this document unless it is necessary.<br>
            For further info please visit www.unox.com or email info@unox.com.
        </div>
    </div>

    {{-- Oven Pages --}}
    @foreach($selectedProducts as $product)
    <div class="page">
        <div class="header">
            <h1>Your configuration</h1>
            <div class="sub">Ovens</div>
        </div>

        <div class="product-card">
            <div class="product-header">
                @php renderImage($product->configurator_image ?? $product->list_image, 'product-image') @endphp
                <div class="product-info">
                    <h2>{!! $product->name !!}</h2>
                    <div class="code">Code: {{ $product->sku }}</div>
                    <div class="description">{{ strip_tags($product->description) }}</div>
                    @if($product->energy_star_certified)
                        <div class="energy-badge">ENERGY STAR Certified</div>
                    @endif
                </div>
            </div>

            <table class="specs-table">
                @if($product->type)
                <tr>
                    <th>Type</th>
                    <td>{{ $product->type }}</td>
                </tr>
                @endif
                @if($product->number_of_trays || $product->tray_size)
                <tr>
                    <th>Trays</th>
                    <td>{{ $product->number_of_trays }} trays {{ $product->tray_size }}</td>
                </tr>
                @endif
                @if($product->panel || $product->control_type)
                <tr>
                    <th>Panel</th>
                    <td>{{ $product->control_type ? ucfirst($product->control_type) : $product->panel }}</td>
                </tr>
                @endif
                @if($product->power_supply)
                <tr>
                    <th>Power supply</th>
                    <td>{{ ucfirst($product->power_supply) }}</td>
                </tr>
                @endif
                @if($product->width || $product->depth || $product->height)
                <tr>
                    <th>Dimensions</th>
                    <td>
                        @if($product->width) Width {{ $product->width }} mm @endif
                        @if($product->depth)<br>Depth {{ $product->depth }} mm @endif
                        @if($product->height)<br>Height {{ $product->height }} mm @endif
                    </td>
                </tr>
                @endif
                @if($product->weight)
                <tr>
                    <th>Weight</th>
                    <td>{{ $product->weight }} kg</td>
                </tr>
                @endif
                @if($product->number_of_trays)
                <tr>
                    <th>Number of trays</th>
                    <td>{{ $product->number_of_trays }}</td>
                </tr>
                @endif
                @if($product->tray_size)
                <tr>
                    <th>Tray size</th>
                    <td>{{ $product->tray_size }}</td>
                </tr>
                @endif
                @if($product->distance_between_trays)
                <tr>
                    <th>Distance between trays</th>
                    <td>{{ $product->distance_between_trays }}</td>
                </tr>
                @endif
                @if($product->voltage)
                <tr>
                    <th>Voltage</th>
                    <td>{{ $product->voltage }}</td>
                </tr>
                @endif
                @if($product->electric_power)
                <tr>
                    <th>Electric power</th>
                    <td>{{ $product->electric_power }} kW</td>
                </tr>
                @endif
                @if($product->frequency)
                <tr>
                    <th>Frequency</th>
                    <td>{{ $product->frequency }}</td>
                </tr>
                @endif
                @if($product->consumption_kwh || $product->co2_emission)
                <tr>
                    <th>Consumption in kWh and CO2 emissions</th>
                    <td>
                        @if($product->consumption_kwh) {{ $product->consumption_kwh }} kWh/day @endif
                        @if($product->co2_emission)<br>{{ $product->co2_emission }} Kg CO2/day @endif
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>
    @endforeach

    {{-- Column Accessories --}}
    @if($selectedColumnAccessoriesList->isNotEmpty())
    <div class="page">
        <div class="header">
            <h1>Your configuration</h1>
            <div class="sub">Column accessories</div>
        </div>

        @foreach($selectedColumnAccessoriesList as $accessory)
        <div class="accessory-item">
            @php renderImage($accessory->configurator_image ?? $accessory->list_image, 'accessory-image') @endphp
            <div class="accessory-info">
                <h3>{{ $accessory->commercial_name ?? $accessory->name }}</h3>
                <div class="code">Code: {{ $accessory->sku }}</div>
                <div class="qty">Quantity: {{ $accessory->selected_quantity }}</div>
                @if($accessory->description)
                <div class="description">{{ strip_tags($accessory->description) }}</div>
                @endif
                <div class="specs">
                    @if($accessory->width) Width {{ $accessory->width }} mm @endif
                    @if($accessory->depth) Depth {{ $accessory->depth }} mm @endif
                    @if($accessory->height) Height {{ $accessory->height }} mm @endif
                    @if($accessory->weight) Weight {{ $accessory->weight }} kg @endif
                    @if($accessory->electric_power) Electric power {{ $accessory->electric_power }} kW @endif
                    @if($accessory->voltage) Voltage {{ $accessory->voltage }} V @endif
                    @if($accessory->min_flow) Min flow {{ $accessory->min_flow }} @endif
                    @if($accessory->max_flow) Max flow {{ $accessory->max_flow }} @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Other Accessories --}}
    @if($selectedOtherAccessoriesList->isNotEmpty())
    <div class="page">
        <div class="header">
            <h1>Your configuration</h1>
            <div class="sub">Other accessories</div>
        </div>

        @foreach($selectedOtherAccessoriesList as $accessory)
        <div class="accessory-item">
            @php renderImage($accessory->configurator_image ?? $accessory->list_image, 'accessory-image') @endphp
            <div class="accessory-info">
                <h3>{{ $accessory->commercial_name ?? $accessory->name }}</h3>
                <div class="code">Code: {{ $accessory->sku }}</div>
                <div class="qty">Quantity: {{ $accessory->selected_quantity }}</div>
                @if($accessory->description)
                <div class="description">{{ strip_tags($accessory->description) }}</div>
                @endif
                <div class="specs">
                    @if($accessory->width) Width {{ $accessory->width }} mm @endif
                    @if($accessory->depth) Depth {{ $accessory->depth }} mm @endif
                    @if($accessory->height) Height {{ $accessory->height }} mm @endif
                    @if($accessory->weight) Weight {{ $accessory->weight }} kg @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Summary Page --}}
    <div class="page">
        <div class="header">
            <h1>Your configuration</h1>
            <div class="sub">Summary</div>
        </div>

        <table class="specs-table">
            <tr>
                <th>Selected ovens</th>
                <td>{{ $selectedProducts->count() }}</td>
            </tr>
            <tr>
                <th>Column accessories</th>
                <td>{{ $selectedColumnAccessoriesList->count() }}</td>
            </tr>
            <tr>
                <th>Other accessories</th>
                <td>{{ $selectedOtherAccessoriesList->count() }}</td>
            </tr>
            <tr>
                <th>Total items</th>
                <td>{{ $selectedProducts->count() + $selectedColumnAccessoriesList->count() + $selectedOtherAccessoriesList->count() }}</td>
            </tr>
        </table>

        @if($totalPrice !== null)
        <div class="total-box">
            <span class="label">Total Estimate</span>
            <span class="amount">${{ number_format($totalPrice, 2) }}</span>
        </div>
        @endif

        <div class="disclaimer-box" style="margin-top: 25px;">
            <strong>Important</strong><br>
            Prices are estimates and may vary. This document is provided for informational purposes only and does not constitute a final order confirmation. Contact Kitchen Customer Service or your sales representative for a formal quote.
        </div>

        <div style="margin-top: 40px; font-size: 8pt; color: #888; text-align: center;">
            <strong>Kitchen S.p.a.</strong><br>
            Make a sustainable choice: do not print this document unless it is necessary.<br>
            For further info please visit www.unox.com or email info@unox.com.<br>
            {{ now()->format('d.m.Y') }}
        </div>
    </div>

</body>
</html>
