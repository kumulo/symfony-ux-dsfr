const hljs = require('highlight.js/lib/core');
import javascript from 'highlight.js/lib/languages/javascript';
import html from 'highlight.js/lib/languages/xml';
import php from 'highlight.js/lib/languages/php';
import twig from 'highlight.js/lib/languages/twig';
import 'highlight.js/styles/vs.css'
import './index.scss'
hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('html', html);
hljs.registerLanguage('php', php);
hljs.registerLanguage('twig', twig);
hljs.highlightAll();