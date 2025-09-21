<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DefaultButtonsTable extends Component
{
    public string $editRoute;
    public string $deleteRoute;
    public string|null $deactivateRoute;
    public mixed $model;

    /**
     * Create a new component instance.
     */
    public function __construct(
        mixed $model,
        string $editRoute,
        string $deleteRoute,
        ?string $deactivateRoute = null
    ) {
        $this->model = $model;
        $this->editRoute = $editRoute;
        $this->deleteRoute = $deleteRoute;
        $this->deactivateRoute = $deactivateRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.default-buttons-table');
    }
}
