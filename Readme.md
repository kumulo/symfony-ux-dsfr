# Welcome to SymfonyUxDsfr Bundle
In this Symfony Bundle, we will adapt [Gouv FR Components](https://www.systeme-de-design.gouv.fr/version-courante/fr/composants) to Symfony UX components.

# Code preferences
- All code is in PHP or Twig template when possible
- As UI Framework uses [DSFR](https://www.systeme-de-design.gouv.fr/version-courante/fr)
- For styling use [DSFR](https://www.systeme-de-design.gouv.fr/version-courante/fr) CSS
- Use `attributes.defaults` and `$resolver->setIgnoreUndefined()` if possible

# DSFR component documentation notes
- Table components should keep a semantic structure (`<table>`, `<caption>`, `<th scope="col|row">`) and expose only the DSFR variants that map directly to CSS classes.
- Prefer `caption` attributes when the table is a data table, and keep the component API aligned with DSFR patterns instead of introducing custom presentation flags.
- Examples for DSFR tables in this project use the `UxDsfr:Table` component with `caption`, `bordered`, and `scrollable` options.