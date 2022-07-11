# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Changed

- Move session controller to separate file

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
