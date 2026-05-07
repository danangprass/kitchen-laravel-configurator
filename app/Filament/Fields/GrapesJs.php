<?php

namespace App\Filament\Fields;

use Closure;
use Filament\Forms\Components\Field;

class GrapesJs extends Field
{
    protected string $view = 'filament.fields.grapesjs';

    protected int|Closure|null $minHeight = 768;

    protected array|Closure $tools = [];

    protected array|Closure $plugins = [];

    protected array|Closure $settings = [];

    public function minHeight(int|Closure|null $height): static
    {
        $this->minHeight = $height;

        return $this;
    }

    public function getMinHeight(): ?int
    {
        return $this->evaluate($this->minHeight);
    }

    public function tools(array|Closure $tools): static
    {
        $this->tools = $tools;

        return $this;
    }

    public function getTools(): array
    {
        return $this->evaluate($this->tools);
    }

    public function plugins(array|Closure $plugins): static
    {
        $this->plugins = $plugins;

        return $this;
    }

    public function getPlugins(): array
    {
        return $this->evaluate($this->plugins);
    }

    public function settings(array|Closure $settings): static
    {
        $this->settings = $settings;

        return $this;
    }

    public function getSettings(): array
    {
        return $this->evaluate($this->settings);
    }

    public function getHtmlData(): string
    {
        return $this->evaluate($this->getState()) ?? '';
    }
}
