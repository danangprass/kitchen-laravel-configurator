<div class="space-y-6" x-data="{ showRestartModal: false }" x-init="$wire.on('stepChanged', () => window.scrollTo({top: 0, behavior: 'smooth'}))">

    {{-- Step Navigation --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
        <div class="flex items-center justify-between max-w-4xl mx-auto">
            <button type="button" x-on:click="showRestartModal = true" @disabled($step === 1)
                class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center disabled:opacity-50 disabled:cursor-not-allowed">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                Restart
            </button>

            @foreach ([
                1 => ['icon' => 'oven', 'label' => 'Choose oven/s'],
                2 => ['icon' => 'layout', 'label' => 'Arrangement'],
                3 => ['icon' => 'columns', 'label' => 'Column accessories'],
                4 => ['icon' => 'plus', 'label' => 'Other accessories'],
                5 => ['icon' => 'check', 'label' => 'Summary'],
            ] as $num => $info)
                <div class="flex flex-col items-center relative flex-1">
                    @if ($num > 1)
                        <div class="absolute top-5 -left-1/2 w-full h-0.5 {{ $step >= $num ? 'bg-slate-600' : 'bg-slate-200' }}"></div>
                    @endif
                    <button wire:click="goToStep({{ $num }})"
                        class="relative z-10 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-200
                        {{ $step === $num ? 'bg-slate-600 text-white ring-4 ring-slate-200' : ($step > $num ? 'bg-slate-600 text-white' : 'bg-slate-100 text-slate-400') }}">
                        @if ($step > $num)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        @else
                            {{ $num }}
                        @endif
                    </button>
                    <span class="mt-2 text-xs font-medium {{ $step === $num ? 'text-slate-600' : 'text-slate-400' }}">{{ $info['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Step 1: Choose Oven/s --}}
    @if ($step === 1)
        <div class="space-y-6 animate-fade-in">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900">Build your own solution!</h2>
                <p class="mt-2 text-slate-600 max-w-2xl mx-auto">There are different types of professional ovens, which must be chosen according to the individual needs of each chef and vary depending on the destination, the type of use, the budget, the type of cooking to be carried out and the type of business.</p>
            </div>

            {{-- Selected Products Preview --}}
            @if (count($selectedProductIds) > 0)
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-semibold text-slate-900">Selected ovens ({{ count($selectedProductIds) }})</h3>
                        <button wire:click="restart" class="text-sm text-slate-600 hover:text-slate-800">Clear all</button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($this->selectedProducts as $product)
                            <div class="inline-flex items-center bg-white rounded-lg px-3 py-2 shadow-sm border border-slate-200">
                                <span class="text-sm font-medium text-slate-800">{{ $product->name }}</span>
                                <button wire:click="removeProduct({{ $product->id }})" class="ml-2 text-slate-400 hover:text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Categories --}}
            @if (!$selectedCategoryId)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($this->categories as $category)
                        <button wire:click="selectCategory({{ $category->id }})"
                            class="group bg-white rounded-xl border-2 border-slate-200 hover:border-slate-600 p-6 text-left transition-all duration-200 hover:shadow-lg">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-slate-600">{{ $category->name }}</h3>
                            <p class="mt-2 text-sm text-slate-500">{{ $category->description ?? 'Professional ' . strtolower($category->name) . ' ovens' }}</p>
                            <div class="mt-4 flex items-center text-slate-600 text-sm font-medium">
                                Select
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </button>
                    @endforeach
                </div>
            @endif

            {{-- Subcategories --}}
            @if ($selectedCategoryId && !$selectedSubcategoryId)
                <div>
                    <button wire:click="$set('selectedCategoryId', null)" class="mb-4 text-sm text-slate-500 hover:text-slate-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Back to categories
                    </button>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $this->selectedCategory?->name }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($this->subcategories as $subcategory)
                            <button wire:click="selectSubcategory({{ $subcategory->id }})"
                                class="group bg-white rounded-xl border-2 border-slate-200 hover:border-slate-600 p-6 text-left transition-all duration-200 hover:shadow-lg">
                                <h4 class="text-lg font-bold text-slate-900 group-hover:text-slate-600">{{ $subcategory->name }}</h4>
                                <p class="mt-1 text-sm text-slate-500">{{ $subcategory->products_count ?? 0 }} models</p>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Products --}}
            @if ($selectedSubcategoryId)
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <button wire:click="$set('selectedSubcategoryId', null)" class="text-sm text-slate-500 hover:text-slate-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            Back to {{ $this->selectedCategory?->name }}
                        </button>
                        <span class="text-sm text-slate-500">{{ $this->products->count() }} models available</span>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $this->selectedSubcategory?->name }}</h3>

                    {{-- Advanced Filters --}}
                    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden mb-4">
                        <button type="button" wire:click="$toggle('showFilters')"
                            class="w-full flex items-center justify-between px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-colors">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                <span class="font-medium text-slate-700 text-sm">Filters</span>
                                @if ($this->activeFilterCount > 0)
                                    <span class="bg-slate-600 text-white text-xs font-medium px-2 py-0.5 rounded-full">{{ $this->activeFilterCount }} active</span>
                                @endif
                            </div>
                            <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 {{ $showFilters ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        @if ($showFilters)
                            <div class="p-4 border-t border-slate-200 animate-fade-in">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    {{-- Tray Type --}}
                                    <div>
                                        <label for="filterTraySize" class="block text-xs font-medium text-slate-600 mb-1">Tray Type</label>
                                        <select id="filterTraySize" wire:model.live="filterTraySize"
                                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-slate-500 focus:ring-1 focus:ring-slate-500">
                                            <option value="">All tray types</option>
                                            @foreach ($this->traySizeOptions as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Power Supply --}}
                                    <div>
                                        <label for="filterPowerSupply" class="block text-xs font-medium text-slate-600 mb-1">Power Supply</label>
                                        <select id="filterPowerSupply" wire:model.live="filterPowerSupply"
                                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-slate-500 focus:ring-1 focus:ring-slate-500">
                                            <option value="">All power types</option>
                                            @foreach ($this->powerSupplyOptions as $option)
                                                <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- ENERGY STAR --}}
                                    <div>
                                        <label for="filterEnergyStar" class="block text-xs font-medium text-slate-600 mb-1">ENERGY STAR</label>
                                        <select id="filterEnergyStar" wire:model.live="filterEnergyStar"
                                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-slate-500 focus:ring-1 focus:ring-slate-500">
                                            <option value="">All</option>
                                            <option value="1">Certified</option>
                                            <option value="0">Not certified</option>
                                        </select>
                                    </div>

                                    {{-- Number of Trays --}}
                                    <div>
                                        <label for="filterTrayCount" class="block text-xs font-medium text-slate-600 mb-1">Number of Trays</label>
                                        <select id="filterTrayCount" wire:model.live="filterTrayCount"
                                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-slate-500 focus:ring-1 focus:ring-slate-500">
                                            <option value="">All tray counts</option>
                                            @foreach ($this->trayCountOptions as $option)
                                                <option value="{{ $option }}">{{ $option }} {{ $option === 1 ? 'tray' : 'trays' }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Line Family --}}
                                    <div>
                                        <label for="filterLine" class="block text-xs font-medium text-slate-600 mb-1">Line Family</label>
                                        <select id="filterLine" wire:model.live="filterLine"
                                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-slate-500 focus:ring-1 focus:ring-slate-500">
                                            <option value="">All lines</option>
                                            @foreach ($this->lineOptions as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Door Opening --}}
                                    <div>
                                        <label for="filterDoorOpening" class="block text-xs font-medium text-slate-600 mb-1">Door Opening</label>
                                        <select id="filterDoorOpening" wire:model.live="filterDoorOpening"
                                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 focus:border-slate-500 focus:ring-1 focus:ring-slate-500">
                                            <option value="">All door types</option>
                                            @foreach ($this->doorOpeningOptions as $option)
                                                <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if ($this->activeFilterCount > 0)
                                    <div class="mt-4 pt-3 border-t border-slate-100 flex justify-end">
                                        <button type="button" wire:click="clearFilters"
                                            class="text-sm text-slate-500 hover:text-slate-700 flex items-center transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Clear all filters
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse ($this->products as $product)
                            <div wire:click="toggleProduct({{ $product->id }})"
                                class="cursor-pointer bg-white rounded-xl border-2 {{ in_array($product->id, $selectedProductIds) ? 'border-slate-600 ring-2 ring-slate-200' : 'border-slate-200 hover:border-slate-300' }} p-4 transition-all duration-200 hover:shadow-md">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-slate-900 text-sm leading-tight">{!! $product->name !!}</h4>
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            @if ($product->line)
                                                <span class="inline-flex items-center bg-slate-100 text-slate-600 text-xs px-2 py-0.5 rounded-full">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                                    {{ $product->line }}
                                                </span>
                                            @endif
                                            @if ($product->consumption_kwh)
                                                <span class="inline-flex items-center bg-teal-50 text-teal-700 text-xs px-2 py-0.5 rounded-full">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
                                                    {{ $product->consumption_kwh }} kWh/day
                                                </span>
                                            @endif
                                            @if ($product->co2_emission)
                                                <span class="inline-flex items-center bg-sky-50 text-sky-700 text-xs px-2 py-0.5 rounded-full">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"/></svg>
                                                    {{ $product->co2_emission }} kg/day
                                                </span>
                                            @endif
                                            @if ($product->energy_star_certified)
                                                <span class="inline-flex items-center bg-amber-50 text-amber-700 text-xs px-2 py-0.5 rounded-full">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                    ENERGY STAR
                                                </span>
                                            @endif
                                        </div>
                                        <div class="mt-2 text-xs text-slate-500 space-y-0.5">
                                            @if ($product->number_of_trays)
                                                <p>{{ $product->number_of_trays }} trays {{ $product->tray_size }}</p>
                                            @endif
                                            @if ($product->electric_power)
                                                <p>{{ $product->electric_power }} kW</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center {{ in_array($product->id, $selectedProductIds) ? 'bg-slate-600 border-slate-600' : 'border-slate-300' }}">
                                            @if (in_array($product->id, $selectedProductIds))
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 pt-3 border-t border-slate-100">
                                    <label class="flex items-center cursor-pointer" wire:click.stop="toggleCompare({{ $product->id }})">
                                        <div class="w-5 h-5 rounded border-2 flex items-center justify-center transition {{ in_array($product->id, $this->comparedProductIds) ? 'bg-blue-600 border-blue-600' : 'border-slate-300 hover:border-blue-400' }}">
                                            @if (in_array($product->id, $this->comparedProductIds))
                                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            @endif
                                        </div>
                                        <span class="ml-2 text-xs font-medium {{ in_array($product->id, $this->comparedProductIds) ? 'text-blue-600' : 'text-slate-500' }}">Compare</span>
                                    </label>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 bg-slate-50 rounded-xl">
                                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <p class="text-slate-500 font-medium">No models match your filters</p>
                                <button type="button" wire:click="clearFilters" class="mt-2 text-sm text-slate-600 hover:text-slate-800 underline">
                                    Clear all filters
                                </button>
                            </div>
                        @endforelse
                    </div>
                    </div>
                </div>
            @endif

            {{-- Navigation --}}
            <div class="flex justify-end pt-4 border-t border-slate-200">
                <button wire:click="nextStep" @disabled(count($selectedProductIds) === 0)
                    class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                    Next: Arrangement
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Step 2: Arrangement --}}
    @if ($step === 2)
        <div class="space-y-6 animate-fade-in">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900">Arrangement</h2>
                <p class="mt-2 text-slate-600">Your selected ovens</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($this->selectedProducts as $product)
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="bg-slate-50 px-4 py-3 border-b border-slate-200 flex items-center justify-between">
                            <h3 class="font-semibold text-slate-900 text-sm">{{ $product->name }}</h3>
                            <button wire:click="removeProduct({{ $product->id }})" class="text-slate-400 hover:text-red-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <div class="p-4 space-y-3">
                            @if ($product->line)
                                <p class="text-xs text-slate-500">{{ $product->line }}</p>
                            @endif
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                @if ($product->control_type)
                                    <div class="bg-slate-50 rounded px-2 py-1"><span class="text-slate-500">Panel:</span> <span class="font-medium">{{ ucfirst($product->control_type) }}</span></div>
                                @endif
                                @if ($product->power_supply)
                                    <div class="bg-slate-50 rounded px-2 py-1"><span class="text-slate-500">Power:</span> <span class="font-medium">{{ ucfirst($product->power_supply) }}</span></div>
                                @endif
                                @if ($product->number_of_trays)
                                    <div class="bg-slate-50 rounded px-2 py-1"><span class="text-slate-500">Trays:</span> <span class="font-medium">{{ $product->number_of_trays }} {{ $product->tray_size }}</span></div>
                                @endif
                                @if ($product->electric_power)
                                    <div class="bg-slate-50 rounded px-2 py-1"><span class="text-slate-500">Power:</span> <span class="font-medium">{{ $product->electric_power }} kW</span></div>
                                @endif
                                @if ($product->width && $product->depth && $product->height)
                                    <div class="bg-slate-50 rounded px-2 py-1 col-span-2"><span class="text-slate-500">Dimensions:</span> <span class="font-medium">{{ $product->width }}×{{ $product->depth }}×{{ $product->height }} mm</span></div>
                                @endif
                            </div>
                            @if ($product->energy_star_certified)
                                <div class="flex items-center text-green-600 text-xs">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    Energy Star Certified
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between pt-4 border-t border-slate-200">
                <button wire:click="prevStep" class="px-6 py-3 bg-white border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button wire:click="nextStep" class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center">
                    Next: Column Accessories
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Step 3: Column Accessories --}}
    @if ($step === 3)
        <div class="space-y-6 animate-fade-in">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900">Column Accessories</h2>
                <p class="mt-2 text-slate-600">Accessories for your oven column/stack</p>
            </div>

            @if ($this->compatibleColumnAccessories->isEmpty())
                <div class="text-center py-12 bg-slate-50 rounded-xl">
                    <p class="text-slate-500">No column accessories available for your selected ovens.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($this->compatibleColumnAccessories as $accessory)
                        <div wire:click="toggleColumnAccessory({{ $accessory->id }})"
                            class="cursor-pointer bg-white rounded-xl border-2 {{ isset($columnAccessories[$accessory->id]) ? 'border-slate-600 ring-2 ring-slate-200' : 'border-slate-200 hover:border-slate-300' }} p-4 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $accessory->commercial_name ?? $accessory->name }}</h4>
                                    <p class="text-xs text-slate-500 mt-1">{{ $accessory->sku }}</p>
                                    @if ($accessory->accessory_line)
                                        <p class="text-xs text-slate-600 mt-1">{{ $accessory->accessory_line }}</p>
                                    @endif
                                    @if ($accessory->labels && count($accessory->labels) > 0)
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            @foreach (collect($accessory->labels)->take(3) as $label)
                                                <span class="inline-block bg-slate-50 text-slate-700 text-xs px-2 py-0.5 rounded">{{ str_replace('_', ' ', $label['label'] ?? '') }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center {{ isset($columnAccessories[$accessory->id]) ? 'bg-slate-600 border-slate-600' : 'border-slate-300' }}">
                                        @if (isset($columnAccessories[$accessory->id]))
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (isset($columnAccessories[$accessory->id]))
                                <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <label class="text-xs text-slate-500">Quantity</label>
                                    <div class="flex items-center space-x-2">
                                        <button wire:click.stop="updateColumnAccessoryQuantity({{ $accessory->id }}, {{ ($columnAccessories[$accessory->id]['quantity'] ?? 1) - 1 }})" class="w-7 h-7 rounded bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600">-</button>
                                        <span class="text-sm font-medium w-6 text-center">{{ $columnAccessories[$accessory->id]['quantity'] ?? 1 }}</span>
                                        <button wire:click.stop="updateColumnAccessoryQuantity({{ $accessory->id }}, {{ ($columnAccessories[$accessory->id]['quantity'] ?? 1) + 1 }})" class="w-7 h-7 rounded bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600">+</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="flex justify-between pt-4 border-t border-slate-200">
                <button wire:click="prevStep" class="px-6 py-3 bg-white border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button wire:click="nextStep" class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center">
                    Next: Other Accessories
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Step 4: Other Accessories --}}
    @if ($step === 4)
        <div class="space-y-6 animate-fade-in">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900">Other Accessories</h2>
                <p class="mt-2 text-slate-600">Additional accessories for your configuration</p>
            </div>

            @if ($this->compatibleOtherAccessories->isEmpty())
                <div class="text-center py-12 bg-slate-50 rounded-xl">
                    <p class="text-slate-500">No other accessories available for your selected ovens.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($this->compatibleOtherAccessories as $accessory)
                        <div wire:click="toggleOtherAccessory({{ $accessory->id }})"
                            class="cursor-pointer bg-white rounded-xl border-2 {{ isset($otherAccessories[$accessory->id]) ? 'border-slate-600 ring-2 ring-slate-200' : 'border-slate-200 hover:border-slate-300' }} p-4 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $accessory->commercial_name ?? $accessory->name }}</h4>
                                    <p class="text-xs text-slate-500 mt-1">{{ $accessory->sku }}</p>
                                    @if ($accessory->accessory_category)
                                        <p class="text-xs text-slate-400 mt-1">{{ $accessory->accessory_category }}</p>
                                    @endif
                                    @if ($accessory->labels && count($accessory->labels) > 0)
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            @foreach (collect($accessory->labels)->take(3) as $label)
                                                <span class="inline-block bg-slate-50 text-slate-600 text-xs px-2 py-0.5 rounded">{{ str_replace('_', ' ', $label['label'] ?? '') }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center {{ isset($otherAccessories[$accessory->id]) ? 'bg-slate-600 border-slate-600' : 'border-slate-300' }}">
                                        @if (isset($otherAccessories[$accessory->id]))
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (isset($otherAccessories[$accessory->id]))
                                <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <label class="text-xs text-slate-500">Quantity</label>
                                    <div class="flex items-center space-x-2">
                                        <button wire:click.stop="updateOtherAccessoryQuantity({{ $accessory->id }}, {{ ($otherAccessories[$accessory->id]['quantity'] ?? 1) - 1 }})" class="w-7 h-7 rounded bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600">-</button>
                                        <span class="text-sm font-medium w-6 text-center">{{ $otherAccessories[$accessory->id]['quantity'] ?? 1 }}</span>
                                        <button wire:click.stop="updateOtherAccessoryQuantity({{ $accessory->id }}, {{ ($otherAccessories[$accessory->id]['quantity'] ?? 1) + 1 }})" class="w-7 h-7 rounded bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600">+</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="flex justify-between pt-4 border-t border-slate-200">
                <button wire:click="prevStep" class="px-6 py-3 bg-white border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button wire:click="nextStep" class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center">
                    Next: Summary
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Step 5: Summary --}}
    @if ($step === 5)
        <div class="space-y-6 animate-fade-in">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900">Summary</h2>
                <p class="mt-2 text-slate-600">Review your configuration</p>
            </div>

            {{-- Ovens --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                    <h3 class="font-bold text-slate-900">Selected Ovens ({{ $this->selectedProducts->count() }})</h3>
                </div>
                <div class="divide-y divide-slate-100">
                    @foreach ($this->selectedProducts as $product)
                        <div class="px-6 py-4 flex items-center justify-between">
                            <div>
                                <p class="font-medium text-slate-900">{!! $product->name !!}</p>
                                <p class="text-sm text-slate-500">{{ $product->line ?? '' }}</p>
                            </div>
                            @if ($product->price)
                                <span class="font-semibold text-slate-900">${{ number_format($product->price, 2) }}</span>
                            @else
                                <span class="text-sm text-slate-400">Price on request</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Column Accessories --}}
            @if ($this->selectedColumnAccessoriesList->isNotEmpty())
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                        <h3 class="font-bold text-slate-900">Column Accessories ({{ $this->selectedColumnAccessoriesList->count() }})</h3>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach ($this->selectedColumnAccessoriesList as $accessory)
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-slate-900">{{ $accessory->commercial_name ?? $accessory->name }}</p>
                                    <p class="text-sm text-slate-500">{{ $accessory->sku }} × {{ $accessory->selected_quantity }}</p>
                                </div>
                                @if ($accessory->price)
                                    <span class="font-semibold text-slate-900">${{ number_format($accessory->price * $accessory->selected_quantity, 2) }}</span>
                                @else
                                    <span class="text-sm text-slate-400">Price on request</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Other Accessories --}}
            @if ($this->selectedOtherAccessoriesList->isNotEmpty())
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                        <h3 class="font-bold text-slate-900">Other Accessories ({{ $this->selectedOtherAccessoriesList->count() }})</h3>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach ($this->selectedOtherAccessoriesList as $accessory)
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-slate-900">{{ $accessory->commercial_name ?? $accessory->name }}</p>
                                    <p class="text-sm text-slate-500">{{ $accessory->sku }} × {{ $accessory->selected_quantity }}</p>
                                </div>
                                @if ($accessory->price)
                                    <span class="font-semibold text-slate-900">${{ number_format($accessory->price * $accessory->selected_quantity, 2) }}</span>
                                @else
                                    <span class="text-sm text-slate-400">Price on request</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Total --}}
            @if ($this->hasPricing)
                <div class="bg-slate-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-medium">Total Estimate</span>
                        <span class="text-3xl font-bold">${{ number_format($this->totalPrice, 2) }}</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-100">Prices are estimates and may vary. Contact us for a formal quote.</p>
                </div>
            @else
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center">
                    <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-amber-800">Pricing Information Unavailable</h3>
                    <p class="mt-2 text-amber-700">Detailed pricing information is currently being updated. Please contact us for a personalized quote tailored to your configuration.</p>
                    <a href="mailto:info@unox.com" class="mt-4 inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg font-medium hover:bg-amber-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Contact Us for Pricing
                    </a>
                </div>
            @endif

            <form action="{{ route('configurator.pdf') }}" method="GET" target="_blank" class="flex justify-between pt-4 border-t border-slate-200">
                <button type="button" wire:click="prevStep" class="px-6 py-3 bg-white border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </button>

                @foreach($selectedProductIds as $id)
                    <input type="hidden" name="products[]" value="{{ $id }}">
                @endforeach
                @foreach($columnAccessories as $id => $data)
                    <input type="hidden" name="column[{{ $id }}]" value="{{ $data['quantity'] }}">
                @endforeach
                @foreach($otherAccessories as $id => $data)
                    <input type="hidden" name="other[{{ $id }}]" value="{{ $data['quantity'] }}">
                @endforeach

                <div class="flex items-center space-x-3">
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Export to PDF
                    </button>
                    <button type="button" wire:click="restart" class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Start Over
                    </button>
                </div>
            </form>
        </div>
    @endif

    {{-- Restart Confirmation Modal --}}
    <div x-show="showRestartModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center" x-transition.opacity>
        <div class="absolute inset-0 bg-black/50" x-on:click="showRestartModal = false"></div>
        <div class="relative bg-white rounded-xl shadow-2xl p-6 max-w-md w-full mx-4" x-on:click.outside="showRestartModal = false">
            <div class="text-center">
                <div class="mx-auto w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Restart configuration?</h3>
                <p class="mt-2 text-sm text-slate-600">This will clear all your selections and return to Step 1. This action cannot be undone.</p>
            </div>
            <div class="mt-6 flex justify-center space-x-3">
                <button type="button" x-on:click="showRestartModal = false" class="px-6 py-2.5 bg-white border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition">
                    Cancel
                </button>
                <button type="button" x-on:click="showRestartModal = false; $wire.restart()" class="px-6 py-2.5 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                    Yes, restart
                </button>
            </div>
        </div>
    </div>

    {{-- Floating Compare Bar --}}
    @if ($this->comparedProductCount > 0)
        <div class="fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-slate-200 shadow-lg animate-fade-in">
            <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-bold">
                        {{ $this->comparedProductCount }}
                    </span>
                    <span class="text-sm font-medium text-slate-700">
                        {{ $this->comparedProductCount === 1 ? '1 oven' : $this->comparedProductCount . ' ovens' }} selected for comparison
                    </span>
                </div>
                <a href="{{ route('compare') }}" wire:navigate
                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-semibold text-sm hover:bg-blue-700 transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                    </svg>
                    Compare
                </a>
            </div>
        </div>
        <div class="h-14"></div>
    @endif
</div>
