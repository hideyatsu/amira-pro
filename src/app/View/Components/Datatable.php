<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Datatable extends Component
{
    public string $id;
    public array $heads;
    public bool $striped;
    public bool $hoverable;
    public bool $condensed;
    public bool $bordered;
    public array $tableData;
    public bool $serverSide;

    /**
     * Configuration array for Datatable options.
     */
    public array $config;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $id = null,
        array $heads,
        array $data = [],
        bool $serverSide = false,
        array $config = [], // Accept config array
        bool $striped = true,
        bool $hoverable = true,
        bool $condensed = true,
        bool $bordered = true
    ) {
        $this->id = $id ?? 'datatable-' . uniqid(); // Set default ID if not provided
        $this->heads = $heads;
        $this->tableData = $data;
        $this->serverSide = $serverSide;
        $this->striped = $striped;
        $this->hoverable = $hoverable;
        $this->condensed = $condensed;
        $this->bordered = $bordered;

        // Set configuration array
        $defaultConfig = [
            'columns' => [],
            'order' => [[0, 'asc']],
            'buttons' => [],
            'paging' => true,
            'searching' => true,
            'responsive' => true,
        ];

        // Merge user-provided config with defaults
        $this->config = array_merge($defaultConfig, $config);
        // Validate that if serverSide is true, ajax URL must be provided
        if ($this->serverSide && !isset($this->config['ajax'])) {
            throw new \InvalidArgumentException("When 'serverSide' is true, 'ajax' URL must be provided in the config array.");
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.datatable');
    }
}
