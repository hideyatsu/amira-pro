#!/bin/bash

# Fix permissions for Laravel storage and cache directories
if [ -d "/var/www/html/storage" ]; then
    chmod -R 775 /var/www/html/storage
fi

if [ -d "/var/www/html/bootstrap/cache" ]; then
    chmod -R 775 /var/www/html/bootstrap/cache
fi

# Execute the original command
exec "$@"
