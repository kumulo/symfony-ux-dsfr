# Copilot instructions for Symfony UX DSFR

## Build, test, and lint
- Use docker composer image to run `composer` commands in a consistent environment: `docker run -it -v $(pwd):/app -w /app composer install` or `docker run -it -v $(pwd):/app -w /app composer bash`.
- Use docker php image to run php dependencies commands in a consistent environment: `docker run -it -v $(pwd):/app -w /app php vendor/bin/php-cs-fixer fix --dry-run` or `docker run -it -v $(pwd):/app -w /app php bash`.
- Use docker node image to run npm dependencies commands in a consistent environment: `docker run -it -v $(pwd):/app -w /app node npm install` or `docker run -it -v $(pwd):/app -w /app node bash`.
- Install dependencies: `composer install && npm install`
- Build frontend assets for local development: `npx encore dev`
- Build production assets: `npx encore production`
- Lint PHP coding style: `vendor/bin/php-cs-fixer fix --dry-run --diff`
- Static analysis: `vendor/bin/phpstan analyse src`
- There is no project-level JavaScript test runner configured in this repository. The package.json `test` script is a placeholder and exits with an error; avoid using `npm test`.
- PHPUnit is installed via Composer. When a test class exists, run a single test file or filtered test, for example: `vendor/bin/phpunit tests/SomeTest.php` or `vendor/bin/phpunit --filter SomeTest`.

## High-level architecture

- This repository is a Symfony UX bundle, not a full application. Its purpose is to expose DSFR (Design System de la République Française) components as Twig components for Symfony apps.
- `src/Twig/Components/` contains the component classes. Most components are defined with `#[AsTwigComponent]`, expose their public properties via `#[ExposeInTemplate]`, and validate inputs in `preMount()` using `OptionsResolver`.
- `src/Resources/templates/components/` contains the matching Twig templates. Nested families such as `Header`, `Footer`, and `Nav` live in subdirectories and keep their DSFR markup together.
- The bundle wires itself into Symfony in `src/DependencyInjection/DsfrExtension.php`: it prepends Twig template paths (`@UxDsfr`), configures twig-component defaults with the `UxDsfr` prefix, registers the bundle translations directory, and adds the Encore build target for DSFR assets.
- `src/Resources/config/services.yaml` autowires all component classes and controller classes.
- `src/Resources/assets/` contains the Webpack entry points and DSFR asset source files. `webpack.config.js` compiles these into `src/Resources/public/` and exposes them under `/bundles/symfonyuxdsfr/`.
- `src/Resources/templates/form/form_dsfr_layout.html.twig` is the custom form theme used when the bundle is installed in a Symfony app.
- `src/Controller/ComponentsDemoController.php` and `src/Resources/templates/demo/` provide a local component gallery for previewing the bundle in development.
- Bundle strings live in `src/Resources/translations/dsfr.fr.yaml` and are intended to be translated with `{{ 'key'|trans({}, 'dsfr') }}`.

## Key conventions

- Prefer PHP and Twig over JavaScript for UI behavior and markup. DSFR CSS classes should be used instead of ad-hoc styling.
- Use the repository naming pattern: PascalCase PHP component class names and kebab-case Twig templates. Example: `HeaderNav` maps to `header-nav`.
- Validate component arguments with `OptionsResolver`; prefer `setAllowedValues()` for enum-like properties and `setIgnoreUndefined()` when appropriate for optional attributes.
- Use `attributes.defaults(...)` when merging HTML attributes or CSS classes instead of manually overriding them.
- Keep component-related templates in `src/Resources/templates/components/` and matching preview/demo templates under `src/Resources/templates/demo/components/`.
- When changing shared bundle behavior, check `DsfrExtension.php`, `webpack.config.js`, and the relevant component class/template together; these files define the bundle contract.

## Repository-specific notes

- The project already documents the intended style in `AGENTS.md` and `Readme.md`: the bundle is DSFR-first, code should stay in PHP/Twig where possible, and `attributes.defaults` / `setIgnoreUndefined()` are preferred patterns.
- This repo is a library bundle; prefer minimal, bundle-scoped changes that fit the DSFR naming and template conventions instead of introducing application-specific patterns.
