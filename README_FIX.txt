Copy these files into your Laravel project:

1. resources/views/admin/create-user.blade.php
   - Fixes the screen still showing password for students.
   - Adds student course/program and section fields.

2. app/Http/Controllers/AdminController.php
   - Your controller already has most of the correct backend logic.

3. app/Http/Controllers/PasswordChangeController.php
   - Same class, but filename casing fixed. On Linux hosting, PasswordchangeController.php can fail with route import PasswordChangeController.

After copying, run:
php artisan optimize:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan migrate
php artisan serve
