<div class="space-y-6" x-init="$wire.on('stepChanged', () => window.scrollTo({top: 0, behavior: 'smooth'}))">

    {{-- Step Indicators --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
        <div class="flex items-center justify-between max-w-3xl mx-auto">
            @foreach ([
                1 => ['label' => 'Select Ovens', 'icon' => 'oven'],
                2 => ['label' => 'Usage', 'icon' => 'clock'],
                3 => ['label' => 'Energy Source', 'icon' => 'bolt'],
                4 => ['label' => 'Results', 'icon' => 'chart'],
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

    {{-- Step 1: Select Ovens --}}
    @if ($step === 1)
        <div class="space-y-6 animate-fade-in">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900">Consumption & Emissions Calculator</h2>
                <p class="mt-2 text-slate-600 max-w-2xl mx-auto">Select up to 4 ovens to estimate their energy consumption, CO<sub>2</sub> emissions, and operating costs.</p>
            </div>

            {{-- Selected Products Preview --}}
            @if (count($selectedProductIds) > 0)
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-semibold text-slate-900">Selected ovens ({{ count($selectedProductIds) }}/4)</h3>
                        <button wire:click="restart" class="text-sm text-slate-600 hover:text-slate-800">Clear all</button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($this->selectedProducts as $product)
                            <div class="inline-flex items-center bg-white rounded-lg px-3 py-2 shadow-sm border border-slate-200">
                                <span class="text-sm font-medium text-slate-800">{{ $this->productLabel($product) }}</span>
                                <button wire:click="removeProduct({{ $product->id }})" class="ml-2 text-slate-400 hover:text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Product Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($this->products as $product)
                    <div wire:click="toggleProduct({{ $product->id }})"
                        class="cursor-pointer bg-white rounded-xl border-2 {{ in_array($product->id, $selectedProductIds) ? 'border-slate-600 ring-2 ring-slate-200' : 'border-slate-200 hover:border-slate-300' }} p-4 transition-all duration-200 hover:shadow-md">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-900 text-sm leading-tight">{{ $this->productLabel($product) }}</h4>
                                @if ($product->line)
                                    <p class="mt-1 text-xs text-slate-500">{{ $product->line }}</p>
                                @endif
                                <div class="mt-2 flex flex-wrap gap-1">
                                    @if ($product->control_type)
                                        <span class="inline-block bg-slate-100 text-slate-600 text-xs px-2 py-0.5 rounded">{{ ucfirst($product->control_type) }}</span>
                                    @endif
                                    @if ($product->power_supply)
                                        <span class="inline-block bg-slate-100 text-slate-600 text-xs px-2 py-0.5 rounded">{{ ucfirst($product->power_supply) }}</span>
                                    @endif
                                    @if ($product->energy_star_certified)
                                        <span class="inline-block bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded">Energy Star</span>
                                    @endif
                                </div>
                                <div class="mt-2 text-xs text-slate-500 space-y-0.5">
                                    @if ($product->consumption_kwh)
                                        <p>Consumption: {{ $product->consumption_kwh }} kWh</p>
                                    @endif
                                    @if ($product->electric_power)
                                        <p>Power: {{ $product->electric_power }} kW</p>
                                    @endif
                                    @if ($product->co2_emission)
                                        <p>CO<sub>2</sub>: {{ $product->co2_emission }} kg/kWh</p>
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
                    </div>
                @endforeach
            </div>

            {{-- Navigation --}}
            <div class="flex justify-end pt-4 border-t border-slate-200">
                <button wire:click="nextStep" @disabled(count($selectedProductIds) === 0)
                    class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                    Next: Usage Mode
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Step 2: Usage Mode --}}
    @if ($step === 2)
        <div class="space-y-6 animate-fade-in">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900">Usage Mode</h2>
                <p class="mt-2 text-slate-600">How many hours per day do you typically use your ovens?</p>
            </div>

            <div class="max-w-lg mx-auto space-y-3">
                @foreach ($usageModeLabels as $value => $label)
                    <label wire:click="$set('usageMode', '{{ $value }}')"
                        class="cursor-pointer flex items-center p-4 rounded-xl border-2 transition-all duration-200
                        {{ $usageMode === $value ? 'border-slate-600 bg-slate-50 ring-2 ring-slate-200' : 'border-slate-200 bg-white hover:border-slate-300' }}">
                        <input type="radio" name="usageMode" value="{{ $value }}" wire:model.live="usageMode" class="sr-only">
                        <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center mr-4
                            {{ $usageMode === $value ? 'border-slate-600' : 'border-slate-300' }}">
                            @if ($usageMode === $value)
                                <div class="w-2.5 h-2.5 rounded-full bg-slate-600"></div>
                            @endif
                        </div>
                        <div>
                            <span class="font-medium text-slate-900">{{ $label }}</span>
                        </div>
                    </label>
                @endforeach
            </div>

            <div class="flex justify-between pt-4 border-t border-slate-200">
                <button wire:click="prevStep" class="px-6 py-3 bg-white border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button wire:click="nextStep" class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center">
                    Next: Energy Source
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Step 3: Energy Source --}}
    @if ($step === 3)
        <div class="space-y-6 animate-fade-in">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900">Energy Source</h2>
                <p class="mt-2 text-slate-600">Select your energy source to estimate operating costs.</p>
            </div>

            <div class="max-w-lg mx-auto space-y-3">
                @foreach ($energySourceLabels as $value => $label)
                    <label wire:click="$set('energySource', '{{ $value }}')"
                        class="cursor-pointer flex items-center p-4 rounded-xl border-2 transition-all duration-200
                        {{ $energySource === $value ? 'border-slate-600 bg-slate-50 ring-2 ring-slate-200' : 'border-slate-200 bg-white hover:border-slate-300' }}">
                        <input type="radio" name="energySource" value="{{ $value }}" wire:model.live="energySource" class="sr-only">
                        <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center mr-4
                            {{ $energySource === $value ? 'border-slate-600' : 'border-slate-300' }}">
                            @if ($energySource === $value)
                                <div class="w-2.5 h-2.5 rounded-full bg-slate-600"></div>
                            @endif
                        </div>
                        <div>
                            <span class="font-medium text-slate-900">{{ $label }}</span>
                        </div>
                    </label>
                @endforeach
            </div>

            <div class="flex justify-between pt-4 border-t border-slate-200">
                <button wire:click="prevStep" class="px-6 py-3 bg-white border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button wire:click="nextStep" class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center">
                    View Results
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Step 4: Results --}}
    @if ($step === 4)
        <div class="space-y-6 animate-fade-in">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900">Consumption & Emissions Results</h2>
                <p class="mt-2 text-slate-600">
                    Based on {{ $this->hoursPerDay }} hours/day usage with {{ $energySource }} energy source.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($this->results as $result)
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="bg-slate-50 px-4 py-3 border-b border-slate-200">
                            <h3 class="font-semibold text-slate-900 text-sm">{{ $this->productLabel($result['product']) }}</h3>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="grid grid-cols-3 gap-3">
                                {{-- kWh/day --}}
                                <div class="bg-amber-50 rounded-lg p-3 text-center border border-amber-200">
                                    <p class="text-xs text-amber-600 font-medium mb-1">Energy</p>
                                    <p class="text-xl font-bold text-amber-700">{{ $result['kwh_per_day'] }}</p>
                                    <p class="text-xs text-amber-500">kWh/day</p>
                                </div>

                                {{-- CO2/day --}}
                                <div class="bg-green-50 rounded-lg p-3 text-center border border-green-200">
                                    <p class="text-xs text-green-600 font-medium mb-1">CO<sub>2</sub></p>
                                    <p class="text-xl font-bold text-green-700">{{ $result['co2_per_day'] }}</p>
                                    <p class="text-xs text-green-500">kg/day</p>
                                </div>

                                {{-- Monthly Cost --}}
                                <div class="bg-blue-50 rounded-lg p-3 text-center border border-blue-200">
                                    <p class="text-xs text-blue-600 font-medium mb-1">Cost</p>
                                    <p class="text-xl font-bold text-blue-700">${{ number_format($result['monthly_cost'], 2) }}</p>
                                    <p class="text-xs text-blue-500">per month</p>
                                </div>
                            </div>

                            <div class="text-xs text-slate-500 space-y-1">
                                <p>Usage: {{ $result['hours_per_day'] }} hrs/day</p>
                                <p>Rate: ${{ number_format($result['cost_per_kwh'], 2) }}/kWh ({{ $result['energy_source'] }})</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Grand Total --}}
            @php
                $totalKwh = collect($this->results)->sum('kwh_per_day');
                $totalCo2 = collect($this->results)->sum('co2_per_day');
                $totalCost = collect($this->results)->sum('monthly_cost');
            @endphp

            @if (count($this->results) > 1)
                <div class="bg-slate-600 rounded-xl p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4">Combined Totals</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center">
                            <p class="text-sm text-slate-200">Total Energy</p>
                            <p class="text-2xl font-bold">{{ round($totalKwh, 2) }} kWh/day</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-slate-200">Total CO<sub>2</sub></p>
                            <p class="text-2xl font-bold">{{ round($totalCo2, 2) }} kg/day</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-slate-200">Total Monthly Cost</p>
                            <p class="text-2xl font-bold">${{ number_format($totalCost, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm text-slate-600">
                <p class="font-medium mb-1">Disclaimer</p>
                <p>These calculations are estimates based on standard usage assumptions. Actual energy consumption and costs may vary depending on installation conditions, menu complexity, ambient temperature, and local utility rates.</p>
            </div>

            <div class="flex justify-between pt-4 border-t border-slate-200">
                <button wire:click="prevStep" class="px-6 py-3 bg-white border border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-50 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </button>
                <button wire:click="restart" class="px-6 py-3 bg-slate-600 text-white rounded-lg font-semibold hover:bg-slate-700 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Start Over
                </button>
            </div>
        </div>
    @endif

</div>
