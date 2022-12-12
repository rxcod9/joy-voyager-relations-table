# Joy VoyagerRelationsTable

This [Laravel](https://laravel.com/)/[Voyager](https://voyager.devdojo.com/) module adds VoyagerRelationsTable support to Voyager.

By 🐼 [Ramakant Gangwar](https://github.com/rxcod9).

[![Screenshot](https://raw.githubusercontent.com/rxcod9/joy-voyager-relations-table/main/cover.jpg)](https://joy-voyager.kodmonk.com)

[![Latest Version](https://img.shields.io/github/v/release/rxcod9/joy-voyager-relations-table?style=flat-square)](https://github.com/rxcod9/joy-voyager-relations-table/releases)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/rxcod9/joy-voyager-relations-table/run-tests?label=tests)
[![Total Downloads](https://img.shields.io/packagist/dt/joy/voyager-relations-table.svg?style=flat-square)](https://packagist.org/packages/joy/voyager-relations-table)

---

## Prerequisites

*   Composer Installed
*   [Install Laravel](https://laravel.com/docs/installation)
*   [Install Voyager](https://github.com/the-control-group/voyager)

---

## Installation

```bash
# 1. Require this Package in your fresh Laravel/Voyager project
composer require joy/voyager-relations-table

# 2. Publish
php artisan vendor:publish --provider="Joy\VoyagerRelationsTable\VoyagerRelationsTableServiceProvider" --force
```

---

<!-- ## Usage

Installation generates.

--- -->

## Views Customization

In order to override views delivered by Voyager Relations Table, copy contents from ``vendor/joy/voyager-relations-table/resources/views`` to the ``views/vendor/joy-voyager-relations-table`` directory of your Laravel installation.

## Working Example

You can try laravel demo here [https://joy-voyager.kodmonk.com](https://joy-voyager.kodmonk.com).<br/>
Relation route structure is 
```
Route::get($dataType->slug . '/{id}/{relation}-relations-{slug}-table', $breadController.'@index')->name($dataType->slug.'.relations-table');
```
Make sure `{relation}` exists in your model.<br/>
Here are few examples you can check<br/>
[/admin/users/2/role-relations-roles-table](https://joy-voyager.kodmonk.com/admin/users/2/role-relations-roles-table)<br/>
[/admin/users/2/roles-relations-roles-table](https://joy-voyager.kodmonk.com/admin/users/2/roles-relations-roles-table)<br/>
[/admin/roles/1/users-relations-users-table](https://joy-voyager.kodmonk.com/admin/roles/1/users-relations-users-table)

## Documentation

Find yourself stuck using the package? Found a bug? Do you have general questions or suggestions for improving the joy voyager-relations-table? Feel free to [create an issue on GitHub](https://github.com/rxcod9/joy-voyager-relations-table/issues), we'll try to address it as soon as possible.

If you've found a bug regarding security please mail [gangwar.ramakant@gmail.com](mailto:gangwar.ramakant@gmail.com) instead of using the issue tracker.

## Testing

You can run the tests with:

```bash
vendor/bin/phpunit
```

## Upgrading

Please see [UPGRADING](UPGRADING.md) for details.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email [gangwar.ramakant@gmail.com](mailto:gangwar.ramakant@gmail.com) instead of using the issue tracker.

## Credits

- [Ramakant Gangwar](https://github.com/rxcod9)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
