<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public array $columns;
    public string $ajaxUrl;

    public function __construct(array $columns, string $ajaxUrl)
    {
        $this->columns = $columns;
        $this->ajaxUrl = $ajaxUrl;
    }

    public function render()
    {
        return view('components.data-table');
    }
}
