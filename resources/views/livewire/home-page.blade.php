<div>
    @forelse($sections as $section)
        @includeIf('partials.homepage.' . $section->type, ['section' => $section])
    @empty
        <div class="min-h-[60vh] flex items-center justify-center bg-gray-50">
            <div class="text-center">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Coming Soon</h2>
                <p class="text-gray-500">Our new homepage is being prepared.</p>
            </div>
        </div>
    @endforelse
</div>
