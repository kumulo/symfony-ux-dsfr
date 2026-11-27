# Contributing to Symfony UX DSFR

Thanks for helping! This bundle exposes the [DSFR](https://www.systeme-de-design.gouv.fr/version-courante/fr) components as Symfony UX Twig components. This guide says what belongs in the bundle and how to propose a change, so the bundle stays small, consistent and close to the DSFR.

## Scope

**In scope**
- DSFR components, with the DSFR's markup, CSS classes and variants as documented on the [DSFR site](https://www.systeme-de-design.gouv.fr/version-courante/fr/composants).
- The DSFR form theme (`form_dsfr_layout.html.twig`) and the page layouts.
- What is needed to integrate the DSFR into a Symfony app: asset loading (Encore, AssetMapper), configuration, translations.

**Out of scope**
- Business logic or behaviour specific to one application. Build it in your app, on top of the bundle's components, blocks and attributes.
- Components, variants or styles that the DSFR doesn't define. If the DSFR is missing something, raise it with the [DSFR team](https://github.com/GouvernementFR/dsfr) first.
- Custom CSS that overrides the DSFR, and JavaScript the DSFR doesn't already provide.
- New runtime dependencies, unless they were agreed on in an issue first.

If you're unsure whether something fits, open an issue before writing code. The maintainer has the final say on scope and API.

## Before you start

- **Small changes** (bug fix, missing DSFR class, typo): open a PR directly.
- **New component, new prop, renamed prop, behaviour change**: open an issue first describing the DSFR component (with a link to its page) and the API you propose, so we agree on it before you spend time on it.
- One component or one topic per PR. Several small PRs are easier to review than a big one.

## Writing a component

Follow the existing components; `Badge` and `Alert` are good examples.

- **PHP class** in `src/Twig/Components/` (nested families in subfolders, e.g. `Header/Brand.php`): `#[AsTwigComponent]`, properties exposed with `#[ExposeInTemplate]`.
- **Validation** in a `#[PreMount]` method with `OptionsResolver`: `setIgnoreUndefined()`, defaults for every prop, `setAllowedValues()` for every enum-like prop, using the DSFR's own values.
- **Template** in `src/Resources/templates/components/`, same name and path as the class (`Badge.php` → `Badge.html.twig`). Use the DSFR markup as is, merge extra classes and attributes with `attributes.defaults({...})`, and expose blocks where users will need to customise content.
- **Props** follow the DSFR's vocabulary: name a variant the way the DSFR names it (`size: 'sm'`, `type: 'warning'`), not the way one app needs it.
- **Strings** go in `src/Resources/translations/dsfr.fr.yaml` and `dsfr.en.yaml`, used with `{{ 'key'|trans({}, 'dsfr') }}`. Never hardcode user-facing text.
- **Accessibility**: keep the DSFR's ARIA attributes, roles and labels. A component must not be less accessible than the DSFR's reference markup (RGAA).
- **Prefer PHP and Twig** over JavaScript. The DSFR's own JS is loaded by the bundle; don't add your own.

## Demo page

Every component has a demo page in `src/Resources/templates/demo/components/`, rendered by `ComponentsDemoController`. When you add a component or a prop, add or update its demo with:
- each variant and each prop value,
- the matching Twig snippet, so the demo also documents the usage.

## Compatibility and versioning

- The bundle targets the DSFR version stated in the README (currently `1.15.x`). Upgrading the DSFR is its own PR.
- Supported versions are in `composer.json` (PHP `>=8.3`, Symfony `^6.4|^7.4`). Don't use features above these minimums.
- Before 1.0, minor versions may break the API; we still avoid it and list every break in the PR description and the release notes.
- After 1.0, the bundle follows [semver](https://semver.org/): removing or renaming a component, a prop, a block or the `UxDsfr` prefix is a major change. Deprecate first, remove later.

## Checks

Run these before pushing (see `.github/copilot-instructions.md` for the Docker variants):

```bash
composer install && npm install
vendor/bin/php-cs-fixer fix --dry-run --diff
vendor/bin/phpstan analyse src
npx encore production   # if you changed anything in src/Resources/assets
```

Then check your component's demo page in a browser, in light and dark themes.

## Pull requests

- Branch from `0.x` and target `0.x`.
- Commits and code in English. Issues and PR descriptions may be in French or English.
- In the description: what changed, the link to the DSFR component page, any API change or break, and a screenshot of the demo page for visual changes.
- Keep the PR focused: no unrelated reformatting or refactoring.

## License

By contributing, you agree that your contributions are licensed under the project's MIT license.
