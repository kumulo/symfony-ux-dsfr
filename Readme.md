# Welcome to SymfonyUxDsfr Bundle
In this Symfony Bundle, we will adapt [Gouv FR Components](https://www.systeme-de-design.gouv.fr/version-courante/fr/composants) to Symfony UX components.

## Code preferences
- All code is in PHP or Twig template when possible
- As UI Framework uses [DSFR](https://www.systeme-de-design.gouv.fr/version-courante/fr)
- For styling use [DSFR](https://www.systeme-de-design.gouv.fr/version-courante/fr) CSS
- Use `attributes.defaults` and `$resolver->setIgnoreUndefined()` if possible

## DSFR version
The DSFR version used in this bundle is `1.15.x`. You can check the latest version of DSFR on [GitHub](https://github.com/GouvernementFR/dsfr)

## Installation
```bash
composer require kumulo/symfony-ux-dsfr
```

## Usage
### Bundle registration
Include the bundle in your `config/bundles.php` file:
```php
<?php

return [
    // ...
    SymfonyUxDsfr\SymfonyUxDsfrBundle::class => ['all' => true],
    // ...
];
```

### Configuration
The defaults load the bundle's Encore build and add the DSFR form theme to every form. Both can be changed in `config/packages/dsfr.yaml`:
```yaml
dsfr:
    # encore (default): the bundle's Encore build
    # importmap: the application's "dsfr" importmap entrypoint, which imports the DSFR CSS and JS
    # none: the layouts load nothing; add your own tags in the stylesheets and javascripts blocks
    dsfr_integration_mode: importmap
    # true (default) adds @UxDsfr/form/form_dsfr_layout.html.twig to the global form themes;
    # set it to false to apply the theme only where you choose, with {% form_theme form '@UxDsfr/form/form_dsfr_layout.html.twig' %}
    form_theme: false
```
With `importmap`, install the DSFR with `php bin/console importmap:require @gouvfr/dsfr` and declare a `dsfr` entrypoint in `importmap.php`, for example `assets/dsfr.js`:
```js
import '@gouvfr/dsfr/dist/dsfr.min.css';
import '@gouvfr/dsfr/dist/utility/icons/icons.min.css';
import '@gouvfr/dsfr/dist/dsfr.module.min.js';
```

Create a base template for your application that extends the DSFR layout. For example, create a `base-dsfr.html.twig` file in your `templates` directory:
```twig
{% set page_content %}
    {# This is the header component for the page #}
    <twig:UxDsfr:Header
        header_service_title="Symfony UX DSFR"
        header_service_tag="Implémentation du DSFR dans Symfony"
    >
    </twig:UxDsfr:Header>
    {# This is the body component for the page #}
    {% if block('body') is defined %}
        {% set body = block('body') %}
        <twig:UxDsfr:Layout:Body class="fr-pb-md-14v">
            {% block body_content %}
                {{ body|raw }}
            {% endblock %}
        </twig:UxDsfr:Layout:Body>
    {% endif %}
    {# This is the footer component for the page #}
    <twig:UxDsfr:Footer />
{% endset %}
<twig:UxDsfr:Layout:Page>
    {# You can override stylesheets and javascripts here #}
    {% block stylesheets %}
        {{ parent() }}
        {# Your custom stylesheets #}
    {% endblock %}
    {% block javascripts %}
        {{ parent() }}
        {# Your custom javascripts #}
    {% endblock %}
    {% block page %}
        {{ page_content }}
    {% endblock %}
</twig:UxDsfr:Layout:Page>
```
Create your first page template that extends the base template. For example, create a `home.html.twig` file in your `templates` directory:
```twig
{% extends 'base-dsfr.html.twig' %}

{% block body %}
<twig:UxDsfr:Layout:Container class="fr-mt-5v">
    <h1>Demo Page</h1>
    <p>This is a simple demo page using the DSFR design system.</p>
</twig:UxDsfr:Layout:Container>
{% endblock %}
```
### Demo route
**For development only**, you can add the following line in your `config/routes.yaml` file to access the Symfony Ux DSFR bundle documentation.
You will be able to see some examples of the DSFR components in action.
```yaml
when@dev:
  dsfr:
    prefix: /dsfr-demo
    resource: "@SymfonyUxDsfrBundle/Resources/config/routing.yaml"
```
