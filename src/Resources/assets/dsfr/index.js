// Import des styles DSFR
import '@gouvfr/dsfr/dist/dsfr.min.css';
import '../scss/index.scss';
//import '@gouvfr/dsfr/storybook/dist/utility/colors/colors.main.css';
import '@gouvfr/dsfr/dist/utility/icons/icons.min.css';

// Import du JS DSFR
import '@gouvfr/dsfr/dist/dsfr.module.min.js';

// Initialisation de DSFR
document.addEventListener('DOMContentLoaded', () => {
    dsfr.start();
});