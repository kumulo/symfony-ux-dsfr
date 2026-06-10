# Symfony UX DSFR Bundle - AI Agent Guidelines

## Architecture Overview
This is a Symfony UX bundle that provides Twig components implementing the French government design system (DSFR - Design System de la République Française). The bundle integrates DSFR components into Symfony applications using Twig components with the `UxDsfr` prefix.

**Key Structure:**
- `src/Twig/Components/`: PHP classes defining component properties and validation
- `src/Resources/templates/components/`: Twig templates using DSFR CSS classes
- `src/Resources/assets/`: Frontend assets (JS, SCSS) importing @gouvfr/dsfr
- Nested components in subdirectories (e.g., `Header/Brand.php`, `Footer/Logo.php`)

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
- **Demo**: Controllers in `src/Controller/` render bootstrap templates for component previews

## Conventions
- **Component Naming**: PascalCase PHP classes, kebab-case in templates (e.g., `HeaderNav` → `header-nav`)
- **Translations**: Use `{{ 'key'|trans({}, 'dsfr') }}` for bundle strings in `src/Resources/translations/`
- **Attributes**: Use `{{ attributes.defaults({...}) }}` for merging classes/attributes
- **Code Preferences**: Prefer PHP/Twig over JS, use DSFR CSS, ignore undefined attributes in resolvers

## Key Files
- `src/DependencyInjection/DsfrExtension.php`: Configures Twig paths, component defaults, webpack builds
- `src/Resources/config/services.yaml`: Autowires components and controllers
- `webpack.config.js`: Encore config with DSFR asset copying
- `src/Resources/assets/dsfr/index.js`: Imports and initializes DSFR JS/CSS</content>
<parameter name="filePath">/home/kumulo/projects/symfony-ux-dsfr/AGENTS.md
