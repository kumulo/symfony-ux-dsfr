const hljs = require('highlight.js/lib/core');
import javascript from 'highlight.js/lib/languages/javascript';
import haml from 'highlight.js/lib/languages/haml';
import xml from 'highlight.js/lib/languages/xml';
import php from 'highlight.js/lib/languages/php';
import twig from 'highlight.js/lib/languages/twig';
import 'highlight.js/styles/vs-dark.min.css'
import './index.scss'
hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('haml', haml);
hljs.registerLanguage('xml', xml);
hljs.registerLanguage('php', php);
hljs.registerLanguage('twig', twig);
hljs.highlightAll();
