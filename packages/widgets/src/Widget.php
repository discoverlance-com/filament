<?php

namespace Filament\Widgets;

use Illuminate\Contracts\View\View;
use Livewire\Component;

abstract class Widget extends Component
{
    protected static bool $isDiscovered = true;

    protected static bool $isLazy = true;

    protected static ?int $sort = null;

    /**
     * @var view-string
     */
    protected static string $view;

    /**
     * @var int | string | array<string, int | null>
     */
    protected int | string | array $columnSpan = 1;

    /**
     * @var int | string | array<string, int | null>
     */
    protected int | string | array $columnStart = [];

    public static function canView(): bool
    {
        return true;
    }

    public static function getSort(): int
    {
        return static::$sort ?? -1;
    }

    /**
     * @return int | string | array<string, int | null>
     */
    public function getColumnSpan(): int | string | array
    {
        return $this->columnSpan;
    }

    /**
     * @return int | string | array<string, int | null>
     */
    public function getColumnStart(): int | string | array
    {
        return $this->columnStart;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        return [];
    }

    public static function isDiscovered(): bool
    {
        return static::$isDiscovered;
    }

    public static function isLazy(): bool
    {
        return static::$isLazy;
    }

    public function render(): View
    {
        return view(static::$view, $this->getViewData());
    }

    /**
     * @param  array<string, mixed>  $props
     */
    public static function make(array $props = []): WidgetConfiguration
    {

        return app(WidgetConfiguration::class, ['widget' => static::class, 'props' => $props]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getDefaultProps(): array
    {
        $props = [];

        if (static::isLazy()) {
            $props['lazy'] = true;
        }

        return $props;
    }
}