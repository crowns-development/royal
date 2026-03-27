# Royal

## About

Royal is a Laravel package that installs and enforces Crowns Development coding standards across projects.

It provides a consistent, opinionated development setup including code style rules, static analysis configuration, strict typing enforcement, and project scaffolding utilities.

---

## Features

- Laravel Pint configuration
- PHPStan static analysis configuration
- Strict typing enforcement
- Stub publishing and normalization
- Automated project setup tooling
- Consistent coding standards across all projects

---

## Requirements

- PHP 8.4 or higher
- Laravel 10 or higher
- Composer 2+

---

## Installation

Install the package via Composer:

```bash
composer require crowns-development/royal --dev
```

---

## Setup

After installation, run the setup command:

```bash
php artisan royal:install
```

This will:

- Publish configuration files
- Apply Pint rules
- Configure PHPStan
- Install stubs
- Enable strict typing conventions

---

## Changelog

All notable changes are documented in CHANGELOG.md.

---

## Contributing

1. Fork the repository
2. Create a feature branch
   git checkout -b feature/my-feature
3. Commit your changes
   git commit -m "Add feature"
4. Push to your branch
   git push origin feature/my-feature
5. Open a Pull Request

---

## Security

If you discover a security vulnerability, please do not open a public issue. Contact the maintainers directly.

---

## License

This package is open-source software licensed under the MIT license. See the LICENSE file for details.

---

## Credits

Developed and maintained by Crowns Development.
