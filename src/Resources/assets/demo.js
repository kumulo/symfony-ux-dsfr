console.log('demo');
const hljs = require('highlight.js/lib/common');
import 'highlight.js/styles/github-dark.min.css';
hljs.registerLanguage('javascript', require('highlight.js/lib/languages/javascript'));
hljs.registerLanguage('haml', require('highlight.js/lib/languages/haml'));
hljs.registerLanguage('xml', require('highlight.js/lib/languages/xml'));
hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));
hljs.registerLanguage('twig', require('highlight.js/lib/languages/twig'));
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('pre code').forEach((el) => {
        hljs.highlightElement(el);
    });
});
