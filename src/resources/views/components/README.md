# Tabler Blade Components

Reusable Blade components for building admin forms and UI with the Tabler design system.

This document lists available components, their main props, and short usage examples.

---

## Available components

1. Card — `<x-card>`
2. Form input — `<x-form.input>`
3. Select — `<x-form.select>`
4. Textarea — `<x-form.textarea>`
5. Checkbox — `<x-form.checkbox>`
6. Radio — `<x-form.radio>`
7. Button — `<x-button>`
8. Form group — `<x-form.group>`
9. Icon — `<x-icon>`

Each component is kept small and composable so you can combine them to build complex forms and panels.

---

## Quick reference

### Card — `<x-card>`
Simple card wrapper with optional header slot or `title` prop.

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
