<?php

use App\Livewire\Configurator;
use App\Livewire\HomePage;
use App\Models\Accessory;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

Route::get('/configurator', Configurator::class)->name('configurator');

Route::get('/configurator/pdf', function (Request $request) {
    $productIds = $request->query('products', []);
    $columnData = $request->query('column', []);
    $otherData = $request->query('other', []);

    $selectedProducts = Product::whereIn('id', $productIds)
        ->orderBy('sort_order')
        ->get();

    $selectedColumnAccessoriesList = collect();
    foreach ($columnData as $id => $qty) {
        $acc = Accessory::find($id);
        if ($acc) {
            $acc->selected_quantity = (int) $qty;
            $selectedColumnAccessoriesList->push($acc);
        }
    }

    $selectedOtherAccessoriesList = collect();
    foreach ($otherData as $id => $qty) {
        $acc = Accessory::find($id);
        if ($acc) {
            $acc->selected_quantity = (int) $qty;
            $selectedOtherAccessoriesList->push($acc);
        }
    }

    $totalPrice = Configurator::calculateTotalPrice(
        $selectedProducts,
        $selectedColumnAccessoriesList,
        $selectedOtherAccessoriesList,
    );

    $pdf = Pdf::loadView('pdf.configuration', [
        'selectedProducts' => $selectedProducts,
        'selectedColumnAccessoriesList' => $selectedColumnAccessoriesList,
        'selectedOtherAccessoriesList' => $selectedOtherAccessoriesList,
        'totalPrice' => $totalPrice,
    ]);
    $pdf->setPaper('a4', 'portrait');

    return $pdf->download(
        'Kitchen_Configuration_'.now()->format('Ymd_His').'.pdf',
    );
})->name('configurator.pdf');
