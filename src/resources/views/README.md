# Laravel Admin Template (Blade)

This is a modular admin panel template for Laravel using Tabler UI. It provides a master layout and reusable partials for fast page creation.

## Structure

- Master layout: `layouts/admin.blade.php`
- Partials: `partials/admin/` (head, header, navigation, footer, scripts, etc.)
- Example pages: `admin/` (dashboard, users)

## Quick Usage

Create a new page:

```blade
@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
        <!-- Your content -->
@endsection
```

Add page CSS/JS:

```blade
@push('page-styles')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endpush

@push('page-scripts')
<script src="{{ asset('js/custom.js') }}"></script>
@endpush
```

## Customization

- Edit navigation in `partials/admin/navigation.blade.php`
- Edit user menu in `partials/admin/user-dropdown.blade.php`
- Edit footer in `partials/admin/footer.blade.php`

## Example Route

```php
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
```

## Tips

- Use Blade sections for page title, actions, breadcrumbs, etc.
- Use `@push` for page-specific assets.
- Add shared data via view composers if needed.
