<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Select2 extends Component
{
    public string $id;
    public string $name;
    public ?string $label;
    public ?string $placeholder;
    public bool $multiple;
    public bool $required;
    public array|string|null $selected;
    public array $options;
    public ?string $hint;
    public bool $serverside;
    public ?string $ajax;
    public ?string $ajaxMethod;
    public int $minimumInputLength;
    public bool $allowClear;
    public bool $tags;
    public ?string $width;
    public ?string $theme;
    public array $additionalConfig;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        ?string $id = null,
        ?string $label = null,
        ?string $placeholder = null,
        bool $multiple = false,
        bool $required = false,
        array|string|null $selected = null,
        array $options = [],
        ?string $hint = null,
        bool $serverside = false,
        ?string $ajax = null,
        ?string $ajaxMethod = 'GET',
        int $minimumInputLength = 0,
        bool $allowClear = true,
        bool $tags = false,
        ?string $width = '100%',
        ?string $theme = 'bootstrap-5',
        array $additionalConfig = []
    ) {
        $this->name = $name;
        $this->id = $id ?? $name;
        $this->label = $label;
        $this->placeholder = $placeholder ?? __('Select an option');
        $this->multiple = $multiple;
        $this->required = $required;
        $this->selected = $selected;
        $this->options = $options;
        $this->hint = $hint;
        $this->serverside = $serverside;
        $this->ajax = $ajax;
        $this->ajaxMethod = $ajaxMethod;
        $this->minimumInputLength = $minimumInputLength;
        $this->allowClear = $allowClear;
        $this->tags = $tags;
        $this->width = $width;
        $this->theme = $theme;
        $this->additionalConfig = $additionalConfig;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.select2');
    }

    /**
     * Get the select2 configuration as JSON.
     */
    public function getConfig(): string
    {
        $config = [
            'placeholder' => $this->placeholder,
            'allowClear' => $this->allowClear,
            'width' => $this->width,
            'theme' => $this->theme,
            'tags' => $this->tags,
        ];

        // Server-side configuration
        if ($this->serverside && $this->ajax) {
            $config['ajax'] = [
                'url' => $this->ajax,
                'type' => $this->ajaxMethod,
                'dataType' => 'json',
                'delay' => 250,
                'data' => 'function (params) {
                    return {
                        q: params.term,
                        page: params.page || 1
                    };
                }',
                'processResults' => 'function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.results,
                        pagination: {
                            more: (params.page * 10) < data.total
                        }
                    };
                }',
                'cache' => true
            ];
            $config['minimumInputLength'] = $this->minimumInputLength;
        }

        // Merge additional configuration
        $config = array_merge($config, $this->additionalConfig);

        // Convert to JSON with special handling for functions
        $json = json_encode($config, JSON_PRETTY_PRINT);

        // Replace quoted function strings with actual functions
        $json = preg_replace('/"function \((.*?)\) \{(.*?)\}"/', 'function ($1) {$2}', $json);

        return $json;
    }

    /**
     * Check if a value is selected.
     */
    public function isSelected(string|int $value): bool
    {
        if (is_null($this->selected)) {
            return false;
        }

        if (is_array($this->selected)) {
            return in_array($value, $this->selected);
        }

        return $this->selected == $value;
    }
}
