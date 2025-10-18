# Select2 Component Documentation

## Overview
Robust Select2 component for Laravel that supports both client-side and server-side (AJAX) data loading with full Bootstrap 5 and Tabler integration.

## Installation
The Select2 library files are already downloaded to:
- `/public/vendor/select2/select2.min.css`
- `/public/vendor/select2/select2.min.js`

## Basic Usage

### Client-Side (Static Options)

```blade
<x-select2
    name="country"
    label="Select Country"
    placeholder="Choose a country..."
    :options="[
        'us' => 'United States',
        'uk' => 'United Kingdom',
        'id' => 'Indonesia',
        'sg' => 'Singapore'
    ]"
    :selected="old('country', 'id')"
/>
```

### Multiple Selection

```blade
<x-select2
    name="roles"
    label="Assign Roles"
    :multiple="true"
    :options="$roles->pluck('name', 'id')->toArray()"
    :selected="old('roles', $user->roles->pluck('id')->toArray())"
    hint="You can select multiple roles"
/>
```

### Server-Side (AJAX)

```blade
<x-select2
    name="user_id"
    label="Select User"
    placeholder="Search for users..."
    :serverside="true"
    ajax="{{ route('api.select2.users') }}"
    :minimum-input-length="2"
    hint="Type at least 2 characters to search"
/>
```

### With Tags (Allow Custom Values)

```blade
<x-select2
    name="tags"
    label="Tags"
    :multiple="true"
    :tags="true"
    :options="$existingTags"
    placeholder="Add or select tags..."
/>
```

## Component Properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `name` | string | *required* | Form field name |
| `id` | string | `$name` | Element ID |
| `label` | string | null | Label text |
| `placeholder` | string | "Select an option..." | Placeholder text |
| `multiple` | bool | false | Enable multiple selection |
| `required` | bool | false | Make field required |
| `selected` | array\|string | null | Selected value(s) |
| `options` | array | [] | Options array (value => text) |
| `hint` | string | null | Help text below select |
| `serverside` | bool | false | Enable AJAX/server-side mode |
| `ajax` | string | null | AJAX endpoint URL |
| `ajax-method` | string | 'GET' | AJAX HTTP method |
| `minimum-input-length` | int | 0 | Minimum chars for search |
| `allow-clear` | bool | true | Show clear button |
| `tags` | bool | false | Allow custom tag creation |
| `width` | string | '100%' | Select width |
| `theme` | string | 'bootstrap-5' | Select2 theme |
| `additional-config` | array | [] | Extra Select2 config |

## Server-Side Implementation

### 1. Create API Route

```php
// routes/api.php or routes/web.php
Route::get('/api/select2/users', [Select2Controller::class, 'users'])
    ->name('api.select2.users');
```

### 2. Controller Method (Example provided in Select2Controller.php)

```php
public function users(Request $request): JsonResponse
{
    $search = $request->input('q', '');
    $page = $request->input('page', 1);
    $perPage = 10;

    $query = User::query();

    if (!empty($search)) {
        $query->where('name', 'like', "%{$search}%");
    }

    $total = $query->count();
    $users = $query->skip(($page - 1) * $perPage)
                   ->take($perPage)
                   ->get();

    $results = $users->map(function ($user) {
        return [
            'id' => $user->id,
            'text' => $user->name,
        ];
    });

    return response()->json([
        'results' => $results,
        'total' => $total,
        'pagination' => [
            'more' => ($page * $perPage) < $total
        ]
    ]);
}
```

### 3. Use in Blade

```blade
<x-select2
    name="user_id"
    label="Select User"
    :serverside="true"
    ajax="{{ route('api.select2.users') }}"
    :minimum-input-length="2"
/>
```

## Advanced Examples

### With Grouped Options

```blade
<x-select2
    name="product"
    label="Select Product"
    :options="[
        'Electronics' => [
            'phone' => 'Smartphone',
            'laptop' => 'Laptop'
        ],
        'Clothing' => [
            'shirt' => 'T-Shirt',
            'jeans' => 'Jeans'
        ]
    ]"
/>
```

### Custom Configuration

```blade
<x-select2
    name="status"
    label="Status"
    :options="['active' => 'Active', 'inactive' => 'Inactive']"
    :additional-config="[
        'dropdownParent' => '$(\'#myModal\')',
        'closeOnSelect' => false,
        'maximumSelectionLength' => 3
    ]"
/>
```

### With Pre-selected Server-Side Values

```blade
<x-select2
    name="user_id"
    label="Assigned User"
    :serverside="true"
    ajax="{{ route('api.select2.users') }}"
    :selected="[$user->id => $user->name]"
/>
```

## Styling

The component automatically includes Bootstrap 5 compatible styles and supports:
- Light/Dark mode
- Tabler theme integration
- Responsive design
- Custom validation states

## JavaScript Events

You can listen to Select2 events:

```javascript
$('#your-select-id').on('select2:select', function (e) {
    var data = e.params.data;
    console.log('Selected:', data);
});

$('#your-select-id').on('select2:unselect', function (e) {
    var data = e.params.data;
    console.log('Unselected:', data);
});
```

## Troubleshooting

### Select2 not initializing
- Ensure jQuery is loaded before Select2
- Check browser console for errors
- Verify select2.min.js and select2.min.css are accessible

### AJAX not working
- Check network tab for failed requests
- Verify route exists: `php artisan route:list | grep select2`
- Ensure CSRF token is included for POST requests
- Check controller returns correct JSON format

### Styling issues
- Clear browser cache
- Run `npm run build` to recompile assets
- Check for CSS conflicts with other libraries

## Examples in Project

See usage examples in:
- `/resources/views/admin/users/create.blade.php`
- `/resources/views/admin/users/edit.blade.php`
- `/app/Http/Controllers/Api/Select2Controller.php`
