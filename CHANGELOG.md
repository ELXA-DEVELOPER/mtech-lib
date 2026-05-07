# Changelog

All notable changes to `shipsfocus-mtech-lib` will be documented in this file

## 2.3.0

- Add PHP 8.4 compatible package constraints via PHP `^8.3`.
- Add Laravel Framework `^13.0` support.
- Update `spatie/laravel-query-builder` to the Laravel 12/13 compatible `^6.4.4` line.
- Update package test dependencies to current Laravel 12/13 compatible versions.
- Fix macro registration closure binding for modern PHP/Laravel runtimes.
- Initialize resource fillable response arrays explicitly.

## 1.1.0

- Add Resource extends from JsonResource.
- Add Router, to use the additional router functions, bind to router singleton:
    ```php
    # bootstrap/app.php
    $app->singleton('router', \MtLib\Router::class);
    ```
- Add various models shared in many projects (Model, QueryBuilder, Macros)
- Add common base controller used in various projects
- Add common file upload controllers
- Add batch update controllers
- Add Blueprint Macros

## 1.0.0

- Add the 4 filters: ExcludeFilter, NumberFilter, RelationalNumberFilter, UserNameFilter.