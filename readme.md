### Generate Reset Password Observer

#### Usage

Append observer to model boot method:

```php
    public static function boot()
    {
        parent::boot();

        User::observe(app(GenerateResetPasswordTokenObserver::class));
    }
```

In the model should be `reset_password_token` field