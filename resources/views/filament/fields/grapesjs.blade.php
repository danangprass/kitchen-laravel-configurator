@php
    $fieldWrapperView = $getFieldWrapperView();
    $isDisabled = $isDisabled();
    $minHeight = $getMinHeight();
    $statePath = $getStatePath();
    $tools = $getTools();
    $plugins = $getPlugins();
    $settings = $getSettings();
    $htmlData = $getHtmlData();
@endphp

@once
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/grapesjs@0.22.8/dist/css/grapes.min.css">
    @endpush
@endonce

<x-dynamic-component
    :component="$fieldWrapperView"
    :field="$field"
>
    <script src="https://unpkg.com/grapesjs@0.22.8/dist/grapes.min.js"></script>

    <div
        wire:ignore
        x-data="{
            booted: false,
            init() {
                var el = this.$el;
                var containerId = 'gjs_{{ $getId() }}';
                var containerSelector = '#' + CSS.escape(containerId);
                var config = {
                    container: containerSelector,
                    state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $statePath . '\')') }},
                    tools: @js($tools),
                    plugins: @js($plugins),
                    settings: @js($settings),
                    minHeight: @js($minHeight),
                };

                // Defer GrapesJS init to let Alpine/Livewire finish booting
                var boot = function() {
                    if (el.__gjsBooted) return;
                    if (!window.grapesjs) { setTimeout(boot, 50); return; }
                    el.__gjsBooted = true;

                    var allSettings = {
                        height: (config.minHeight || 768) + 'px',
                        container: config.container,
                        showOffsets: true,
                        fromElement: true,
                        noticeOnUnload: false,
                        storageManager: false,
                        loadHtml: config.state,
                        plugins: config.plugins || [],
                    };
                    Object.assign(allSettings, config.settings || {});

                    var instance = grapesjs.init(allSettings);
                    instance.on('update', function() {
                        var content = instance.getHtml({ cleanId: true });
                        var extract = content.match(/<body\b[^>]*>([\s\S]*?)<\/body>/);
                        config.state = extract ? extract[1] : instance.getHtml();
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
