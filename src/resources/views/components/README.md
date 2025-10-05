# Tabler Blade Components

Reusable Blade components for building admin forms and UI with the Tabler design system.

This document lists available components, their main props, and short usage examples.

---

## Components Overview

### Form Components

1. **Input** (`<x-form.input>`)
   - Text, email, password, and other input types
   - Validation states and error handling
   - Optional icons and hints

2. **Select** (`<x-form.select>`)
   - Dropdown selections with options array
   - Multiple selection support
   - Placeholder and validation

3. **Textarea** (`<x-form.textarea>`)
   - Multi-line text input
   - Configurable rows and validation
   - Character limits and hints

4. **Checkbox** (`<x-form.checkbox>`)
   - Single checkbox input
   - Custom values and labels
   - Validation support

5. **Radio** (`<x-form.radio>`)
   - Radio button input
   - Individual radio elements
   - Grouping support

6. **Group** (`<x-form.group>`)
   - Form field wrapper with horizontal layout
   - Label positioning and validation
   - Consistent spacing

7. **Toggle** (`<x-form.toggle>`)
   - Switch-style toggle inputs
   - Various sizes and states
   - Descriptions and validation

8. **File Upload** (`<x-form.file-upload>`)
   - Single and multiple file uploads
   - Drag & drop support (dropzone)
   - File type restrictions

9. **Input Group** (`<x-form.input-group>`)
   - Inputs with prepend/append elements
   - Text and button addons
   - Flexible content slots

10. **Range** (`<x-form.range>`)
    - Range slider inputs
    - Min/max values and steps
    - Real-time value display

11. **Color Picker** (`<x-form.color-picker>`)
    - Color selection input
    - Preset color palette
    - Hex value display

12. **Tags Input** (`<x-form.tags-input>`)
    - Multiple tag selection
    - Dynamic tag creation
    - Customizable separators

13. **Date Picker** (`<x-form.date-picker>`)
    - Date selection input
    - Inline calendar view
    - Date range restrictions

14. **Select Group** (`<x-form.select-group>`)
    - Visual selection groups
    - Icon and text combinations
    - Multiple styles (pills, buttons)

15. **Input Mask** (`<x-form.input-mask>`)
    - Formatted input patterns
    - Common mask presets (phone, date, etc.)
    - Custom mask definitions

### UI Components

16. **Card** (`<x-card>`)
    - Content containers with headers
    - Flexible body and footer areas
    - Custom styling options

17. **Button** (`<x-button>`)
    - Various button styles and sizes
    - Loading states and icons
    - Type and variant support

18. **Icon** (`<x-icon>`)
    - SVG icon renderer
    - Built-in icon library
    - Customizable size and color

19. **Progress** (`<x-progress>`)
    - Progress bar indicators
    - Multiple colors and styles
    - Striped and animated options

Each component is kept small and composable so you can combine them to build complex forms and panels.

---

## Quick reference

### Card — `<x-card>`
Simple card wrapper with optional header slot or `title` prop.

```blade
## Usage Examples

All examples use Laravel Blade syntax:

### Advanced Form Elements

#### Toggle Switches — `<x-form.toggle>`
```blade
<x-form.toggle 
    name="notifications" 
    label="Push Notifications" 
    description="Enable push notifications for this account"
    :checked="true" 
/>

<x-form.toggle 
    name="sms" 
    label="SMS Notifications" 
    size="sm"
/>
```

#### Input Groups — `<x-form.input-group>`
```blade
<x-form.input-group 
    name="website"
    label="Website URL"
    prepend="https://"
    append=".com"
    placeholder="yoursite"
/>
```

#### Input Masks — `<x-form.input-mask>`
```blade
<x-form.input-mask 
    name="phone"
    label="Phone Number"
    mask="phone"
/>

<x-form.input-mask 
    name="custom_mask"
    label="Custom Format"
    mask="99-AAA-999"
/>
```

#### Range Sliders — `<x-form.range>`
```blade
<x-form.range 
    name="volume"
    label="Volume"
    :min="0"
    :max="100"
    :value="50"
/>
```

#### Color Picker — `<x-form.color-picker>`
```blade
<x-form.color-picker 
    name="primary_color"
    label="Primary Color"
    value="#206bc4"
/>
```

#### Select Groups — `<x-form.select-group>`
```blade
<x-form.select-group 
    name="language"
    label="Programming Language"
    :options="[
        'html' => ['text' => 'HTML', 'icon' => 'code'],
        'css' => ['text' => 'CSS', 'icon' => 'palette'],
        'js' => ['text' => 'JavaScript', 'icon' => 'brand-javascript']
    ]"
    style="pills"
