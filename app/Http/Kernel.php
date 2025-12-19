</php
protected $routeMiddleware = [
    // ...
    'admin' => \App\Http\Middleware\IsAdmin::class,
];
