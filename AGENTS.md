# AGENTS.md - Developer Guidelines for Statamic Passport

This is a Statamic addon that provides a UI for managing Laravel Passport clients and personal tokens.

---

## Build / Lint / Test Commands

### PHP Dependencies
```bash
# Install PHP dependencies
composer install

# Update dependencies
composer update
```

### Frontend Assets (Vue 2)
```bash
# Development server with hot reload
npm run dev

# Production build
npm run build
```

### Testing
- **No tests currently exist** in this repository
- Pest PHP is configured as a dependency (allowed in composer.json)
- When tests are added, run all tests:
  ```bash
  ./vendor/bin/pest
  ```
- Run a single test file:
  ```bash
  ./vendor/bin/pest tests/Unit/ExampleTest.php
  ```
- Run tests matching a pattern:
  ```bash
  ./vendor/bin/pest --filter="test_something"
  ```

---

## Code Style Guidelines

### PHP (Laravel/Statamic)

#### Naming Conventions
- **Classes**: PascalCase (e.g., `PassportController`)
- **Methods**: camelCase (e.g., `index()`, `createToken()`)
- **Properties**: camelCase (e.g., `$this->tokens`)
- **Constants**: SCREAMING_SNAKE_CASE
- **Files**: PascalCase for class files, kebab-case otherwise

#### File Organization
- PSR-4 autoloading: `Tv2regionerne\StatamicPassport\` maps to `src/`
- Follow Laravel directory structure: `src/Http/Controllers/CP/`
- Service providers extend `Statamic\Providers\AddonServiceProvider`

#### Coding Patterns
```php
// Use strict types
<?php

namespace Tv2regionerne\StatamicPassport;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\CP\CpController;

class PassportController extends CpController
{
    public function index(Request $request)
    {
        $this->authorize('manage passport', [], __('You are not authorized to manage Passport.'));

        return view('statamic-passport::index');
    }
}
```

#### Error Handling
- Use `$this->authorize()` for authorization checks
- Use Laravel localization with `__('key')` for translatable strings
- Pass error messages to views or return JSON responses

#### Imports
- Group imports: Laravel, Statamic, then custom/other
- Use Facades when available
- Sort alphabetically within groups

---

### Vue 2 (Frontend)

#### Component Structure
- Use Options API (not Composition API - this is Vue 2)
- Define `data()`, `components`, `mounted()`, `methods` in that order

```javascript
export default {
    components: {
        TokenForm,
        TokenView,
    },

    data() {
        return {
            initializing: true,
            tokens: [],
        }
    },

    mounted() {
        this.loadTokens();
    },

    methods: {
        loadTokens() {
            this.$axios.get(url)
                .then(response => {
                    this.tokens = response.data;
                })
                .catch(e => {
                    this.$toast.error(e.response?.data.message ?? __('Something went wrong'));
                })
        },
    },
}
```

#### Naming
- Components: PascalCase (e.g., `TokenListing.vue`)
- Props/events: kebab-case in templates, camelCase in JS

#### HTTP Requests
- Use `$axios` (provided by Statamic)
- Handle errors with toast notifications
- Use helper functions like `passport_url()` for API endpoints

---

### Blade Templates
- Use standard Laravel Blade syntax
- Use `{{ __('translatable string') }}` for i18n
- Follow Statamic's conventions for addon views

---

## Project Structure

```
statamic-passport/
├── src/
│   ├── ServiceProvider.php          # Main addon service provider
│   └── Http/
│       └── Controllers/CP/
│           └── PassportController.php
├── resources/
│   ├── js/
│   │   ├── addon.js                 # Entry point, registers components
│   │   └── components/
│   │       ├── clients/             # OAuth client management
│   │       │   ├── Form.vue
│   │       │   └── Listing.vue
│   │       └── tokens/              # Personal token management
│   │           ├── Form.vue
│   │           ├── Listing.vue
│   │           └── View.vue
│   └── views/
│       └── index.blade.php           # Main CP view
├── routes/
│   └── cp.php                       # CP route definitions
├── composer.json
├── package.json
└── vite.config.js
```

---

## Key Patterns & Conventions

### Statamic Integration
- Addon namespace: `statamic-passport::` for views
- Register navigation via `Nav::extend()` in `bootAddon()`
- Register permissions via `Permission::extend()`
- Pass config to frontend via `Statamic::provideToScript()`

### Vue Component Registration
```javascript
Statamic.booting(() => {
    Statamic.component('passport-client-listing', ClientListing);
    Statamic.component('passport-token-listing', TokenListing);
});
```

### Route Helpers
- Use `passport_url()` helper to build API URLs:
```javascript
this.$axios.get(passport_url('personal-access-tokens'))
```

---

## Development Notes

- This addon is compatible with Statamic 4.x and 5.x
- Requires Laravel Passport 8-13
- No tests currently exist - consider adding Pest tests for any new functionality
- Frontend uses Vue 2 (not Vue 3) due to Statamic compatibility
