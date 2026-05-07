<div
    x-data="{ open: @entangle('isOpen') }"
    x-on:click.outside="open = false"
    x-on:keydown.escape.window="open = false"
    class="relative"
>
    <div class="relative">
        <svg
            class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400 pointer-events-none"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
        <input
            type="search"
            wire:model.live.debounce.300ms="query"
            placeholder="Search products, accessories..."
            class="w-64 pl-10 pr-4 py-2 text-sm border border-gray-200 rounded-lg bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all"
        >
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        x-cloak
        class="absolute right-0 mt-2 w-80 bg-white rounded-lg border border-gray-200 shadow-lg overflow-hidden z-50"
    >
        @if($this->hasResults)
            @if(!empty($this->results['products']))
                <div class="px-3 py-2">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Products</h4>
                    @foreach($this->results['products'] as $result)
                        <a
                            href="{{ $result['url'] }}"
                            wire:click="resetAndNavigate"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md mt-1 transition-colors"
                        >
                            {{ $result['label'] }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if(!empty($this->results['accessories']))
                <div class="px-3 py-2 @if(!empty($this->results['products'])) border-t border-gray-100 @endif">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Accessories</h4>
                    @foreach($this->results['accessories'] as $result)
                        <a
                            href="{{ $result['url'] }}"
                            wire:click="resetAndNavigate"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md mt-1 transition-colors"
                        >
                            {{ $result['label'] }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if(!empty($this->results['categories']))
                <div class="px-3 py-2 @if(!empty($this->results['products']) || !empty($this->results['accessories'])) border-t border-gray-100 @endif">
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Categories</h4>
                    @foreach($this->results['categories'] as $result)
                        <a
                            href="{{ $result['url'] }}"
                            wire:click="resetAndNavigate"
                            class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md mt-1 transition-colors"
                        >
                            {{ $result['label'] }}
                        </a>
                    @endforeach
                </div>
            @endif
        @else
            <div class="px-4 py-6 text-center text-sm text-gray-500">
                No results found for "{{ $query }}"
            </div>
        @endif
    </div>
</div>
