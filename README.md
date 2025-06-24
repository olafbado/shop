## Admin Dashboard Functionality

The admin dashboard allows users with the `admin` role to manage all aspects of the shop. To access, log in as an admin and go to `/admin/dashboard`.

### Modules

-   **Users:** List, search, edit roles, activate/deactivate users.
-   **Products:** Full CRUD, filter by name/category/availability, toggle active status.
-   **Categories:** Create/list categories, assign/unassign products.
-   **Orders:** View all orders with user and product details (read-only).
-   **Reviews:** List, hide, or delete product reviews.

### Interface

-   Built with Bootstrap for a clean UI.
-   Sidebar navigation for modules.
-   Tables with pagination and search.
-   Modals/pages for editing.
-   Bootstrap toasts/alerts for feedback.

### Access

-   Log in as admin at `/login`.
-   Example seeded admin: `admin@admin` / `admin`

### Tests

-   Feature tests for admin access, product management, user deactivation, and product filtering are in `tests/Feature/Admin/`.
-   Run tests with:

```bash
php artisan test --testsuite=Feature
```

### Directory Structure

-   Views: `resources/views/admin/`
-   Controllers: `app/Http/Controllers/Admin/`
-   Routes: grouped under `admin` middleware in `routes/web.php`
