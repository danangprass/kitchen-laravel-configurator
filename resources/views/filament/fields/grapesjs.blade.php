@php
    $fieldWrapperView = $getFieldWrapperView();
    $isDisabled = $isDisabled();
    $minHeight = $getMinHeight();
    $statePath = $getStatePath();
    $tools = $getTools();
    $plugins = $getPlugins();
    $settings = $getSettings();
    $htmlData = $getHtmlData();

    $blocks = [
        ['id' => 'heading', 'label' => 'Heading', 'category' => 'Basic', 'content' => '<h2 class="text-2xl font-bold text-gray-900">Your heading here</h2>'],
        ['id' => 'paragraph', 'label' => 'Paragraph', 'category' => 'Basic', 'content' => '<p class="text-base text-gray-700 leading-relaxed">Your text here. Write something interesting for your readers.</p>'],
        ['id' => 'image', 'label' => 'Image', 'category' => 'Basic', 'content' => '<img src="https://placehold.co/800x400/e2e8f0/475569?text=Image" alt="Placeholder" class="w-full rounded-lg" />'],
        ['id' => 'button', 'label' => 'Button', 'category' => 'Basic', 'content' => '<a href="#" class="inline-block bg-gray-900 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors">Click me</a>'],
        ['id' => 'quote', 'label' => 'Quote', 'category' => 'Basic', 'content' => '<blockquote class="border-l-4 border-gray-300 pl-4 italic text-gray-600 my-4"><p>&#34;A great quote goes here.&#34;</p><footer class="text-sm text-gray-500 mt-2">&#8212; Author Name</footer></blockquote>'],
        ['id' => 'divider', 'label' => 'Divider', 'category' => 'Basic', 'content' => '<hr class="my-8 border-gray-200" />'],
        ['id' => 'two-columns', 'label' => 'Two Columns', 'category' => 'Layout', 'content' => '<div class="grid grid-cols-2 gap-6"><div><h3 class="text-lg font-semibold mb-2">Left Column</h3><p class="text-gray-600">Content for the left column.</p></div><div><h3 class="text-lg font-semibold mb-2">Right Column</h3><p class="text-gray-600">Content for the right column.</p></div></div>'],
        ['id' => 'three-columns', 'label' => 'Three Columns', 'category' => 'Layout', 'content' => '<div class="grid grid-cols-3 gap-6"><div><h4 class="font-semibold mb-2">Column 1</h4><p class="text-sm text-gray-600">Description here.</p></div><div><h4 class="font-semibold mb-2">Column 2</h4><p class="text-sm text-gray-600">Description here.</p></div><div><h4 class="font-semibold mb-2">Column 3</h4><p class="text-sm text-gray-600">Description here.</p></div></div>'],
        ['id' => 'card', 'label' => 'Card', 'category' => 'Layout', 'content' => '<div class="bg-white rounded-xl shadow-md p-6"><h4 class="font-semibold text-lg mb-2">Card Title</h4><p class="text-gray-600 text-sm">Card description goes here with supporting text.</p></div>'],
        ['id' => 'video', 'label' => 'Video', 'category' => 'Media', 'content' => '<div class="relative w-full aspect-video"><iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" class="absolute inset-0 w-full h-full rounded-lg" frameborder="0" allowfullscreen></iframe></div>'],
    ];
@endphp

@once
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/grapesjs@0.22.8/dist/css/grapes.min.css">
    @endpush
    @push('scripts')
        <script src="https://unpkg.com/grapesjs@0.22.8/dist/grapes.min.js"></script>
    @endpush
@endonce

<x-dynamic-component
    :component="$fieldWrapperView"
    :field="$field"
>
    <div
        wire:ignore
        x-data="{
            init() {
                var el = this.$el;
                var containerId = 'gjs_{{ $getId() }}';
                var state = $wire.{{ $applyStateBindingModifiers('entangle(\'' . $statePath . '\')') }};

                var boot = function() {
                    if (el.__gjsBooted) return;
                    if (!window.grapesjs) { setTimeout(boot, 50); return; }
                    el.__gjsBooted = true;

                    var blocks = @js($blocks);

                    var instance = grapesjs.init({
                        height: (@js($minHeight) || 768) + 'px',
                        container: '#' + CSS.escape(containerId),
                        showOffsets: true,
                        fromElement: false,
                        noticeOnUnload: false,
                        storageManager: false,
                        plugins: @js($plugins) || [],
                        components: @js($htmlData) ? @js($htmlData) : '<div></div>',
                    });

                    blocks.forEach(function(b) {
                        instance.Blocks.add(b.id, {
                            label: b.label,
                            category: b.category,
                            content: b.content,
                        });
                    });

                    instance.on('update', function() {
                        var html = instance.getHtml({ cleanId: true });
                        var extract = html.match(/<body\b[^>]*>([\s\S]*?)<\/body>/i);
                        var body = extract ? extract[1] : html;
                        state = body;
                        $wire.set('{{ $statePath }}', body);
                    });

                    el.__gjsInstance = instance;
                };

                setTimeout(boot, 200);
            },
            destroy() {
                if (this.$el.__gjsInstance) {
                    this.$el.__gjsInstance.destroy();
                    this.$el.__gjsInstance = null;
                }
            },
        }"
    >
        <div id="gjs_{{ $getId() }}" class="grapesjs-wrapper">
            {!! $htmlData !!}
        </div>
    </div>
</x-dynamic-component>
