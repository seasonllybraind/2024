import Swup from 'swup';
import SwupScrollPlugin from '@swup/scroll-plugin';
import SwupFadeTheme from '@swup/fade-theme';
// import SwupSlideTheme from '@swup/slide-theme';
import SwupPreloadPlugin from '@swup/preload-plugin';
import SwupProgressPlugin from '@swup/progress-plugin';
// import SwupScriptsPlugin from '@swup/scripts-plugin';
// import SwupDebugPlugin from '@swup/debug-plugin';
// import SwupHeadPlugin from '@swup/head-plugin';
// import SwupGaPlugin from '@swup/ga-plugin';
// import SwupGtagPlugin from 'swup-gtag-plugin';
// import anime from 'animejs/lib/anime.es.js';

const options = {
    containers: ["#swup", "#navbar", "#mobile-menu"],
    animationSelector: '[class*="transition-fade"]',
    linkSelector:
        'a[href^="' + window.location.origin +'"]:not([data-no-swup]):not([target="_blank"]):not([download]):not([href$=".pdf"]), ' +
        'a[href^="/"]:not([data-no-swup]):not([target="_blank"]):not([download]):not([href$=".pdf"]), ' +
        'a[href^="#"]:not([data-no-swup]):not([target="_blank"]):not([download]):not([href$=".pdf"])',
    animateHistoryBrowsing: false,
    cache: true,
    plugins: [
        new SwupScrollPlugin({
            animateScroll: false
        }),      
        new SwupFadeTheme(),
        new SwupPreloadPlugin(),
        new SwupProgressPlugin(
            {
            className: 'tm-progress-bar',
            transition: 300,
            delay: 300
            }   
        )     
    ]
};

const swup = new Swup(options);

let scrollValues = {};

swup.on('clickLink', () => {
    scrollValues[window.location.href] = window.scrollY;
    if(document.getElementById("offcanvas").classList.contains("uk-open")) {
        UIkit.offcanvas('#offcanvas').hide();
    }
    
});

swup.on('popState', () => {
    setTimeout(function() {
        window.scrollTo(0, scrollValues[window.location.href]);
    }, 100);
});

swup.on('contentReplaced', function() {
    // quantity
    if(document.querySelector('#quantity') != null) {
        // reset product quantity
        
    }
    // quantity
    if(document.querySelector('.snipcart-items-count') != null) {
        // reset snipcart cart
        
    }
});

