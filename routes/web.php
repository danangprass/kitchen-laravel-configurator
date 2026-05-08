<?php

use App\Http\Controllers\PageController;
use App\Livewire\BookingForm;
use App\Livewire\Configurator;
use App\Livewire\ConsumptionCalculator;
use App\Livewire\ContactForm;
use App\Livewire\DealerLocator;
use App\Livewire\FaqPage;
use App\Livewire\HomePage;
use App\Livewire\ProductComparator;
use App\Livewire\TestimonialsPage;
use App\Models\Accessory;
use App\Models\NewsletterSubscriber;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

Route::get('/configurator', Configurator::class)->name('configurator');

Route::livewire('/compare', ProductComparator::class)->name('compare');

Route::get('/privacy-policy', fn () => view('pages.privacy-policy'))->name(
    'privacy-policy',
);

Route::post('/newsletter/subscribe', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required|email|unique:newsletter_subscribers,email',
        'consent' => 'required|accepted',
    ]);

    NewsletterSubscriber::create(['email' => $validated['email']]);

    return redirect()
        ->back()
        ->with('newsletter_success', 'Thanks! You have been subscribed.');
})
    ->middleware('throttle:10,60')
    ->name('newsletter.subscribe');

Route::get('/testimonials', TestimonialsPage::class)->name('testimonials');
Route::get('/faq', FaqPage::class)->name('faq');

Route::get('/contact', ContactForm::class)->name('contact');

Route::get('/book-trial', BookingForm::class)->name('book-trial');

Route::get('/calculator', ConsumptionCalculator::class)->name('calculator');
Route::get('/dealers', DealerLocator::class)->name('dealers');

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

Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '[a-z0-9\-]+')
    ->name('pages.show');
