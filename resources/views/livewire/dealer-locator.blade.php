<div class="bg-slate-50 h-screen overflow-hidden"
     x-data="dealerMap()"
     x-init="init(@json($dealers))">

    <div class="flex h-[calc(100vh-4rem)]">

        {{-- Sidebar --}}
        <div class="w-96 bg-white border-r border-slate-200 flex flex-col shrink-0 overflow-hidden"
             :class="{ 'max-md:hidden': !sidebarHidden, 'max-md:flex max-md:w-full': sidebarHidden }">

            {{-- Mobile toggle --}}
            <button class="hidden max-md:block w-full text-left px-4 py-3 border-b border-slate-200 text-sm font-medium text-slate-700 bg-slate-50"
                    x-on:click="sidebarHidden = !sidebarHidden">
                <span x-show="sidebarHidden">&#10005; Close</span>
                <span x-show="!sidebarHidden">&#9776; Dealer List — {{ $dealers->count() }} found</span>
            </button>

            {{-- Filters --}}
            <div class="p-4 border-b border-slate-100 space-y-3">
                <h2 class="font-semibold text-slate-800 text-lg">Find a Dealer</h2>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Type</label>
                    <select wire:model.live="typeFilter"
                            class="w-full rounded-lg border-slate-300 text-sm py-2 px-3 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All Types</option>
                        @foreach($this->dealerTypes as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Service Level</label>
                    <select wire:model.live="levelFilter"
                            class="w-full rounded-lg border-slate-300 text-sm py-2 px-3 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">All Levels</option>
                        @foreach($this->serviceLevels as $level)
                            <option value="{{ $level }}">{{ $level }}</option>
                        @endforeach
                    </select>
                </div>
                @if($typeFilter || $levelFilter)
                    <button wire:click="resetFilters"
                            class="text-xs text-blue-600 hover:text-blue-800 transition">
                        Clear filters
                    </button>
                @endif
            </div>

            {{-- Dealer Cards --}}
            <div class="flex-1 overflow-y-auto" id="dealer-list">
                @forelse($dealers as $dealer)
                    <div class="dealer-card p-4 border-b border-slate-100 cursor-pointer hover:bg-slate-50 transition"
                         data-dealer-id="{{ $dealer->id }}"
                         data-lat="{{ $dealer->latitude }}"
                         data-lng="{{ $dealer->longitude }}"
                         x-on:click="focusDealer('{{ $dealer->id }}', '{{ $dealer->latitude }}', '{{ $dealer->longitude }}')">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="font-medium text-slate-800 text-sm">{{ $dealer->name }}</h3>
                                <span class="inline-block text-xs px-2 py-0.5 rounded-full mt-1
                                    @if($dealer->type === 'Unox Office') bg-blue-100 text-blue-700 @else bg-green-100 text-green-700 @endif">
                                    {{ $dealer->type }}
                                </span>
                            </div>
                            <span class="text-xs px-2 py-0.5 rounded-full
                                @if($dealer->service_level === 'Platinum') bg-purple-100 text-purple-700
                                @elseif($dealer->service_level === 'Gold') bg-yellow-100 text-yellow-700
                                @elseif($dealer->service_level === 'Silver') bg-gray-100 text-gray-700
                                @else bg-slate-100 text-slate-600 @endif">
                                {{ $dealer->service_level }}
                            </span>
                        </div>
                        @if($dealer->address)
                            <p class="text-xs text-slate-500 mt-1">{{ $dealer->address }}</p>
                        @endif
                        <div class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-xs text-slate-600">
                            @if($dealer->phone)
                                <a href="tel:{{ $dealer->phone }}" class="hover:text-blue-600 transition" onclick="event.stopPropagation()">
                                    &#9742; {{ $dealer->phone }}
                                </a>
                            @endif
                            @if($dealer->email)
                                <a href="mailto:{{ $dealer->email }}" class="hover:text-blue-600 transition" onclick="event.stopPropagation()">
                                    &#9993; {{ $dealer->email }}
                                </a>
                            @endif
                            @if($dealer->website)
                                <a href="{{ $dealer->website }}" target="_blank" rel="noopener noreferrer"
                                   class="hover:text-blue-600 transition" onclick="event.stopPropagation()">
                                    &#127760; Website
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-400">
                        <p class="text-lg mb-1">No dealers found</p>
                        <p class="text-sm">Try adjusting your filters</p>
                    </div>
                @endforelse
            </div>

            <div class="p-3 border-t border-slate-200 text-xs text-slate-400 text-center">
                {{ $dealers->count() }} dealer(s) found
            </div>
        </div>

        {{-- Map --}}
        <div class="flex-1 relative">
            <div id="map"></div>
            {{-- Mobile toggle --}}
            <button class="hidden max-md:block absolute top-3 left-3 z-[1000] bg-white rounded-lg shadow-md px-3 py-2 text-sm font-medium text-slate-700"
                    x-on:click="sidebarHidden = !sidebarHidden"
                    x-show="sidebarHidden">
                &#9776; List
            </button>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { height: 100%; width: 100%; }
    .dealer-card.active {
        border-left: 3px solid #2563eb;
        background-color: #eff6ff;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    function dealerMap() {
        return {
            sidebarHidden: window.innerWidth < 768,
            map: null,
            markers: [],

            init(dealerData) {
                this.map = L.map('map').setView([-2.5, 118], 5);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 19,
                }).addTo(this.map);

                this.addMarkers(dealerData);

                this.$wire.on('filters-updated', () => {
                    this.sidebarHidden = false;
                    this.$nextTick(() => {
                        setTimeout(() => this.syncMarkersFromDom(), 100);
                    });
                });

                window.addEventListener('resize', () => {
                    this.map.invalidateSize();
                });
            },

            syncMarkersFromDom() {
                const cards = document.querySelectorAll('#dealer-list .dealer-card');
                const data = [];
                cards.forEach((card) => {
                    const id = parseInt(card.dataset.dealerId);
                    const lat = parseFloat(card.dataset.lat);
                    const lng = parseFloat(card.dataset.lng);
                    if (!isNaN(id)) {
                        data.push({ id, lat, lng });
                    }
                });
                this.addMarkers(data);
            },

            addMarkers(dealerData) {
                this.clearMarkers();

                if (!dealerData || !dealerData.length) return;

                dealerData.forEach((dealer) => {
                    const lat = parseFloat(dealer.latitude ?? dealer.lat);
                    const lng = parseFloat(dealer.longitude ?? dealer.lng);
                    if (!lat || !lng || isNaN(lat) || isNaN(lng)) return;

                    const color = this.getColor(dealer.service_level);
                    const icon = (dealer.type === 'Unox Office')
                        ? this.makeIcon(color, '&#9733;', 32, 4)
                        : this.makeIcon(color, 'D', 28, 50);

                    const marker = L.marker([lat, lng], { icon })
                        .addTo(this.map)
                        .bindPopup(this.popupHtml(dealer));

                    marker.dealerId = dealer.id;
                    this.markers.push(marker);
                });
            },

            getColor(level) {
                const colors = { Platinum: '#7c3aed', Gold: '#d97706', Silver: '#6b7280', Authorized: '#475569' };
                return colors[level] || '#475569';
            },

            makeIcon(color, text, size, radius) {
                return L.divIcon({
                    className: 'custom-marker',
                    html: `<div style="background:${color};width:${size}px;height:${size}px;border-radius:${radius === 50 ? '50%' : radius + 'px'};border:2px solid white;box-shadow:0 2px 6px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;color:white;font-size:${size * 0.43}px;font-weight:bold;">${text}</div>`,
                    iconSize: [size, size],
                    iconAnchor: [size / 2, size / 2],
                    popupAnchor: [0, -size / 2],
                });
            },

            escapeHtml(str) {
                const div = document.createElement('div');
                div.textContent = str;
                return div.innerHTML;
            },

            popupHtml(dealer) {
                const name = this.escapeHtml(dealer.name || '');
                const type = this.escapeHtml(dealer.type || '');
                const level = this.escapeHtml(dealer.service_level || '');
                const address = this.escapeHtml(dealer.address || '');
                const phone = this.escapeHtml(dealer.phone || '');
                const website = this.escapeHtml(dealer.website || '');

                let h = '<strong>' + name + '</strong><br>';
                h += '<small>' + type + ' &middot; ' + level + '</small><br>';
                if (address) h += address + '<br>';
                if (phone) h += '<a href="tel:' + phone + '">' + phone + '</a><br>';
                if (website) h += '<a href="' + website + '" target="_blank" rel="noreferrer">Website</a>';
                return h;
            },

            focusDealer(id, lat, lng) {
                const latitude = parseFloat(lat);
                const longitude = parseFloat(lng);

                if (latitude && longitude && !isNaN(latitude) && !isNaN(longitude)) {
                    this.map.setView([latitude, longitude], 15);
                    const marker = this.markers.find((m) => m.dealerId === parseInt(id));
                    if (marker) marker.openPopup();
                }

                document.querySelectorAll('.dealer-card').forEach((el) => el.classList.remove('active'));
                const card = document.querySelector('.dealer-card[data-dealer-id="' + id + '"]');
                if (card) {
                    card.classList.add('active');
                    card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            },

            clearMarkers() {
                this.markers.forEach((m) => this.map.removeLayer(m));
                this.markers = [];
            },
        };
    }
</script>
@endpush
