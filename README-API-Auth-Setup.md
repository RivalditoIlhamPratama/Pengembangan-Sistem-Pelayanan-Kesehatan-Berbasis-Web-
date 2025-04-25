# Laravel Sanctum API Authentication Setup Guide

Follow these steps to set up API authentication using Laravel Sanctum:

1. **Install Sanctum**

Run the following command in your project root:

```
composer require laravel/sanctum
```

2. **Publish Sanctum Configuration and Migrations**

```
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

3. **Run Migrations**

```
php artisan migrate
```

4. **Configure Middleware**

In `app/Http/Kernel.php`, add Sanctum middleware to the `api` middleware group:

```php
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

5. **Update User Model**

In `app/Models/User.php`, add the `HasApiTokens` trait:

```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // ...
}
```

6. **Issue API Tokens**

You can issue tokens to users like this (e.g., in a controller or tinker):

```php
$user = App\Models\User::find(1);
$token = $user->createToken('api-token-name')->plainTextToken;
```

7. **Protect API Routes**

In `routes/api.php`, use the `auth:sanctum` middleware:

```php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Your protected routes here
});
```

8. **Use Tokens in Postman**

-   In Postman, add an `Authorization` header with value: `Bearer {token}`
-   Replace `{token}` with the token generated above.

9. **Adjust Controller Responses**

Make sure your API controllers return JSON responses:

```php
return response()->json(['data' => $data]);
```

---

If you want, I can help you implement these steps in your project files.
