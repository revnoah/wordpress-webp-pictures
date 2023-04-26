# Contributing Guidelines

This document provides the general guidelines and requirements of working with this project. Adherance to these guidelines will help streamline **pull requests** and keep the maintainable.

## Git Guidelines

This project follows a feature branch management methodology, similar to `gitflow`. All PRs should be from a branch that has the issue key, and a concise summary of the branch intent, e.g. `AddFrontendBodyClasses`. These branch names should be prepended by the type of issue it is, e.g. `feature` and `fix`, e.g. `feature/AddFrontendBodyClasses` or `fix/TrimExtraSpacesInClassNames`.

## Pull Requests

Following are guidelines for submitting and managing PRs:

* A pull request template has been included with this project. All requests must complete the template as much as possible.
* Ensure you run `npm run build` before pushing changes to ensure code is compliant and resolve any issues prior to requesting for review.
* If the change requires documentation updates, then it must be included in the PR.

## Style Guidelines

Style checks are automated with **PHP Code Sniffer**. This project uses a modified PSR-1 guideline:

* [PSR-1](https://www.php-fig.org/psr/psr-1/) guideline.
* These exceptions are included in the `phpcs.xml` ruleset, and will be filtered accordingly.
* Run `phpcs` or `npm run test` to check code smell.

## Testing Coverage

There is currently no test coverage for the plugin. Tests will be written in phpunit.
