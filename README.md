# Climbing Session Log

A personal WordPress plugin for logging climbing sessions — grades, attempts, and sends — built as a learning project in modern PHP practices: Composer, PSR-4 autoloading, OOP, testing, Gutenberg blocks, and the WP REST API / WP-CLI.

Currently only the core PHP logic exists, independent of WordPress. WordPress integration is planned for later stages.

## Requirements

- PHP 8.0 or higher
- Composer

## Setup

Run `composer install` to generate the `vendor/` directory and autoloader from `composer.json` / `composer.lock`.

## Run the demo

Run `php demo.php`

Expected output: 3 total sessions, 2 total sends, a 67% send rate, and sends by grade of black: 1, blue: 1. This proves the classes autoload and the logic runs without WordPress loaded.

## Structure

- `composer.json` — package definition, PHP version requirement, and the PSR-4 autoload mapping (`ClimbingLog\` -> `src/`)
- `src/Session.php` — a single logged climb: date, grade, attempts, and whether it was sent
- `src/SessionStats.php` — calculations over a list of Sessions: totals, send rate, and sends by grade
- `demo.php` — proof script that builds sample Sessions and prints the stats

## Progress

- 2026-11-03 — Session 1: created the repo, installed Composer globally, configured Composer with PSR-4 autoloading, built the Session and SessionStats classes, and verified them with demo.php.

## License

MIT
