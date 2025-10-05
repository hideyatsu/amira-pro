# HasPermissionMiddleware Trait

This trait provides reusable middleware functionality for Laravel controllers with permission-based access control.

## Features

- Base authentication middleware
- Resource-specific permission middleware
- Custom permission middleware support
- Flexible middleware combinations

## Usage Examples

### Basic Resource Controller

For a standard resource controller (like UserController, PostController, etc.):

```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasPermissionMiddleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller implements HasMiddleware
{
    use HasPermissionMiddleware;

    public static function middleware(): array
    {
        return static::getResourceMiddleware('posts');
    }
}
```

This will automatically apply:
- `auth` and `verified` middleware
- `can:view posts` for `index` and `show` actions
- `can:create posts` for `create` and `store` actions
- `can:edit posts` for `edit` and `update` actions
- `can:delete posts` for `destroy` action

### Controller with Basic Auth Only

For controllers that only need authentication without specific permissions:

```php
class DashboardController extends Controller implements HasMiddleware
{
    use HasPermissionMiddleware;

    public static function middleware(): array
    {
        return static::getBaseMiddleware();
    }
}
```

### Controller with Custom Permissions

For controllers with custom permission requirements:

```php
class ReportController extends Controller implements HasMiddleware
{
    use HasPermissionMiddleware;

    public static function middleware(): array
    {
        return array_merge(
            static::getBaseMiddleware(),
            [
                static::getCustomPermissionMiddleware('view reports', ['index', 'show', 'export']),
                static::getCustomPermissionMiddleware('manage reports', ['create', 'store', 'destroy']),
            ]
        );
    }
}
```

### Controller with Additional Middleware

For controllers that need extra middleware beyond permissions:

```php
class ApiController extends Controller implements HasMiddleware
{
    use HasPermissionMiddleware;

    public static function middleware(): array
    {
        return static::getResourceMiddleware('api-data', [
            'throttle:api',
            'api.key'
        ]);
    }
}
```

## Available Methods

### `getBaseMiddleware(): array`
Returns the base middleware array: `['auth', 'verified']`

### `getPermissionMiddleware(string $resource): array`
Returns permission middleware for a resource with standard CRUD actions.

### `getResourceMiddleware(string $resource, array $additionalMiddleware = []): array`
Returns complete middleware combining base + permissions + additional middleware.

### `getCustomPermissionMiddleware(string $permission, array $actions): Middleware`
Returns a single permission middleware for specific actions.

## Permission Naming Convention

The trait expects permissions to follow this naming pattern:
- `view {resource}` - for viewing/listing resources
- `create {resource}` - for creating new resources
- `edit {resource}` - for editing existing resources
- `delete {resource}` - for deleting resources

Make sure your permission system uses these naming conventions or adjust the trait accordingly.
