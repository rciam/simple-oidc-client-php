# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v3.0.0] - 2023-05-05

### Added

- Add option for showing/hiding ID Token from dashboard

### Changed

- Update composer dependencies
- Use `jumbojett/openid-connect-php` from composer

### Fixed

- Use font awesome from composer
- Use minified CSS and JS
- Handle issuer with trailing slash correctly

### Removed

- Remove support for PHP 5

## [v2.3.1] - 2022-09-07

### Fixed

- Fix "Undefined variable: userInfo" error

### Changed

- Update `jumbojett/OpenID-Connect-PHP` library to v0.9.8

## [v2.3.0] - 2022-07-27

### Added

- Add banner

### Changed

- Move session controller to separate file
- Move header to separate file
- Move footer to separate file

### Fixed

- Fix redirection in `index.php` form

## [v2.2.0] - 2022-04-19

### Added

- Add `enableActiveTokensTable` option to show/hide the "Active Refresh Tokens" table
- Add `allowIntrospection` option to show/hide the "Introspection Command"

### Fixed

- Resolve some linting warnings

## [v2.1.0] - 2022-02-11

### Added

- New page (`auth.php`) that displays the response from UserInfo Endpoint

## [v2.0.0] - 2021-09-29

### Added

- Add support for PKCE
- Manage refresh tokens
- Create new refresh token on demand
- Display access token and the commands for userinfo and introspect endpoint
- Create user session

## [v1.0.0] - 2018-04-17

### Added

- Initialize oidc-client