/>
```

#### File Upload — `<x-form.file-upload>`
```blade
<x-form.file-upload 
    name="documents"
    label="Documents"
    :multiple="true"
    accept=".pdf,.doc,.docx"
    :dropzone="true"
/>
```

#### Date Picker — `<x-form.date-picker>`
```blade
<x-form.date-picker 
    name="start_date"
    label="Start Date"
    value="{{ date('Y-m-d') }}"
/>

<x-form.date-picker 
    name="inline_date"
    label="Choose Date"
    :inline="true"
/>
```

#### Tags Input — `<x-form.tags-input>`
```blade
<x-form.tags-input 
    name="skills"
    label="Skills"
    :value="['Laravel', 'Vue.js', 'PHP']"
    placeholder="Add skills..."
/>
```

#### Progress Indicators — `<x-progress>`
```blade
<x-progress :value="38" label="Profile Completion" />
<x-progress :value="72" color="success" :striped="true" />
<x-progress :value="45" color="warning" :animated="true" size="sm" />
```

### Basic Components

#### Card — `<x-card>`
Basic card layout with optional header slot.

```blade
<x-card title="Card title">Content</x-card>

<x-card>
    <x-slot name="header">
        <h3 class="card-title">Custom header</h3>
    </x-slot>
    Content
</x-card>
```

Props: `title`, `headerClass`, `bodyClass`, `cardClass`.

### Input — `<x-form.input>`
Text-like input with label, icon slot, hint and built-in error rendering.

```blade
<x-form.input name="email" type="email" label="Email" placeholder="you@example.com" required />

<x-form.input name="username" placeholder="Username">
    <x-slot name="icon"><x-icon name="user"/></x-slot>
</x-form.input>
```

Main props: `name`, `type`, `label`, `placeholder`, `required`, `value`, `hint`.

### Select — `<x-form.select>`
Accepts an `:options` array or manual `<option>` slots. Supports optgroups.

```blade
<x-form.select name="country" :options="['id'=>'Indonesia','us'=>'United States']" />

<x-form.select name="region" :options="['Asia'=>['id'=>'Indonesia']]" />
```

### Textarea — `<x-form.textarea>`
Simple textarea with label, rows and error handling.

```blade
<x-form.textarea name="bio" label="Biography" rows="4" />
```

### Checkbox & Radio
Use `<x-form.checkbox>` and `<x-form.radio>` for labelled controls.

```blade
<x-form.checkbox name="active" label="Active" />
<x-form.radio name="gender" value="male" label="Male" />
```

### Button — `<x-button>`
Flexible button component with variants, icon slot and loading state.

```blade
<x-button variant="primary" type="submit">Save</x-button>

<x-button variant="primary" loading>Saving...</x-button>
```

Props: `type`, `variant`, `size`, `iconPosition`, `loading`, `disabled`, `fullWidth`.

### Form group — `<x-form.group>`
Helper for horizontal form rows (label + control) used in larger forms.

### Icon — `<x-icon>`
SVG icon helper with a small preset. You can also pass custom SVG via slot.

```blade
<x-icon name="mail" />
<x-icon> <path d="..."/> </x-icon>
```

---

## Example: user form

```blade
@extends('layouts.admin')

@section('content')
<div class="container-xl">
    <x-card title="Create User">
        <form method="POST" action="{{ route('users.store') }}">@csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <x-form.input name="first_name" label="First name" required />
                </div>
                <div class="col-md-6">
                    <x-form.input name="last_name" label="Last name" required />
                </div>
            </div>

            <x-form.input name="email" type="email" label="Email" required>
                <x-slot name="icon"><x-icon name="mail"/></x-slot>
            </x-form.input>

            <x-form.select name="role" :options="['admin'=>'Admin','user'=>'User']" required />

            <div class="text-end">
                <x-button variant="outline-secondary">Cancel</x-button>
                <x-button type="submit" variant="primary">Create</x-button>
            </div>
        </form>
    </x-card>
</div>
@endsection
```

---

## Tips

- Errors are displayed automatically from Laravel `$errors`.
- Inputs use `old()` for previous values.
- Add classes or attributes via the component `class` and attribute bag.
- Combine components and raw HTML as needed.

If you want, I can:

- Add a few more icon presets, or
- Convert some components to Blade class components with typed props.

Tell me which and I’ll implement it next.
