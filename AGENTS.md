# Symfony UX DSFR Bundle - AI Agent Guidelines

## Architecture Overview
This is a Symfony UX bundle that provides Twig components implementing the French government design system (DSFR - Design System de la République Française). The bundle integrates DSFR components into Symfony applications using Twig components with the `UxDsfr` prefix.

**Key Structure:**
- `src/Twig/Components/`: PHP classes defining component properties and validation
- `src/Resources/templates/components/`: Twig templates using DSFR CSS classes
- `src/Resources/assets/`: Frontend assets (JS, SCSS) importing @gouvfr/dsfr
- Nested components in subdirectories (e.g., `Header/Brand.php`, `Footer/Logo.php`)
- Custom agent skills are stored in `.agents/skills/` for repository-specific automation and tooling

## Component Patterns
- **PHP Classes**: Use `#[AsTwigComponent]`, `#[ExposeInTemplate]` for properties, `#[PreMount]` with OptionsResolver for validation
- **Validation**: Always use OptionsResolver in `preMount()` with `setAllowedValues()` for enums
- **Templates**: Use DSFR CSS classes (e.g., `fr-alert--{{ type }}`), blocks for customization, nested `<twig:UxDsfr:...>` components
- **Forms**: Custom layout in `form_dsfr_layout.html.twig` adds `fr-` classes to form elements

## Asset Management
- **Build Tool**: Symfony Webpack Encore configured in `webpack.config.js`
- **Entry Points**: `dsfr` (main DSFR assets), `dsfr-hljs` (syntax highlighting)
- **Asset Copying**: DSFR fonts, icons, artwork copied from node_modules to public bundles
- **Output**: Built to `src/Resources/public/` with public path `/bundles/symfonyuxdsfr/`

## Development Workflows
- **Install**: `composer install && npm install`
- **Build Assets**: `npm run encore dev` or `npm run encore production` (via Symfony Webpack Encore Bundle)
- **Code Quality**: `vendor/bin/php-cs-fixer fix` and `vendor/bin/phpstan analyse`
- **Demo**: Controllers in `src/Controller/` render bootstrap templates for component previews. To view them in a running app, start a Symfony application that loads the bundle (for local previews you can run the host app with `symfony server:start` or a PHP built-in server `php -S localhost:8000 -t public`) and visit the demo routes (e.g. `/components`).
  - Demo pages for this project are available at: `http://localhost:8080/dsfr/components` (open this URL after starting the host app that serves the bundle).

## Conventions
- **Component Naming**: PascalCase PHP classes, kebab-case in templates (e.g., `HeaderNav` → `header-nav`)
- **Translations**: Use `{{ 'key'|trans({}, 'dsfr') }}` for bundle strings in `src/Resources/translations/`
- **Attributes**: Use `{{ attributes.defaults({...}) }}` for merging classes/attributes
- **Code Preferences**: Prefer PHP/Twig over JS, use DSFR CSS, ignore undefined attributes in resolvers

## Documentation
- **Twig Components**: Documented in `doc/components/` with usage examples and code
- **Components Demo Pages**: Rendered by controller `src/Controller/ComponentsDemoController.php` for local preview of components
- **Components Demo Templates**: Each component has a corresponding Twig template in `src/Resources/templates/demo/components/` for rendering the demo page. It shows the component in action and provides code snippets for usage with variations for all the component's variables.

## Key Files
- `src/DependencyInjection/DsfrExtension.php`: Configures Twig paths, component defaults, webpack builds
- `src/Resources/config/services.yaml`: Autowires components and controllers
- `webpack.config.js`: Encore config with DSFR asset copying
- `src/Resources/assets/dsfr/index.js`: Imports and initializes DSFR JS/CSS
- `src/Resources/assets/index.js`: top-level webpack entry that imports the `dsfr` sub-entry (this file is listed as `main` in `package.json`).
