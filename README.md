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

This toast notification is displayed to users when they attempt to save. 

<img width="825" height="78" alt="CP locked message" src="https://github.com/user-attachments/assets/9ad384cf-7008-413e-b2bd-b35dd8eb45ef" />


If they wait (and don't refresh or navigate away from the current page), they can save as normal once the control panel is unlocked. 

Users are not notified of the locking occuring - only when the try to save. 

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
