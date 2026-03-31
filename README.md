# CP Lock

> A Statamic addon to temporarily lock the Control Panel, preventing content modifications while still allowing users to browse and view content.

## Requirements

- Statamic 5.x
- PHP 8.2+

## Installation

Add the repository to your `composer.json`:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/wesort/statamic-cp-lock"
    }
]
```

Then install via Composer:

```bash
composer require wesort/statamic-cp-lock
```

## How to Use

The addon provides three CLI commands:

### Lock the Control Panel

```bash
php please cp:lock
```

This prevents users from:
- Saving entries
- Creating new content
- Updating existing content
- Deleting content

Users can still:
- Browse the Control Panel
- View entries
- Navigate all pages

### Unlock the Control Panel

```bash
php please cp:unlock
```

This restores full functionality to the Control Panel.

### Check Lock Status

```bash
php please cp:lock-status
```

Shows the current lock status and when it was locked (if applicable).

## How It Works

- Creates a lock file at `storage/framework/cp_down` when locked
- Middleware intercepts POST, PUT, PATCH, and DELETE requests to CP routes
- GET requests are allowed through for browsing
- Returns appropriate error messages for blocked modification attempts

## Use Cases

- During site migrations or updates
- When performing maintenance that requires read-only access
- When you need to prevent changes while reviewing content
- During client presentations where you want to prevent accidental edits

## License

MIT License. See [LICENSE](LICENSE) for details.

## Credits

Developed by [We Sort](https://wesort.co.uk)
