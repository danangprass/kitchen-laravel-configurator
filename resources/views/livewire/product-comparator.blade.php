<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Compare Ovens</h1>
            <p class="mt-1 text-slate-600">Compare up to 3 ovens side-by-side</p>
        </div>
        <a href="{{ route('configurator') }}" wire:navigate
            class="px-5 py-2.5 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add Products
        </a>
    </div>

    @if ($this->products->isEmpty())
        <div class="text-center py-16 bg-white rounded-xl border border-slate-200">
            <div class="mx-auto w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-slate-900 mb-2">No ovens selected</h2>
            <p class="text-slate-500 mb-6">Select up to 3 ovens from the configurator to compare them side-by-side.</p>
            <a href="{{ route('configurator') }}" wire:navigate
                class="inline-flex items-center px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition">
                Go to Configurator
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    @else
        {{-- Toggle + Clear --}}
        <div class="flex items-center justify-between mb-4">
            <button wire:click="toggleDifferences"
                class="px-4 py-2 rounded-lg font-medium text-sm transition flex items-center
                {{ $showOnlyDifferences ? 'bg-slate-600 text-white' : 'bg-white border border-slate-300 text-slate-700 hover:bg-slate-50' }}">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Show only differences
            </button>
            <button wire:click="clearCompare"
                class="px-4 py-2 text-sm text-red-600 hover:text-red-700 font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Clear All
            </button>
        </div>

        {{-- Comparison Table --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-700 bg-slate-50 w-48">
                            Specification
                        </th>
                        @foreach ($this->products as $product)
                            <th class="px-6 py-4 text-center bg-slate-50 min-w-[200px]">
                                <div class="flex flex-col items-center space-y-1">
                                    <span class="text-sm font-bold text-slate-900">{!! $product->name !!}</span>
                                    <button wire:click="removeFromCompare({{ $product->id }})"
                                        class="text-xs text-red-500 hover:text-red-700 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Remove
                                    </button>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->specRows as $row)
                        <tr class="border-b border-slate-100 {{ $loop->even ? 'bg-slate-50/50' : '' }}">
                            <td class="px-6 py-3 text-sm font-medium text-slate-700">
                                {{ $row['label'] }}
                            </td>
                            @foreach ($row['values'] as $value)
                                <td class="px-6 py-3 text-sm text-center {{ $row['allSame'] ? 'text-slate-400' : 'text-slate-900 font-medium' }}">
                                    {{ $value }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Empty state when all filtered --}}
        @if (empty($this->specRows) && $showOnlyDifferences)
            <div class="text-center py-8 mt-4 bg-green-50 rounded-xl border border-green-200">
                <p class="text-green-700 font-medium">All specifications are identical across the selected ovens.</p>
            </div>
        @endif
    @endif
</div>
