<div>
    @forelse($sections as $section)
        @if(in_array($section->type, $allowedTypes))
            @includeIf('partials.homepage.' . $section->type, ['section' => $section])
        @endif
    @empty
        <div class="min-h-[60vh] flex items-center justify-center bg-warm-white-500">
            <div class="text-center">
                <span class="inline-block text-midnight-500 font-semibold text-xs tracking-widest uppercase mb-4">Homepage</span>
                <h2 class="font-display font-bold text-3xl text-midnight-500 mb-3">Coming Soon</h2>
                <p class="text-charcoal-400">Our new homepage is being prepared. Add sections in the admin panel to get started.</p>
            </div>
        </div>
    @endforelse
</div>
